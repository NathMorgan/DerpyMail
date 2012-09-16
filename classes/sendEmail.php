<?php
class sendEmail
{
	function emailUser($to, $subject, $message)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Derpymail Admin <admin@derpymail.co.uk>' . "\r\n";
		
		mail($to, $subject, $message, $headers);
	}
}