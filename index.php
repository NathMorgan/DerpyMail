<?php
	include_once 'classes/config.php';
?>
<!DOCTYPE HTML>
<html>
	<?php require_once $root.'templates/head.php'; ?>
	<body>
		<div id="mainwrapper" class="center">
			<?php require_once $root.'templates/header.php'; ?>
			<div id="contentwrapper" class="rounded_corner">
				<div id="infobox" class="rounded_corner">
					<img src="/images/derpymail.png" id="derpymail" alt="Derpy picture"/>
					<div id="infoboxtext">
						<h2>Welcome to Derpymail!</h2>
						<br />
						<p>My name is Derpy Hooves, and I like delivering mail for everypony! I also like muffins.
						<br />
						<br />
						This is DerpyMail - a web based mail service for fans of My Little Pony - Friendship is Magic (and Derpy Hooves in particular!). We provide email addresses with the domain name "@derpymail.co.uk" for free, to anyone who wants one.<br /><br />To register for an account please use the registration form <a href="http://www.derpymail.co.uk/register">here!</a>
						<br />
						<br />
						<br />  
						DerpyMail is also on Twitter! Join the herd by clicking the Twitter muffin on the right, or click <a href="http://www.twitter.com/DerpyMail">here!</a>.
						<br />
						<br />
						</p>
					</div>
				</div>
				<div id="twitterwrapper">
					<div id="twitter" class="rounded_corner">
						<a href="http://twitter.com/DerpyMail">Twitter</a><img src="/images/small_muffin.png" alt="Muffin!" />
					</div>
					<div id="twitterdropdown">
						<ul>
							<?php require_once $root.'classes/twitter.php'; ?>
						</ul>
					</div>
				</div>
				<div class="fix_floats"></div>
			</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	</body>
</html>