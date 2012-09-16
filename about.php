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
					<div id="tuqiri" class="bio">
						<img src="/images/tuqiri.png" />
						<div id="tuqiribio">
							<p class="bioheader">Name:</p> <p id ="biotext">Tuqiri</p> <br /><br />
							<p class="bioheader">Real Name:</p> <p id ="biotext">Nathan Morgan </p> <br /><br />
							<p class="bioheader">Role:</p> <p id ="biotext">Backend coding. </p> <br /><br />
							<p class="bioheader">Other Info:</p> <p id ="biotext">Second year student at Teesside University.
						</div>
					</div>
					<div id="dragoshi" class="bio">
						<img src="/images/dragoshi.png" />
						<div id="dragoshibio">
							<p class="bioheader">Name:</p> <p id ="biotext">Dragoshi </p> <br /><br />
							<p class="bioheader">Real Name:</p> <p id ="biotext">Simon Holian </p> <br /><br />
							<p class="bioheader">Role:</p> <p id ="biotext">Front-end HTML/CSS. Customer Relations.</p> <br /><br />
							<p class="bioheader">Other Info:</p> <p id ="biotext">Runs a Computer Repair/Website Design Company.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php require_once $root.'templates/footer.php'; ?>
	</body>
</html>