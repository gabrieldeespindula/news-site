<?php
// session
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: ../adm.php');
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
$titulo = clear($_POST['tituloedit']);
$texto = clear($_POST['textoedit']);
$data = date('d-m-Y H:i');


if($_FILES['imgedit']['size'] == 0):
    $sql = "UPDATE news SET titulo ='$titulo', texto = '$texto' WHERE Id = '$id' ;";
    if (mysqli_query($connectnews, $sql)):
        $_SESSION['msg'] = "Upload successfully";
        header('Location: ../read.php');
    else: 
        $_SESSION['msg'] = "Upload error";
        header('Location: ../read.php');
    endif;
else:
    $img = base64_encode(file_get_contents(addslashes($_FILES['imgedit']['tmp_name'])));
    $extension = pathinfo($_FILES['imgedit']['name'], PATHINFO_EXTENSION);
    if($extension == "jpeg" or $extension == "jpg" or $extension == "png"):
        $sql = "UPDATE news SET titulo ='$titulo', texto = '$texto', img = '$img' WHERE Id = '$id' ;";
        if (mysqli_query($connectnews, $sql)):
            $_SESSION['msg'] = "Upload successfully";
            header('Location: ../read.php');
        else: 
            $_SESSION['msg'] = "Upload error";
            header('Location: ../read.php');
        endif;
    else:
        echo "$extension not allowed!<br>";
    endif;
endif;

?>