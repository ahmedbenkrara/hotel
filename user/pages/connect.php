<?php

$ser = 'localhost';
$user = 'mery';
$pass = 'mery123456';
$database = 'hotel';

$con = mysqli_connect($ser,$user,$pass,$database);
if(!$con){
    echo 'Connection error : '. mysqli_connect_error();
}

?>