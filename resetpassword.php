<?php
	include_once 'classes/config.php';
?>
<!DOCTYPE HTML>
<html>
	<?php require_once $root.'templates/head.php'; ?>
	<body>
		<div id="mainwrapper">
			<?php require_once $root.'templates/header.php'; ?>
				<div id="contentwrapper" class="rounded_corner">
					<div id="pagewrapper" class="rounded_corner">
						<img src="/images/derpymail.png" id="derpymail" alt="Derpy picture"/>
						<h2>Reset Password</h2>
						<?php
							global $error;
							if(!isset($_GET['key'])){
								echo("
									<p>If you have forgotten your password fill out the form below, using your derpymail email address or your backup email address. Then check the email address you used as a backup when registering for the email that contains a link to reset your current password if you have lost access to your backup email then click here.</p>
									<div class=\"center\" style=\"color: red\">".$error."</div>
									<form name=\"rstpassword\" action=\"/resetpassword/\" class=\"center\" method=\"post\">
										<div id=\"resetpasswordform\">
											<p>
												<label for=\"email\">Email:</label>
												<input type=\"text\" name=\"email\" />
											</p>
											<p>
												<script type=\"text/javascript\">
													var RecaptchaOptions = {
														theme : 'white',
														custom_theme_widget: 'recaptcha_widget'
													};
												</script>
												<script type=\"text/javascript\"
													src=\"https://www.google.com/recaptcha/api/challenge?k=6Lc6C9ESAAAAAP2ic6UOZI4hhuFLhm3n1-U2yp7N\">
												</script>
									");
									require_once('classes/recaptchalib.php');
									$publickey = "6Ld5GNESAAAAAEMaMs1KffB42mood-1uGCJSEfCi";
									echo recaptcha_get_html($publickey);
									echo("
											</p>
											<button name=\"submit\">Reset Password</button>
										</div>
									</form>
									");
							}
							else{
								echo("
									<p>Please enter your new password</p>
									<form name=\"rstpassword\" action=\"/resetpassword/".$_GET['key']."\" class=\"center\" method=\"post\">
										<div class=\"center\" style=\"color: red\">".$error."</div>
										<div id=\"resetpasswordform\">
											<input type=\"hidden\" name=\"key\" value=\"".$_GET['key']."\" />
											<p>
												<label for=\"password\" style=\"text-align: left;\">Password:</label>
												<input type=\"password\" name=\"password\" style=\"float: right;\" />
											</p>
											<p>
												<label for=\"repassword\" style=\"text-align: left;\">Re-enter password:</label>
												<input type=\"password\" name=\"repassword\" style=\"float: right;\" />
											</p>
											<button name=\"submit\">Reset Password</button>
										</div>
									</form>
								");
							}
							?>
					</div>
				</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	</body>
</html>