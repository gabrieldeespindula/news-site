<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbnews = "news";

$connectnews = mysqli_connect($servername, $username, $password, $dbnews);

if(mysqli_connect_error()):
    echo "Connection error: ".mysqli_connect_error();
endif;
?>
