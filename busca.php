<!DOCTYPE html>
<?php
// connection
require_once 'database/dbconnectnews.php';

$busca = mysqli_escape_string($connectnews, $_POST['busca']);
$sql = "SELECT * FROM news WHERE titulo LIKE '%$busca%' ORDER BY Id DESC";
$result = mysqli_query($connectnews, $sql);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">

        <title>Notícia Top</title>
    </head>

    <body>
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <?php include_once 'includes/header.php'; ?>
    <p>Resultados da busca por: "<?php echo $busca; ?>"</p>
    <main>
        <div>
            <?php
            $count = 1;
            while ($data = mysqli_fetch_array($result)):
            ?>
            <div>
                <a href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo '<img height="250px" width="250px" src=data:image;base64,'.$data['img'].' />'; ?></a>
                <a href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo $data['titulo'] ?></a>
                <p><?php echo $data['data'] ?><p>
            </div>
            <?php
            $count ++;
            if($count == 4):
            ?>
        </div>
        <div>
            <?php $count = 1;
            endif;
            if($count == 10):
                break;
            endif;
            endwhile; ?>
        </div>
    <main>
    <?php include_once 'includes/footer.php'; ?>

 
</body>
</html>