<?php
require_once('./config.php');

include('coinpayments.inc.php');
$cps = new CoinPaymentsAPI();
$cps->Setup();
$xax = $db->query("SELECT id FROM user WHERE email='".$_POST['cax']."'")->fetch();

$tot = $db->query("SELECT * FROM address WHERE who=".$xax['id'])->fetch();
if(empty($tot)){
    $tot = $db->query("INSERT INTO address SET who='$xax[id]' ")->fetch();
}


if(empty($tot['eth'])) {


    $result = $cps->GetCallbackAddress('eth','http://ns1-216-198.superdnsserver.net/ipn_coin.php');
    if ($result['error'] == 'ok') {
        $le = php_sapi_name() == 'cli' ? "\n" : '<br />';
        //print 'Address: ' . $result['result']['address'] . $le;
        //print_r($result);
        $db->query("UPDATE address SET eth='".$result['result']['address']."' WHERE who='$xax[id]' ");
	
    } else {
        print 'Error: ' . $result['error'] . "\n";
    }

}

if(empty($tot['ltct'])) {


    $result = $cps->GetCallbackAddress('ltct','http://ns1-216-198.superdnsserver.net/ipn_coin.php');
    if ($result['error'] == 'ok') {
        $le = php_sapi_name() == 'cli' ? "\n" : '<br />';
        //print 'Address: ' . $result['result']['address'] . $le;
        //print_r($result);
        $db->query("UPDATE address SET ltct='".$result['result']['address']."' WHERE who='$xax[id]' ");

    } else {
        print 'Error: ' . $result['error'] . "\n";
    }

}




