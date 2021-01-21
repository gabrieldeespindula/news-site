<?php
// session
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: ../adm/index.php');
endif;

// connection
require_once 'dbconnectnews.php';
// clear
function clear($input){
    global $connectnews;
    // sql
    $var = mysqli_escape_string($connectnews, $input);
    // xss
    $var = htmlspecialchars($var);
    return $var;
}

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE Id = '$id'";
$result = mysqli_query($connectnews, $sql);
$data = mysqli_fetch_array($result);

$sql = "DELETE FROM news WHERE Id = '$id'";

if (mysqli_query($connectnews, $sql)):
    $_SESSION['msg'] = "Deleted successfully";
    header('Location: ../adm/read.php');
else: 
    $_SESSION['msg'] = "Error in deleting";
    header('Location: ../adm/read.php');
endif;

if(isset($_POST['btn-save'])):
    header('Location: ../adm/read.php');
endif;

?>


