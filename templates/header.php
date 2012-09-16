<header>				
	<a href="/"><img src="/images/derpylogo.png" alt="DerpyMail logo" /></a>
		<nav>
			<table>
				<tr>
				<td>
					<a href="/mail" <?php if($page == "mail") echo'class="selected"'; ?>><img src="/images/navicons/mailicon.png">MAIL</a>
				</td>
				<td>
					<a href="/register" <?php if($page == "register") echo'class="selected"'; ?>><img src="/images/navicons/registericon.png">REGISTER</a>
				</td>
				<td>
					<a href="/donate" <?php if($page == "donate") echo'class="selected"'; ?>><img src="/images/navicons/donateicon.png">DONATE</a>
				</td>
				<td>	
					<a href="/about" <?php if($page == "about") echo'class="selected"'; ?>><img src="/images/navicons/abouticon.png">ABOUT</a>
				</td>
				</tr>
			</table>
		</nav>
</header>
