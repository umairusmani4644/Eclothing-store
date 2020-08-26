<?php
 require_once('function.php');
 connectdb();

 $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='3'"));
 $invid = mysqli_real_escape_string($conms, $_GET['invoice_id']);
 $secret = "SHANTO";
 $address = $_GET['address'];
 $value = $_GET['value'];
 $confirmations = $_GET['confirmations'];
 $value_in_btc = toBTC($_GET['value']);

 $trx_hash = $_GET['transaction_hash'];

 $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

 $btc_addi = $order['addi'];

 if (!empty($btc_addi)) {
   
  $btc = unserialize($btc_addi);

  if ($btc['bcam'] == $value_in_btc && $btc['bcid'] == $address && $secret == "SHANTO" && $confirmations > 2) {

    $desc = 'Payment Via Bitcoin. <br>TRX ID: ' . $trx_hash;

    $res = mysqli_query($conms, "UPDATE orrdr SET pst='1', paydet='".$desc."' WHERE invid='".$invid."'");

    if ($res) {
      echo 'Successed';
    } else {
      echo 'Failed';
    }

  }

 }