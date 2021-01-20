<?php
// Ending session
session_start();
if(!isset($_SESSION['logged'])):
    header ('Location: adm.php');
endif;
session_unset();
session_destroy();
header('location: ../index.php');
?>