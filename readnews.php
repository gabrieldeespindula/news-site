<!DOCTYPE html>
<?php
// connection
require_once 'database/dbconnectnews.php';

$id = $_GET['id'];

$sql = "SELECT * FROM news WHERE Id = '$id'";
$result = mysqli_query($connectnews, $sql);
$data = mysqli_fetch_array($result);
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Notícias Top: <?php echo $data['titulo']; ?> </title>
    </head>
    <body>
        <h1> <?php echo $data['titulo']; ?> </h1>
        <p> <?php echo $data['data']; ?> </p>
        <p> <?php echo $data['texto']; ?> </p>

        <?php echo '<img height="250px" width="250px" src=data:image;base64,'.$data['img'].' />'; ?>
        
    </body>
</html>