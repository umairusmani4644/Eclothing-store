<?php
 require_once('function.php');
 connectdb();

 $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='1'"));
 $site = mysqli_fetch_array(mysqli_query($conms, "SELECT sitename, currency FROM general_setting WHERE id='1'"));

  $raw_post_data = file_get_contents('php://input');
  $raw_post_array = explode('&', $raw_post_data);
  $myPost = array();
  foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
      $myPost[$keyval[0]] = urldecode($keyval[1]);
  }

  $req = 'cmd=_notify-validate';
  if(function_exists('get_magic_quotes_gpc')) {
      $get_magic_quotes_exists = true;
  }
  foreach ($myPost as $key => $value) {
      if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
          $value = urlencode(stripslashes($value));
      } else {
          $value = urlencode($value);
      }
      $req .= "&$key=$value";
  }


  $paypalURL = "https://secure.paypal.com/cgi-bin/webscr?";

  $res = get_file_contents( $paypalURL . $req );

  $tokens = explode("\r\n\r\n", trim($res));
  $result = trim(end($tokens));

  if ( strcmp($result, "VERIFIED") == 0 || strcasecmp($result, "VERIFIED") == 0 ) {

    $receiver_email   = $_POST['receiver_email'];
    $mc_currency    = $_POST['mc_currency'];
    $invid       = mysqli_real_escape_string($conms, $_POST['custom']);
    $mc_gross     = $_POST['mc_gross'];

    $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

    if ( $receiver_email == $gateway['val1'] && $mc_currency == $site[1] && $mc_gross == $order['cost'] ) {

      $desc = 'Payment Via Paypal. <br>TRX ID: ' . $_POST['ipn_track_id'];
      $res = mysqli_query($conms, "UPDATE orrdr SET pst='1', paydet='".$desc."' WHERE invid='".$invid."'");

      if ($res) {
        echo 'Successed';
      } else {
        echo 'Failed';
      }

    }

  }