<?php

include_once "paypal.class.php";

$p = new paypal_class;

global $sqlusername;
global $sqlpassword;
global $sqldatabase;

if ($p->validate_ipn()) {
	if($p->ipn_data['payment_status'] == 'Completed'){
		$amount = $p->ipn_data['mc_gross'] - $p->ipn_data['mc_fee'];
		$mysqli = new mysqli("localhost", "$sqlusername", "$sqlpassword", "$sqldatabase");
		$result = $mysqli->query("
						SELECT
							`id`
						FROM
							`users`
						WHERE
							`backupEmail` = '".mysql_escape_string($p->ipn_data['payer_email'])."'
						OR
							`email` = '".mysql_escape_string($p->ipn_data['payer_email'])."'
						");
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$userid = $row['id'];
		}
		else
			$userid = 0;
		$mysqli->query("INSERT INTO
							`donations`
								(`transaction_id`,`donor_email`,`currency`,`amount`,`id_users`)
							VALUES(
								'".mysql_escape_string($p->ipn_data['txn_id'])."',
								'".mysql_escape_string($p->ipn_data['payer_email'])."',
								'".mysql_escape_string($p->ipn_data['mc_currency'])."',
								'".mysql_escape_string($amount)."',
								'".$userid."'
							)
						");
		}
	}
?>