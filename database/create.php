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



$titulo = clear($_POST['titulo']);
$texto = clear($_POST['texto']);
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y H:i');

$img = base64_encode(file_get_contents(addslashes($_FILES['img']['tmp_name'])));
echo "<pre>";


$extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
if($extension == "jpeg" or $extension == "jpg" or $extension == "png"):
    $sql = "INSERT INTO news (titulo, texto, data, img) VALUES ('$titulo', '$texto', '$data', '$img') ";
    if (mysqli_query($connectnews, $sql)):
        $_SESSION['msg'] = "Registered successfully";
        header('Location: ../adm/read.php');
    else: 
        $_SESSION['msg'] = "Registration error";
        header('Location: ../adm/read.php');
    endif;
else:
    echo "$extension not allowed!<br>";
endif;

?>