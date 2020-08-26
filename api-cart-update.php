<?php

require_once('function.php');
connectdb();

if(isset($_POST['unique'])) {

$un = mysqli_real_escape_string($conms, $_POST["unique"]);
$cccid = mysqli_real_escape_string($conms, $_POST["cccid"]);
$act = mysqli_real_escape_string($conms, $_POST["act"]);



$security = mysqli_fetch_array(mysqli_query($conms, "SELECT code FROM carrrt WHERE id='".$cccid."'"));

if($security[0]==$un){
$qnow = mysqli_fetch_array(mysqli_query($conms, "SELECT qty, rraate FROM carrrt WHERE id='".$cccid."'"));

if($act=="plus"){
$will = $qnow[0]+1;	
}else{
$will = $qnow[0]-1;
}

if($will<=1){
$will=1;	
}

$qry = mysqli_query($conms, "UPDATE carrrt SET qty='".$will."' WHERE id='".$cccid."'");

$subttl = $qnow[1]*$will;
if($qry){
	echo "$subttl";
	
}
	
}
}

?>