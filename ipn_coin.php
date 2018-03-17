<?php

require_once('./config.php');
//$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);
$tot = $db->query("INSERT INTO logs SET log='".print_r($_POST,true)."', date='".date("Y-m-d H:i:s")."' ")->fetch();



    // Fill these in with the information from your CoinPayments.net account.
    $cp_merchant_id = '';
    $cp_ipn_secret = '';
    $cp_debug_email = '';


    function errorAndDie($error_msg) {
        global $cp_debug_email;
        global $db;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($_POST as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
            $db->query("INSERT INTO logs SET log='".$report."', date='".date("Y-m-d H:i:s")."' ");

        }
        $db->query("INSERT INTO logs SET log='".$error_msg."', date='".date("Y-m-d H:i:s ")."' ");
        die('IPN Error: '.$error_msg);

    }

    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
        errorAndDie('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        errorAndDie('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        errorAndDie('Error reading POST data');
    }

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
        errorAndDie('No or incorrect Merchant ID passed');
    }

    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
   // if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
        if ($hmac != $_SERVER['HTTP_HMAC']) { //<-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
            errorAndDie('HMAC signature does not match');
        }

    // HMAC Signature verified at this point, load some variables.

if($_POST['ipn_type']=="deposit"){
	    $txn_id = $_POST['txn_id'];
	    $address = $_POST['address'];
	    $currency1 = $_POST['currency'];
	    $confirms = $_POST['confirms'];
	    $status = intval($_POST['status']);
	    $status_text = $_POST['status_text'];
	    $amount = $_POST['amount'];
	    $fee = $_POST['fee'];

	$tot = $db->query("INSERT INTO logs SET log='deposit', date='".date("Y-m-d H:i:s")."' ")->fetch();



	
	$detalii= $db->query("SELECT x.".strtolower($currency1)." as usereth, x.id, b.who, b.".strtolower($currency1)." FROM user as x INNER JOIN address as b ON x.id=b.who WHERE b.".strtolower($currency1)."='".$address."' ",PDO::FETCH_ASSOC)->fetch();
mail('masterionic@gmail.com','deposit',$detalii['id']);
	$checa= $db->query("SELECT trxid FROM crypto WHERE trxid='".$txn_id."' ",PDO::FETCH_ASSOC)->fetch();
	$totxa = $db->query("INSERT INTO logs SET log='".print_r($detalii,true)."', date='".date("Y-m-d H:i:s")."' ")->fetch();

    if (($status >= 100 || $status == 2) && (empty($checa)) ) {

        $resx = $db->query("INSERT INTO logs SET log='Deposit sucessful-".$address."', date='".date("Y-m-d H:i:s")."' ");


	$ct= $detalii['usereth'];
	$ctn = $ct+($amount-$fee);
	
	
	
        $db->query("UPDATE user SET ".strtolower($currency1)."='".$ctn."' WHERE id=".$detalii['id']."");

        $trx = $txn_id;

        $db->query("INSERT INTO crypto SET who=".$detalii['id'].", address='".$address."', amount='".$amount."', fee='".$fee."', coin='".$currency1."', confirms='".$confirms."', trxid='".$trx."', status='".$status."', status_txt='".$status_text."',tm='".date("Y-m-d H:i:s")."'");

    } else if ($status < 0) {
        $rezxaa = $db->query("INSERT INTO logs SET log='Tranzactie Crypto status -- ".$status."', date='".date("Y-m-d H:i:s")."' ");
    } else {
         $resxa = $db->query("INSERT INTO logs SET log='Tranzactie Deposit Corecta else ??', date='".date("Y-m-d H:i:s")."' ");
    }
$resxa = $db->query("INSERT INTO logs SET log='Tranzactie Deposit Crypto FINISH', date='".date("Y-m-d H:i:s")."' ");
    die('IPN OK');
    
 } else if($_POST['ipn_type']=="withdrawal"){ 
 	$txn_id = $_POST['txn_id'];
	    $address = $_POST['address'];
	    $currency1 = $_POST['currency'];

	    $status = intval($_POST['status']);
	    $status_text = $_POST['status_text'];
	    $amount = $_POST['amount'];
	    $fee = $_POST['fee'];

	$tot = $db->query("INSERT INTO logs SET log='withdrawal', date='".date("Y-m-d H:i:s")."' ")->fetch();

	$detailtrx=$db->query("SELECT id, who FROM crypto WHERE withId='".$_POST['id']."'")->fetch();
	
	$detalii=$db->query("SELECT * FROM user WHERE id='".$detailtrx['who']."'")->fetch();	

	$checa= $db->query("SELECT trxid FROM crypto WHERE trxid='".$txn_id."' ",PDO::FETCH_ASSOC)->fetch();


    if (($status >= 100 || $status == 2) && (empty($checa)) ) {

        $resx = $db->query("INSERT INTO logs SET log='Withdrawal sucessful-".$address."', date='".date("Y-m-d H:i:s")."' ");

	//$curr=strtolower($currency1);
	$ct= $detalii[strtolower($currency1)];
	$ctn = $ct-$amount;
	mail('masterionic@gmail.com','withdrawal',$ctn);
        $db->query("UPDATE user SET ".strtolower($currency1)."='".$ctn."' WHERE id='".$detalii['id']."'");

        $trx = $txn_id;
	
	$db->query("UPDATE crypto SET who='".$detalii['id']."', address='".$address."', amount='".$amount."', fee='".$fee."', coin='".$currency1."', confirms='withdrawal', trxid='".$trx."', status='".$status."', status_txt='".$status_text."',tm='".date("Y-m-d H:i:s")."' WHERE withId='".$_POST['id']."'");
	

    } else if ($status < 0) {
        $rezxaa = $db->query("INSERT INTO logs SET log='Tranzactie Withdrwal Crypto status -- ".$status."', date='".date("Y-m-d H:i:s")."' ");
    } else {
         $resxa = $db->query("INSERT INTO logs SET log='Tranzactie Corecta else ??', date='".date("Y-m-d H:i:s")."' ");
    }
$resxa = $db->query("INSERT INTO logs SET log='Tranzactie Crypto Withdrwal FINISH', date='".date("Y-m-d H:i:s")."' ");
    die('IPN OK');
 }

?>
