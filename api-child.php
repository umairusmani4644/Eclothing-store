<?php
require_once('function.php');
connectdb();
session_start();

$lstid = mysqli_real_escape_string($conms, $_POST['lstid']);
if($lstid == ""){
	$start = 0;
}else{
	$start= $lstid;
}


$ccid = mysqli_real_escape_string($conms, $_POST['cid']);
///----------------------------------------------------------------------->>>>>>> GENERATE THE ARRAY
$allp = "";
$i = 0;
$ddaa = mysqli_query($conms, "SELECT id FROM products WHERE parent='".$ccid."' ORDER BY id ASC");
while($data = mysqli_fetch_array($ddaa)){
$allp[] = "$data[0]";
$i++;
}
///----------------------------------------------------------------------->>>>>>> GENERATE THE ARRAY

$ttl = count($allp);

if($i == 0){
echo "<h1 style='text-align:center;'>NO PRODUCT FOUND</h1>";
echo "<input type=\"hidden\" id=\"sesh\" value=\"1\">";
exit();
}



$out = array_slice($allp, $start, 9);

$lastuu = $start;
foreach ($out as $id) {
echo singlegrid($id);
$lastuu++;
}

$sssesh = $lastuu+1;
if($sssesh>=$ttl){
echo "<input type=\"hidden\" id=\"sesh\" value=\"1\">";
}

echo "<div class=\"row\">";
//echo "$ttl";
echo "<input type=\"hidden\" id=\"las\" value=\"$lstid\">";
echo "<input type=\"hidden\" id=\"lastuu\" value=\"$lastuu\">";
echo "</div>";
?>



	
