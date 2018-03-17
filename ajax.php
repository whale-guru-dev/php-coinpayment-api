<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




    require('./coinpayments.inc.php');
    $cps = new CoinPaymentsAPI();
    $cps->Setup();

    $result = $cps->GetRates();
    if ($result['error'] == 'ok') {

        $usd = $result['result']['USD']['rate_btc']; // EUROOOO
        $val_in_btc = $usd * 1;
        
        $eur = $result['result']['EUR']['rate_btc']; // EUROOOO
        $val_in_btc_eur = $eur * 1;


        $eth = $result['result']['ETH']['rate_btc']; // Etherum
        $totalbtc = $eth / $usd ;
        $totalbtc = $totalbtc - ((1 / 100) * $totalbtc);
        $ethk = number_format($totalbtc, 2, '.', ',');
        
        $eth = $result['result']['ETH']['rate_btc']; // Etherum
        $totalbtc = $eth / $eur ;
        $totalbtc = $totalbtc - ((1 / 100) * $totalbtc);
        $ethk_eur = number_format($totalbtc, 2, '.', ',');
        
        $ltct = $result['result']['LTCT']['rate_btc']; // Etherum
        $totalbtc = $ltct / $usd ;
        $totalbtc = $totalbtc - ((1 / 100) * $totalbtc);
        $ltctk = number_format($totalbtc, 2, '.', ',');


        header('Content-Type: application/json');

        echo '{
  "eth": "' . $ethk . '",
  "ltct": "' . $ltctk . '",
  "eth_eur": "' . $ethk_eur . '"
}';

    }
    