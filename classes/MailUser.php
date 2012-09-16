<?php
require_once 'SysCPMailUser.php';
require_once 'recaptchalib.php';

class MailUser{

	public $error;
	private $mysqli;
	
	function __construct(){
		
		global $sqlusername;
		global $sqlpassword;
		global $sqldatabase;
		
		$this->mysqli = new mysqli("localhost", $sqlusername, $sqlpassword, $sqldatabase);
		
	}
	
	protected function CheckExists($select, $from, $where, $rawvalue){
		$value = $this->mysqli->real_escape_string($rawvalue);
		$result = $this->mysqli->query("
					SELECT
						`$select`
					FROM
						`$from`
					WHERE
						`$where` = '$value'
					");
		return $result;
	}
	
	protected function Insert($table, $rawinserts){
		foreach($rawinserts as $key => $value ){
			$inserts[$key] = $this->mysqli->real_escape_string($value);
		}
		$values = array_values($inserts);
		$columns = array_keys($inserts);
		$this->mysqli->query('
						INSERT INTO 
							`'.$table.'` 
								(`'.implode('`,`', $columns).'`)
							VALUES 
								(\''.implode('\',\'', $values).'\')');
	}
	
	protected function Emailuser($to, $subject, $message){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Derpymail Admin <admin@derpymail.co.uk>' . "\r\n";
		
		mail($to, $subject, $message, $headers);
	}
	
	//Main starter function for registration that is called from the config, that checks the inputs taken from the register.php page and registers the email adress
	public function Register($email, $bmail, $squestion, $sanswer, $password, $repassword, $userip, $captchachallenge, $captcharesponce, $terms){
	
		//Constructing the arrays to be used for errors
		$this->error["email"] = "";
		$this->error["bmail"] = "";
		$this->error["secretq"] = "";
		$this->error["secreta"] = "";
		$this->error["password"] = "";
		$this->error["captcha"] = "";
		
		//Checking all the inputs are correct in the following order (email, backup email, secret question & awnser, password, captcha and terms)
		if($this->CheckEmail($email) & $this->CheckBmail($bmail) & $this->CheckSecret($squestion, $sanswer) & $this->CheckPassword($password, $repassword) & $this->CheckCaptcha($userip, $captchachallenge, $captcharesponce) & $terms == "agree"){
		
			//Create the SysCP class that will create the email account
			$syscp = new SysCPMailUser($email);
			$syscp->register($password);
			
			//Sends an email to the DerpyMail account to activate it and also sends an email to the backup email address informing the account has been created
			$emailHTML = implode('', file('http://www.derpymail.co.uk/templates/emails/AccountCreated.php?username=' . $email));
			$this->Emailuser($bmail, "DerpyMail Account", $emailHTML);
			$this->Emailuser($email."@derpymail.co.uk", "DerpyMail Account", $emailHTML);
			
			/* Adding the email, backup email, secretquestion, secretanser and account status to the `users` database
				Account Status:
					1 = Account created successfully
					0 = Account pending activation (Not used anymore)
					-1 = Account creation failed
					-2 = Account Suspended
			*/
			
			$userinsert = [
			'email' => $email."@derpymail.co.uk",
			'backupEmail' => $bmail,
			'secretQuestion' => $squestion,
			'secretAwnser' => $sanswer,
			'account' => "1"
			];
			
			$this->Insert("users", $userinsert);

			return true;
		}
		return false;
	}
	
	public function Contact($reason, $email, $subject, $description){
		$this->error["subject"] = "";
		$this->error["description"] = "";
		
		if($subject == ""){
			$this->error["subject"] .= "Error: Please enter a subject";
			return false;
		}
		if(!isset($description)){
			$this->error["description"] .= "Error: Please enter a description";
			return false;
		}
		$this->Emailuser("admin@derpymail.co.uk", $reason . " - " . $subject, "Email: " . $email . "<br />IP:" . $_SERVER['REMOTE_ADDR'] . "<br/>Discription: <br />" . $description);
		return true;
	}
	
	public function Donate($id, $name){
		$this->error["name"] = "";
		$this->error["id"] = "";
		
		if($name = ""){
			$this->error["name"] .= "Error: Name is blank";
			return false;
		}
		
		if($id = ""){
			$this->error["id"] .= "Error: Transaction ID is invalid";
			return false;
		}
		
		if($this->CheckExists("transaction_id", "don-comments", "transaction_id", $id)->num_rows > 0){
			$this->error["id"] .= "Error: Transaction ID is invalid";
			return false;
		}
		
		$donateinsert = [
			'transaction_id' => $id,
			'name' => $name
			];
		
		$this->Insert("don-comments", $donateinsert);
	}
	
	public function GetDonators(){
		$result = $this->mysqli->query("
					SELECT
						`name`
					FROM
						`don-comments`
					");
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$name[] = $row['name'];
			}
			return $name;
		}
	}
	
	public function PasswordResetRequest($email, $ip, $captchachallenge, $captcharesponce){
		
		//Checking the time in the key database and removing old keys
		$this->CheckKey(true);
	
		//Constructing the arrays to be used for errors
		$this->error["captcha"] = "";
		$this->error["email"] = "";
		
		//Checking capcha is correct
		if($this->CheckCaptcha($ip, $captchachallenge, $captcharesponce)){
			$result = $this->mysqli->query("
					SELECT
						`id`, `email`, `backupEmail`
					FROM
						`users`
					WHERE
						`email` = '$email'
					OR
						`backupEmail` = '$email'
					");
			//Checking that the email entered exists
			if($result->num_rows > 0){
				$userrow = $result->fetch_assoc();
				$key = $this->GenerateKey($ip, $userrow['backupEmail']);
				$result = $this->CheckExists("id`, `key", "keys", "key", $key);
				$keyrow = $result->fetch_assoc();
				$userxkeysinsert = [
				'usersid' => $userrow['id'],
				'keysid' => $keyrow['id']
				];
				$this->Insert("usersxkeys", $userxkeysinsert);
				$emailHTML = implode('', file('https://www.derpymail.co.uk/templates/emails/PasswordReset.php?key=' . $key));
				$this->Emailuser($userrow['backupEmail'], "DerpyMail Password Reset", $emailHTML);
				header('Location: https://derpymail.co.uk/');
			}
			else
				$this->error["email"] = "Error: Email doesn't exist";
		}
		return false;
	}
	
	public function PasswordReset($password, $repassword, $key){
	
		$this->error["password"] = "";
		$this->error["key"] = "";
	
		if($this->CheckPassword($password, $repassword)){
			if($this->CheckKey(false, $key)){
				$result = $this->mysqli->query("
							SELECT `users`.`id`,`users`.`email`,`keys`.`key`,`keys`.`id`, `usersxkeys`.`usersid`,`usersxkeys`.`keysid` 
							FROM 
								`users` 
							INNER JOIN
								`usersxkeys`
								ON `users`.`id` = `usersxkeys`.`usersid`
							INNER JOIN
								`keys`
								ON `keys`.`id` = `usersxkeys`.`keysid`
							WHERE
								`keys`.`key` = '$key'
							");
				$userrow = $result->fetch_assoc();
				$derpymailaddress = substr($userrow['email'], 0, -16);
				$syscp = new SysCPMailUser($derpymailaddress);
				$syscp->setPassword($password);
				$this->mysqli->query("
							UPDATE
								`keys`
							SET
								`time` = '0'
							WHERE
								`key` = '$key'
							");
							
				//Checking the time in the key database and removing old keys
				$this->CheckKey(true);
				
				$this->Emailuser("admin@derpymail.co.uk", "DerpyMail Password Reset Log", "User: $derpymailaddress <br /> IP: ".$_SERVER['REMOTE_ADDR']."<br /> Has reset there password");
				header('Location: http://derpymail.co.uk/');
			}
			else
				$this->error["key"] .= "Error: Key is in invalid";
		}
		return false;
	}
	
	private function GenerateKey($ip, $value){
			$time = time();
			$key = hash("sha256","KEY".$value.$time.$_SERVER['REMOTE_ADDR']);
			$keysinsert = [
				'key' => $key,
				'time' => $time
			];
			$this->Insert("keys", $keysinsert);
			return $key;
	}
	
	private function CheckKey($checktime, $key = ""){
		if($checktime){
			$time24 = time()-86400;
			$result = $this->mysqli->query("
						SELECT
							`id`
						FROM
							`keys`
						WHERE
							`time`< '$time24'
						");
			if($result){
				while($keyrow = $result->fetch_assoc()){
					$this->mysqli->query("
								DELETE
									FROM
										`usersxkeys`
									WHERE
										`keysid` = '".$keyrow['id']."'
								");
				}
			}
			$this->mysqli->query("
						DELETE 
							FROM 
								`keys`
							WHERE
								`time`< '$time24'
						");
			return true;
		}
		$result = $this->CheckExists("key`, `time", "keys", "key", $key);
		if($result->num_rows == 0)
			return false;
		return true;
	}
	
	protected function CheckEmail($email){
	
		$pattern = '/[@(),;:<>\[\]]/';
		
		if(strlen($email) < 3){
			$this->error["email"] .= "Error: Email must be over 3 characters";
			return false;
		}
		
		else if(preg_match($pattern, $email)){
			$this->error["email"] .= "Error: Email contains invalid characters";
			return false;
		}

		if($this->CheckExists("email", "users", "email", $email."@derpymail.co.uk")->num_rows > 0){
			$this->error["email"] .= "Error: Email already exists";
			return false;
		}
		
		if($this->CheckExists("email", "blockedEmails", "email", $email."@derpymail.co.uk")->num_rows > 0){
			$row = $result->fetch_assoc();
			$this->error["email"] .= "Error: Email has been blacklisted";
			return false;
		}
		return true;
	}
	
	protected function CheckBmail($bmail){
	
		$pattern = '/^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/';
		
		if(strlen($bmail) < 5){
			$this->error["bmail"] .= "Error: Backup email must be over 5 characters";
			return false;
		}
		
		else if(!preg_match($pattern, $bmail)){
			$this->error["bmail"] .= "Error: Backup email must be over 5 characters";
			return false;
		}
		
		return true;
	}
	
	protected function CheckSecret($secretq, $secreta){
	
		if(strlen($secretq) < 4){
			$this->error["secretq"] .= "Error: Secret question must be over 4 characters";
			return false;
		}
		
		if(strlen($secreta) < 4){
			$this->error["secreta"] .= "Error: Secret answer must be over 4 characters";
			return false;
		}
		
		return true;
	}
	
	protected function CheckPassword($password, $repassword){
	
		if(strlen($password) < 5){
			$this->error["password"] .= "Error: Password must be over 5 characters";
			return false;
		}
		
		if($password == "password"){
			$this->error["password"] .= "Error: Password too easy to guess";
			return false;
		}
		
		if($password != $repassword){
			$error["password"] .= "Error: Passwords don't match";
			return false;
		}
		
		return true;
	}
	
	protected function CheckCaptcha($userip, $captchachallenge, $captcharesponce){
	
		$captcha = recaptcha_check_answer("", $userip, $captchachallenge, $captcharesponce);
		
		if(!$captcha->is_valid){
			$this->error["captcha"] = "Error: Captcha was entered incorrectly";
			return false;
		}
		return true;
	}
}