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
						<h2>Contact</h2>
						Did Derpy Derp? Have an account issue (or an issue of any kind) ? Please feel free to let us know using the form below!
						<div class="center" style="color: red"><?php global $error; echo $error; ?></div>
						<form name="contact" action="/contact/" method="post">
							<div id="contactinputs">
								<p>
									<label for="reason">Help me with:</label>
									<select name="reason">
										<option value="acctproblems">Account Problems</option>
										<option value="donate">Donations</option>
										<option value="general">General Inquiries</option>
										<option value="emailbugs">Email Client Bugs</option>
										<option value="sitebugs">Site Bugs</option>
										<option value="suggest">Suggestions/Improvements</option>
									</select>
								</p>
								<p>
									<label for="email">Email:</label>
									<input type="text" name="email" />
								</p>
								<p>
									<label for="subject">Subject:</label>
									<input type="text" name="subject" />
								</p>
								<p>
									<label for="description">Description:</label>
									<textarea name="description"></textarea>
								</p>
							</div>
							<p class="center">
								<button type="submit" name="submit">Submit</button>
							</p>
						</form>
					</div>
				</div>
			<?php require_once $root.'templates/footer.php'; ?>
		</div>
	<body>
<html>