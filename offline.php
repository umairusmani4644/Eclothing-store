<?php
require_once('function.php');
connectdb();

$invid = mysqli_real_escape_string($conms, $_POST['invid']);
$details = mysqli_real_escape_string($conms, $_POST['detai']);
$paymode = mysqli_real_escape_string($conms, $_POST["paymode"]);


$pdet = mysqli_fetch_array(mysqli_query($conms, "SELECT name FROM payment WHERE id='".$paymode."'"));
$paymentdetails = "PAYMENT MODE: $pdet[0]  <br>    $details";
//echo $paymentdetails;
$res = mysqli_query($conms, "UPDATE orrdr SET paydet='".$paymentdetails."' WHERE invid='".$invid."'");

if ($res) {
    //echo 'Payment Details Updated!';
  header('Location: ' . $baseurl . '/dashboard?msg=' . urlencode('Payment Details Updated!'));
  exit();
} else {
  header('Location: ' . $baseurl . '/checkout?invid=' . $invid);
  exit();
}