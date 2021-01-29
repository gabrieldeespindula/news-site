<?php
// connecting
require_once '../database/dbconnectlogin.php';
require_once '../database/dbconnectnews.php';

// sessions
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('Location: index.php');
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
        <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.css">
        <title>Read</title>

    </head>
    <body>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <?php 
        if (isset($_SESSION['msg'])): 
            if($_SESSION['msg'] != "0"):
        ?>
        <p> <?php echo $_SESSION['msg']; ?></p>
        <?php $_SESSION['msg'] = "0";
        endif;
        endif; ?>
        <div class="my-3 w-100 row justify-content-center">
            <a class="btn btn-outline-info" href="../database/logout.php">SAIR</a>
        </div>
        <main>
        <div class="col-md-12 w-100">
            <div class="row justify-content-center">
                <div class="col-md-4 my-auto">
                    <div class="row justify-content-center">
                        <form action="buscaread.php" class="form-inline" method="POST">
                            <input placeholder="Busque Notícias" type="search" class="form-control" name="busca" />
                            <button type="submit" class="ml-2 btn btn-dark" >Buscar</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 my-auto">
                    <h1 class="text-center"><i class="fa fa-newspaper-o text-info" aria-hidden="true"></i>  Notícias no Banco de Dados</h1>
                </div>
                <div class="col-md-4 my-auto">
                    <div class="row justify-content-center">
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#modalAdicionar" >Adicionar</button>
                    </div>
                </div>
            </div>
            <div class="row w-100">
            <?php
            $sql = "SELECT * FROM news ORDER BY Id DESC";
            $result = mysqli_query($connectnews, $sql);

            while ($data = mysqli_fetch_array($result)):
            ?>
                <div class="card mx-auto my-5">
                    <div class="card-body text-center">
                        <a href="edit.php?id=<?php echo $data['Id'] ?>"><?php echo '<img class="rounded img-fluid" height="250px" width="250px" src=data:image;base64,'.$data['img'].' />'; ?></a>
                    </div>
                    <div class="card-body text-center">
                        <a class="h6 card-text" href="edit.php?id=<?php echo $data['Id'] ?>"><?php echo $data['titulo'] ?></a>
                        <h6 class="card-subtitle my-2 text-muted"><?php echo $data['data'] ?><h6>
                    </div>
                </div>
                <?php
                endwhile; ?>
            </div>
        </div>
        <div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicione Uma Notícia</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <spam>&times;</spam>
                        </button>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>