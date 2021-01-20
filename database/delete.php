<?php
// session
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: ../adm/adm.php');
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

if(isset($_POST['btn-delete'])):

    $sql = "DELETE FROM news WHERE Id = '$id'";

    if (mysqli_query($connectnews, $sql)):
        $_SESSION['msg'] = "Deleted successfully";
        header('Location: ../adm/read.php');
    else: 
        $_SESSION['msg'] = "Error in deleting";
        header('Location: ../adm/read.php');
    endif;
endif;
if(isset($_POST['btn-save'])):
    header('Location: ../adm/read.php');
endif;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/adm.css">
        <title>Delete</title>
    </head>
    <body>
        <form class="center padding" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1 class="padding font-20">VOCÊ TEM CERTEZA QUE DESEJA EXCLUIR " <?php echo $data['titulo'] ?> " </h1>
        <button style="margin-right: 10px;" class="button" id="btn" name="btn-delete" type="submit">SIM, EXCLUIR</button>
        <button style="margin-left: 10px;" class="button" id="btn" name="btn-save" type="submit">NÃO, MANTER</button>
        </form>    
    </body>
</html>

