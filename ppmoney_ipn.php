<?php
 require_once('function.php');
 connectdb();

 $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='2'"));
 $site = mysqli_fetch_array(mysqli_query($conms, "SELECT sitename, currency FROM general_setting WHERE id='1'"));
  $passphrase = strtoupper(md5($gateway['val2']));

  define('ALTERNATE_PHRASE_HASH',  $passphrase);

  $string = $_POST['PAYMENT_ID'] .':'. $_POST['PAYEE_ACCOUNT'] . ':'. $_POST['PAYMENT_AMOUNT'] . ':' . $_POST['PAYMENT_UNITS'] . ':' . $_POST['PAYMENT_BATCH_NUM'] . ':'. $_POST['PAYER_ACCOUNT'] . ':' . ALTERNATE_PHRASE_HASH . ':' . $_POST['TIMESTAMPGMT'];

  $hash = strtoupper(md5($string));
  $hash2 = $_POST['V2_HASH'];

  if ( $hash == $hash2 ) {

    $amo = $_POST['PAYMENT_AMOUNT'];
    $unit = $_POST['PAYMENT_UNITS'];
    $invid = $_POST['PAYMENT_ID'];

    $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

    if( $_POST['PAYEE_ACCOUNT'] == $gateway['val1'] && $unit == $site[1] && $amo == $order['cost'] ) {

      $desc = 'Payment Via Perfect Money. <br>TRX ID: ' . $_POST['PAYMENT_BATCH_NUM'];

      $res = mysqli_query($conms, "UPDATE orrdr SET pst='1', paydet='".$desc."' WHERE invid='".$invid."'");

      if ($res) {
        echo 'Successed';
      } else {
        echo 'Failed';
      }

    }

  }