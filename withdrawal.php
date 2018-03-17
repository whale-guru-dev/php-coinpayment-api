<?php
require_once('./config.php');

include('coinpayments.inc.php');
$cps = new CoinPaymentsAPI();
$cps->Setup();
$xax = $db->query("SELECT * FROM user WHERE email='".$_POST['cax']."'")->fetch();


$amt=$_POST["amount"];
$addr=$_POST["addr"];
$coin=$_POST["coin"];

if ($coin=="LTCT"){

	if($amt<=$xax['ltct']){
		$result = $cps->CreateWithdrawal($amt, 'ltct', $addr);
		if ($result['error'] == 'ok') {
		
			$db->query("INSERT INTO crypto SET who='".$xax['id']."', address='".$addr."', amount='".$amt."', fee= '0', coin='ltct',withId = '".$result['result']['id']."', confirms='withdrawal' ,tm='".date("Y-m-d H:i:s")."'");
			print 'Withdrawal created with ID: '.$result['result']['id'].'  Pending...';
		} else {
			print 'Error: '.$result['error']."\n";
		}
	}else {
		print 'Error: You can withdrawal less than '.$xax['ltct']."\n";
	}
}else if($coin=="ETH"){

	if($amt<=$xax['eth']){
		$result = $cps->CreateWithdrawal($amt, 'eth', $addr);
		if ($result['error'] == 'ok') {
		
			$db->query("INSERT INTO crypto SET who='".$xax['id']."', address='".$addr."', amount='".$amt."', fee= '0', coin='eth',withId = '".$result['result']['id']."', confirms='withdrawal' ,tm='".date("Y-m-d H:i:s")."'");
			print 'Withdrawal created with ID: '.$result['result']['id'].'  Pending...';
		} else {
			print 'Error: '.$result['error']."\n";
		}
	}else {
		print 'Error: You can withdrawal less than '.$xax['eth']."\n";
	}
}


