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
        <link rel="stylesheet"  type="text/css" href="./css/index.css">
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <h1 class="titulo"> <?php echo $data['titulo'] ?> </h1>
        <p class="data"> <?php echo $data['data']; ?> </p>
        <p class="texto"> <?php echo $data['texto']; ?> </p>
        <div class="img">
            <?php echo '<img height="500px" width="500px" src=data:image;base64,'.$data['img'].' />'; ?>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>