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
					<form name="input" onsubmit="return jVal.check();" action="/register/" method="post">
						<h2>Register</h2>
						<div class="error center">
							<?php
								global $error;
								if($error != "")
									echo $error;
								else
									echo "&nbsp;";
							?>
						</div>
						<div id="registerform">
							<p>
								<label for="username" class="block">Username:</label>
								<input type="text" name="username" id="username" />
							</p>
							<p>
								<label for="bmail" class="block">Backup email:</label>
								<input type="text" name="bmail" id="bmail" />
							</p>
							<p>
								<label for="squestion" class="block">Secret question:</label>
								<input type="text" name="squestion" id="squestion" />
							</p>
							<p>
								<label for="sanswer" class="block">Secret answer:</label>
								<input type="text" name="sanswer" id="sanswer" />
							</p>
							<p>
								<label for="password" class="block">Password:</label>
								<input type="password" name="password" id="password" />
							</p>
							<p>
								<label for="repassword" class="block">Re-enter password:</label>
								<input type="password" name="repassword" id="repassword" />
							</p>
							<p>
								<label for="terms" class="block">I agree to the <a href="/terms">Terms of use</a></label>
								<input type="checkbox" name="terms" id="terms" value="agree">
							</p>
							<p>
								<script type="text/javascript">
									var RecaptchaOptions = {
								    theme : 'white',
								    custom_theme_widget: 'recaptcha_widget'
									};
								</script>
								<script type="text/javascript"
									src="https://www.google.com/recaptcha/api/challenge?k=6Lc6C9ESAAAAAP2ic6UOZI4hhuFLhm3n1-U2yp7N">
								</script>
								<?php
									require_once('classes/recaptchalib.php');
									$publickey = "";
									echo recaptcha_get_html($publickey);
								?>
							</p>
							<span id="button">
								<button type="submit" name="submit">Muffins!</button>
							</span>
						</div>
					</form>
					<div id="errorwrapper">
						<div id="usernameinfo" class="info">@derpymail.co.uk</div>
						<div id="bmailinfo" class="info">&nbsp</div>
						<div id="squestioninfo" class="info">&nbsp</div>
						<div id="sanswerinfo" class="info">&nbsp</div>
						<div id="passwordinfo" class="info">&nbsp</div>
						<div id="repasswordinfo" class="info">&nbsp</div>
						<div id="termsinfo" class="info">&nbsp</div>
					</div>
				</div>
			</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	</body>
</html>