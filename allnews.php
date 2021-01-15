<!DOCTYPE html>
<?php
// connection
require_once 'database/dbconnectnews.php';

$sql = "SELECT * FROM news ORDER BY Id DESC";
$result = mysqli_query($connectnews, $sql);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  type="text/css" href="./css/index.css">

        <title>Notícia Top</title>
    </head>

    <body>
    <?php include_once 'includes/header.php'; ?>
    <main>
        <div class="linhaall">
            <?php
            $count = 1;
            while ($data = mysqli_fetch_array($result)):
            ?>
            <div class="noticia">
                <a href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo '<img height="250px" width="250px" src=data:image;base64,'.$data['img'].' />'; ?></a>
                <a href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo $data['titulo'] ?></a>
                <p><?php echo $data['data'] ?><p>
            </div>
            <?php
            $count ++;
            if($count == 6):
            ?>
        </div>
        <div class="linha">
            <?php $count = 1;
            endif;
            if($count == 26):
                break;
            endif;
            endwhile; ?>
        </div>
    <main>

    <?php include_once 'includes/footer.php'; ?>

 
</body>
</html>