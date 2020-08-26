<?php
require_once('../function.php');
connectdb();
$i=1;
while ($i <= 24) {


//mysqli_query($conms, "INSERT INTO childcat SET parent='".$i."', name='Child Cat'");
//mysqli_query($conms, "INSERT INTO subcat SET parent='".$i."', name='Sub Cat'");

/*
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img2.jpg'");
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img3.jpg'");
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img4.jpg'");
*/
$i++;
}


?>