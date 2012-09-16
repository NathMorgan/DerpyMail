<?php
	//Setting the root of the server
	$root = $_SERVER['DOCUMENT_ROOT'];
	
	//Setting the page
	if(isset($_GET['page']))
		$page = $_GET['page'];
	else
		$page = "Derpymail";
		
	//Setting SQL login information
	$sqlusername = 'SQLusername';
	$sqlpassword = 'SQLpassword';
	$sqldatabase = 'SQLdatabase';
	
	//Setting the hitcount
	$hitcount = (int)fgets(fopen($root.'/logs/hitcounter.dat', 'r+'));
	$hitcount = (int)fgets(fopen($root.'/logs/hitcounter.dat', 'r+'));
	if(!isset($_COOKIE["hitcounter"])){
	
		fseek(fopen($root.'/logs/hitcounter.dat', 'r+'), 0);
		fwrite(fopen($root.'/logs/hitcounter.dat', 'r+'), $hitcount + 1);
	
		if(isset($_SERVER['HTTP_REFERER'])){
		
			fwrite(fopen($root.'/logs/HTTPCounter.dat', 'a'), $_SERVER['HTTP_REFERER'] . "\n");
			fclose(fopen($root.'/logs/HTTPCounter.dat', 'a'));
		}
		setcookie("hitcounter", "1");
	}
	fclose(fopen($root.'/logs/HTTPCounter.dat', 'r+'));
	
	//Config actions
	if(isset($_GET["action"])){
		$action = $_GET["action"];
		//Clear cookies on mail page
		if($action == "clearcookie"){
			setcookie('Derpymailclient','null', time()-3600, "/");
			header('Location: https://derpymail.co.uk/mail');
			break;
		}
	}
	
	//Setting the counts
	$outgoing = @file_get_contents('/tmp/derpymail/counter_outgoing.txt');
	$incoming = @file_get_contents('/tmp/derpymail/counter_incoming.txt');

	if(empty($outgoing))
		$outgoing = "Error";
	if(empty($incoming))
		$incoming = "Error";
	if(empty($hitcount))
		$hitcount = "Error";
	
	//Including page spec files
	if($page == "mail"){
		if(isset($_COOKIE["Derpymailclient"])){
			switch($_COOKIE["Derpymailclient"]){
				case'squirrelmail':header('Location: http://derpymail.co.uk/squirrelmail');break;
				case'roundcube':header('Location: http://derpymail.co.uk/roundcube');break;
			}
		}
	}
	
	else if($page == "register"){
		include_once 'MailUser.php';
		if(isset($_POST['submit'])){
			$mailuser = new MailUser();
			$mailuser->Register($_POST['username'], $_POST['bmail'], $_POST['squestion'], $_POST['sanswer'], $_POST['password'], $_POST['repassword'], $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field'], $_POST['terms']);
			$error = implode($mailuser->error);
		}
	}
	
	else if($page == "donate"){
		include_once 'paypal.class.php';
		include_once 'MailUser.php';
		$mailuser = new MailUser();
		$name = $mailuser->GetDonators();
		if(isset($_POST['amount'])){
			if($_POST['amount'] > 0){
				$p = new paypal_class;
				$p->add_field('business', 'paypayemail');
				$p->add_field('cmd', '_donations');
				$p->add_field('item_name', 'Muffins');
				$p->add_field('notify_url', $root.'classes/ipn.php');
				$p->add_field('return', 'http://derpymail.co.uk/thankyou/'); //Change me
				$p->add_field('rm', '2');
				$p->add_field('no_note', '1');
				$p->add_field('cbt', 'Go back to DerpyMail');
				$p->add_field('no_shipping', '1');
				$p->add_field('lc', 'EN');
				$p->add_field('currency_code', 'GBP');
				$p->add_field('amount', $_POST['amount']);
				$p->submit_paypal_post();
			}
		}
	}
	
	else if($page == "resetpassword"){
		include_once 'MailUser.php';
		if(isset($_POST['submit'])){
			$mailuser = new MailUser();
			if(isset($_POST['key']))
				$mailuser->PasswordReset($_POST['password'], $_POST['repassword'], $_POST['key']);
			else
				$mailuser->PasswordResetRequest($_POST['email'], $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);
			$error = implode($mailuser->error);
		}
	}
	
	else if($page == "contact"){
		include_once 'MailUser.php';
		if(isset($_POST['submit'])){
			$mailuser = new MailUser();
			$mailuser->Contact($_POST['reason'], $_POST['email'], $_POST['subject'], $_POST['description']);
			$error = implode($mailuser->error);
		}
	}
	
	else if($page == "thankyou"){
		include_once 'MailUser.php';
		if(isset($_POST['submit']) && isset($_POST['txn_id'])){
			$mailuser = new MailUser();
			$mailuser->Donate($_POST['txn_id'], $_POST['name']);
			$error = implode($mailuser->error);
		}
	}
?>