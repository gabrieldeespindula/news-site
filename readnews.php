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
        <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="style/css/style.css">
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
    </head>
    <body>
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <?php include_once 'includes/header.php'; ?>

        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="row mt-5">
                        <div class="col-sm-12 w-100  text-center">
                            <h1 class=""> <?php echo $data['titulo'] ?> </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb-5 text-center">
                            <h6 class="text-muted"> <?php echo $data['data']; ?> </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12  text-left">
                            <p> <?php echo $data['texto']; ?> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12  text-center">
                            <?php echo '<img class="rounded img-fluid" height="400px" width="400px" src=data:image;base64,'.$data['img'].' />'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>