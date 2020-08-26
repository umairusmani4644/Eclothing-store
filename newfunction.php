<?php
$dbname = "techtlws_SCom";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
function Connectdb()
{
    global $dbname, $dbuser, $dbhost, $dbpass;
    $conms = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname); //connect mysqli
    if(!$conms) return false;
    return true;
}

?>