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
        <title>Read</title>

    </head>
    <body>
        <header>
            <p><?php  print_r($_SESSION); ?></p>
            <?php 
            if (count($_SESSION) > 2): 
                if($_SESSION['msg'] != "0"):
            ?>
            <p> <?php echo $_SESSION['msg']; ?></p>
            <?php $_SESSION['msg'] = "0";
            endif;
            endif; ?>

            <h1>Olá <?php echo $data['name']?></h1>
            <a href="./database/logout.php">Log Out</a>
        </header>
        <main>

            <?php
            $sql = "SELECT * FROM news";
            $result = mysqli_query($connectnews, $sql);

            while ($data = mysqli_fetch_array($result)):
            ?>

            <div>
                <a href="edit.php?id=<?php echo $data['Id']; ?>"><p><?php echo $data['titulo']; ?></p></a>
            </div>

            <?php endwhile; ?>
            <div>
                <a href="add.php">add news</a>
            </div>
        </main>

    </body>
</html>