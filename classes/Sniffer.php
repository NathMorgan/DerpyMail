<?php
include_once 'config.php';

if(isset($_GET['page']))
	new Sniffer($_GET['page']);
	
class Sniffer{
	
	function __construct($page) {
		global $root;
		Sniffer::Page($page, $root);
	}
	
	function Page($page, $root){
		switch($page){
			case 'mail': include($root.'mail.php');break;
			case 'register': include($root.'register.php');break;
			case 'donate':include($root.'donate.php');break;
			case 'about':include($root.'about.php');break;
			case 'terms':include($root.'terms.php');break;
			case 'resetpassword':include($root.'resetpassword.php');break;
			case 'contact':include($root.'contact.php');break;
			case 'thankyou':include($root.'thankyou.php');break;
			case 'changelog':include($root.'changelog.php');break;
			case 'roundcube':include($root.'roundcube/index.php');break;
			case 'squirrelmail':include($root.'squirrelmail/index.php');break;
			case 'human':header('Location: http://www.youtube.com/watch?v=PcuRCV3sDOY');break;
			default: include($root.'404.php');break;
		}
	}
}
?>