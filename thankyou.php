<?php
	include_once 'classes/config.php';
?>
<!DOCTYPE HTML>
<html style="height: 100%;">
	<?php require_once $root.'templates/head.php'; ?>
	<body>
		<div id="mainwrapper">
			<?php require_once $root.'templates/header.php'; ?>
				<div id="contentwrapper" class="rounded_corner">
					<div id="pagewrapper" class="rounded_corner">
						<img src="/images/derpymail.png" id="derpymail" alt="Derpy picture"/>
						<h2>Thank you</h2>
						Thank you for donating to DerpyMail, your contrbution will help towards making the site better for everypony(and making sure Derpy gets her muffins). If you wish to be on the Derpy friends list on the donate page, please fill out your name below.
						<form name="thankyou" action="/thankyou/" class="center" method="post">
							<input type="hidden" value="<?=$_POST['txn_id']?>" />
							<p>
								<label for="name">Name:</label>
								<input type="text" name="name" />
							</p>
							<button type="submit">Submit</button>
						</form>
					</div>
				</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	</body>
</html>