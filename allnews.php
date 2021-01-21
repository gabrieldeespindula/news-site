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
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="style/css/style.css">
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">

        <title>Notícia Top</title>
    </head>

    <body>
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <?php include_once 'includes/header.php'; ?>
    <main>
        <div>
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center mt-5"><i class="fa fa-newspaper-o text-danger" aria-hidden="true"></i> Todas Notícias</h1>
            </div>
            <div class="row w-100">
                <?php
                $count = 1;
                while ($data = mysqli_fetch_array($result)):
                ?>
                <div class="card mx-auto my-5">
                    <div class="card-body text-center">
                        <a href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo '<img class="rounded img-fluid" height="250px" width="250px" src=data:image;base64,'.$data['img'].' />'; ?></a>
                    </div>
                    <div class="card-body text-center">
                        <a class="h6 card-text" href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo $data['titulo'] ?></a>
                        <h6 class="card-subtitle my-2 text-muted"><?php echo $data['data'] ?><h6>
                    </div>
                </div>
                <?php
                endwhile; ?>
            </div>
        </div>
    <main>

    <?php include_once 'includes/footer.php'; ?>

 
</body>
</html>