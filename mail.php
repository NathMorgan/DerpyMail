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
					<div id="mailclients">
						<span id="roundcube" class="mailbox rounded_corner">
							<img src="../images/roundcube_logo.png" alt="roundcube" width="200px">
							<div style="background-image: url(/images/roundcube.png);" class="buttonimage rounded_image"></div>
						</span>
						<span id="squirrelmail" class="mailbox rounded_corner">
							<img src="../images/squirrelmailmlp.png" alt="squirrelmail" width="200px">
							<div style="background-image: url(/images/squirrelmail.png);" class="buttonimage rounded_image"></div>
						</span>
						<br />
						<label for="remember" id="rememberthis">Remember my choice</label><input id="remember" type="checkbox" />
					</div>
				</div>
			</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	</body>
</html>