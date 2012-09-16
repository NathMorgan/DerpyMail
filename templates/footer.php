<link rel="stylesheet" href="../styles/footer.css" />
<footer class="roundedCorner">
	<div id="footerwrapper">
		&copy; <a href="http://www.dragonetit.co.uk">DragoNet IT</a> 2012. All rights reserved.
		<br />
		<a id="footerlinks" href="/terms/">Terms</a> |
		<a id="footerlinks" href="/contact/">Contact us</a> |
		<a id="footerlinks" href="http://www.twitter.com/derpymail">Twitter</a> |
		<a id="footerlinks" href="http://steamcommunity.com/groups/OfficialDerpyMail">Steam</a> |
		<a id="footerlinks" href="http://www.ponychan.net/chan/collab/res/38222.html">Pony Chan</a>
		<br /> 
		Design by: <a href="http://tuqiri.net">Tuqiri</a> and <a href="http://www.furaffinity.net/user/dragoshi">Dragoshi</a><br />
		<?php
			global $hitcount;
			global $incoming;
			global $outgoing;
			echo"<b>Hit Count: $hitcount</b><br />";
			echo"<b>Mail sent: $outgoing , Mail received: $incoming </b>";
		?>
	</div>
</footer>