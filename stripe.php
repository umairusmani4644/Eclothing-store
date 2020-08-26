<?php
require_once('function.php');
connectdb();


if ($_POST) {

    $invid = mysqli_real_escape_string($conms, $_POST["invid"]);

    $gateway = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM payment_gateway WHERE id='4'"));

    $order = mysqli_fetch_array(mysqli_query($conms, "SELECT * FROM orrdr WHERE invid='".$invid."'"));

    $site = mysqli_fetch_array(mysqli_query($conms, "SELECT sitename, currency FROM general_setting WHERE id='1'"));

  $cc = trim($_POST['number']);
  $exp = $pieces = explode("/", $_POST['expiry']);
  $cvc = $_POST['cvc'];

  $emo = trim($exp[0]);
  $eyr = trim($exp[1]);

  $cnts = get_currency($order['cost'], $site[1], 'USD')*100;
  //echo get_currency($order['cost'], $site[1], 'USD');
  //echo '<br>'.$cnts;
  //echo '<br>'.$order['cost'];
  include_once 'libs/stripe-php/init.php';

          \Stripe\Stripe::setApiKey($gateway['val1']);

          try{
          $token = \Stripe\Token::create(array(
            "card" => array(
              "number" => "$cc",
              "exp_month" => $emo,
              "exp_year" => $eyr,
              "cvc" => "$cvc"
            )
          ));

          try{
          $charge = \Stripe\Charge::create(array(
          'card' => $token['id'],
          'currency' => 'USD',
          'amount' => $cnts,
          'description' => 'item',
            ));

          if ( $charge['status'] == 'succeeded' ) {
              
            $desc = 'Payment Via Credit Card.<br> Trx id: ' . $charge['balance_transaction'];

            $res = mysqli_query($conms, "UPDATE orrdr SET pst='1', paydet='".$desc."' WHERE invid='".$invid."'");

            if ($res) {
              $url = $baseurl . '/dashboard?msg=' . urlencode('Payment Successfull Via Credit Card');
              header('Location: '.$url);
              exit();
            } else {
              $url = $baseurl . '/dashboard?msg=' . urlencode('Payment Successfull But Error Occured. Please Contact With Admin.');
              header('Location: '.$url);
              exit();
            }


          } else {
            $url = $baseurl . '/checkout?invid='.$invid.'&msg=' . urlencode('Error Occured. Please Try Again.');
              header('Location: '.$url);
              exit();
          }

        }catch (Exception $e){
          $url = $baseurl . '/checkout?invid='.$invid.'&msg=' . urlencode($e->getMessage());
          header('Location: '.$url);
          exit();
          }

      }catch (Exception $e){
          $url = $baseurl . '/checkout?invid='.$invid.'&msg=' . urlencode($e->getMessage());
          header('Location: '.$url);
          exit();
          }

}