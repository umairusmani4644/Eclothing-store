<?php
require_once('../function.php');
connectdb();
$i=1;
while ($i <= 864) {



mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img1.jpg'");
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img2.jpg'");
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img3.jpg'");
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img4.jpg'");
mysqli_query($conms, "INSERT INTO moreimg SET assignto='".$i."', img='img5.jpg'");



$i++;
}


?>