<?php

include('include-global.php');
connectdb();

if(isset($_POST['unique'])) {

$un = mysqli_real_escape_string($conms, $_POST["unique"]);
$cccid = mysqli_real_escape_string($conms, $_POST["cccid"]);


$security = mysqli_fetch_array(mysqli_query($conms, "SELECT code FROM carrrt WHERE id='".$cccid."'"));

if($security[0]==$un){

	$qry = mysqli_query($conms, "DELETE FROM carrrt WHERE id='".$cccid."'");


if($qry){
	echo "Done";
	
}else{
	echo "Not DOne";
	
}
}
}
?>