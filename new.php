<?php
require_once('newfunction.php');

if(connectdb()){
    echo "TRUE";
}
else{
    echo "FALSE";
}
