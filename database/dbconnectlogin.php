<?php

$servername = "localhost";
$username = "root";
$password = "";
$dblogin = "logindb";

$connectlogin = mysqli_connect($servername, $username, $password, $dblogin);

if(mysqli_connect_error()):
    echo "Connection error: ".mysqli_connect_error();
endif;
?>