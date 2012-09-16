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
					<div id="changelog">
						<img src="/images/derpymail20.png">
						<h1>Changelog (24/7/12)</h1>
						<p>
							*Changed register page HTML format made it much cleaner.<br />
							*Register page now uses real time input checking using javascript.<br />
							*Register page new uses new php code that is much more cleaner then before.<br />
							*Page urls now use rewrite.<br />
							*Background image filesize made smaller.<br />
							*404 page fixed.<br />
							*DerpyMail design is now supported on IE9.<br />
							*Added Squirrelmail to the mail clients.<br />
							*Added the option to select an email client.<br />
							*Added outgoing and incoming email count, conact us, Steam and pony chan to the footer.<br />
							*Added a reset password feature in the mail login page.<br />
							*Updated the policy.<br />
							*Added contact page.<br />
							*Improved the donate page.<br />
						</p>
					</div>
				</div>
			</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	</body>
</html>