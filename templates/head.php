<head>
	<title><?=ucfirst($page); ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="Keywords" content="DerpyMail, Derpy Mail, Derpy, Derpy Hooves, derpymail.co.uk, Mail, Pony, My little pony" />
	<meta name="description" content="DerpyMail - Making your mail 20% derpier since 2012"> 
	<link rel="stylesheet" href="/styles/default.css" />
	<script type="text/javascript" src="/scripts/jquery.js"></script>
	<?php
		switch($page){
			case 'mail': echo'<link rel="stylesheet" href="/styles/mail.css" /> <script type="text/javascript" src="/scripts/mailselect.js"></script><script type="text/javascript" src="/scripts/cookie.js"></script>';break;
			case 'register': echo'<link rel="stylesheet" href="/styles/register.css" /> <script type="text/javascript" src="/scripts/jcheck.js"></script>';break;
			case 'donate': echo'<link rel="stylesheet" href="/styles/donate.css" /> <script type="text/javascript" src="/scripts/derpymath.js"></script>';break;
			case 'about': echo'<link rel="stylesheet" href="/styles/about.css" />';break;
			case 'contact': echo'<link rel="stylesheet" href="/styles/contact.css" />';break;
			case 'Derpymail': echo'<link rel="stylesheet" href="/styles/index.css" /><script type="text/javascript">$(document).ready(function(){$("#twitter img").click(function(){$(this).parent().next().slideToggle()})})</script>';break;
			case 'resetpassword': echo'<link rel="stylesheet" href="/styles/resetpassword.css" />';break;
			case 'changelog': echo'<link rel="stylesheet" href="/styles/changelog.css" />';break;
			case '404': echo'<link rel="stylesheet" href="/styles/404.css" />';break;
		}
	?>
	<!--[if lt IE 9]>
		<script src="/newderpymail/scripts/html5shiv.js"></script>
	<![endif]-->
	<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-33442150-1']);
		  _gaq.push(['_setDomainName', 'derpymail.co.uk']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
	</script>
</head>