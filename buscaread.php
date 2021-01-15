<?php
// connecting
require_once 'database/dbconnectlogin.php';
require_once 'database/dbconnectnews.php';

// sessions
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('Location: adm.php');
endif;

//data
$id = $_SESSION['id_user'];
$sql = "SELECT * FROM news WHERE Id = '$id'";
$result = mysqli_query($connectlogin, $sql);
$data = mysqli_fetch_array($result);
mysqli_close($connectlogin);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/adm.css">
        <title>Read</title>

    </head>
    <body>
        <header class="center">
            <?php 
            if (count($_SESSION) > 2): 
                if($_SESSION['msg'] != "0"):
            ?>
            <p> <?php echo $_SESSION['msg']; ?></p>
            <?php $_SESSION['msg'] = "0";
            endif;
            endif; ?>

            <a href="read.php" style="margin-right: 30px;" class="font-20 padding">Voltar para todas as notícias</a>
            <a class="font-20" href="./database/logout.php">SAIR</a>
            <form action="buscaread.php" class="padding form" method="POST">
                <input placeholder="Busque Notícias" type="text" name="busca" />
                <button class="btn-busca" type="submit" >Buscar</button>
            </form>
        </header>
        <main class="center list" >

            <?php
            $busca = mysqli_escape_string($connectnews, $_POST['busca']);
            $sql = "SELECT * FROM news WHERE titulo LIKE '%$busca%' ORDER BY Id DESC";
            $result = mysqli_query($connectnews, $sql);

            while ($data = mysqli_fetch_array($result)):
            ?>

            <div style="border: 1px solid #ebebeb;">
                <a class="titulos" href="edit.php?id=<?php echo $data['Id']; ?>"><p><?php echo $data['titulo']; ?></p></a>
            </div>

            <?php endwhile; ?>
        </main>
        <div class="center">
            <a class="titulos" href="add.php"><button class="button">ADICIONE NOVAS NOTÍCIAS</button></a>
        </div>

    </body>
</html>