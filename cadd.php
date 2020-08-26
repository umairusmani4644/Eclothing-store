<?php

include('include-global.php');
connectdb();

if(isset($_POST['unique'])) {

$un = mysqli_real_escape_string($conms, $_POST["unique"]);
$pid = mysqli_real_escape_string($conms, $_POST["id"]);
$qty = mysqli_real_escape_string($conms, $_POST["qty"]);

$pdet = mysqli_fetch_array(mysqli_query($conms, "SELECT rate, stock, sho, offtyp, offamo, offtill, featured FROM products WHERE id='".$pid."'"));

/////////////------------------------------>>>>>>>>PRODUCT PRICE
if($pdet['offtyp']==0){

$rraate = $pdet[0];

}elseif($pdet['offtyp']==1) {

$per = $pdet['offamo']/100;
$dis = $pdet['rate']*$per;
$disamo = $pdet['rate']-$dis;
$rraate = $disamo;

}elseif ($pdet['offtyp']==2) {
$disamo = $pdet['rate']-$pdet['offamo'];
$rraate = $disamo;
}
/////////////------------------------------>>>>>>>>PRODUCT PRICE



mysqli_query($conms, "INSERT INTO carrrt SET code='".$un."', pid='".$pid."', qty='".$qty."', rraate='".$rraate."'");

 echo "Added To Cart...";
}
?>