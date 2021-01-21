<?php
// connecting
require_once '../database/dbconnectlogin.php';

// sessions
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: index.php');
endif;
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="../style/css/style.css">
        <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.css">
        <title>Add</title>
    </head>
    <body>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-5">
                    <h1 class=""><i class="fa fa-plus text-danger" aria-hidden="true"></i>  Adicione nova notícia</h1>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div>
                        <form action="../database/create.php" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="texto">Texto</label>
                                    <textarea rows="10" name="texto" class="form-control" id="texto" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="texto">Imagem</label>
                                    <input type="file" name="img" class="form-control" id="img" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12 text-center">
                                    <button id="btn" name="btn" class="btn btn-outline-success" type="submit">Concluir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>