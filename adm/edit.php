<!DOCTYPE html>
<?php
// sessions
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: index.php');
endif;

// connection
require_once '../database/dbconnectnews.php';

$id = $_GET['id'];

$sql = "SELECT * FROM news WHERE Id = '$id'";
$result = mysqli_query($connectnews, $sql);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
        <link rel="stylesheet" href="../style/css/style.css">
        <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.css">
        <title>Edit</title>
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
                        <form action="../database/update.php?id=<?php echo $data['Id'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" name="tituloedit" id="titulo" value="<?php echo $data['titulo']; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="texto">Texto</label>
                                    <textarea rows="10" name="textoedit" class="form-control" id="texto" required><?php echo $data['texto']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <p class="lead" for="texto">Imagem Atual:</p>
                                    <?php echo '<img class="rounded img-fluid" height="350px" width="350px" src=data:image;base64,'.$data['img'].' />'; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="texto">Imagem</label>
                                    <input type="file" name="img" class="form-control" id="img">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6 text-center">
                                    <button id="btn" name="btn" class="btn btn-outline-success" type="submit">Concluir</button>
                                </div>
                                <div class="form-group col-sm-6 text-center">
                                    <button id="btn" name="btn-delete" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger" type="button">Excluir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <spam>&times;</spam>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="justify-content-center" role="group">
                            <p>Você tem certeza que deseja remover esta notícia do banco de dados?</p>
                        </div>
                    </div>
                    <div class="modal-footer col-sm-12">
                        <div class="col-sm-6 text-center">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="col-sm-6 text-center">
                            <a href="../database/delete.php?id=<?php echo $data['Id']?>" class="btn btn-outline-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
