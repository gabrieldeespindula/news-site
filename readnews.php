<!DOCTYPE html>
<?php
// connection
require_once 'database/dbconnectnews.php';

// sessions
session_start();

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
        <script src="js/readnews.js"></script>
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>
        <?php include_once 'includes/header.php'; ?>

        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="row mt-5">
                        <div class="col-sm-12 w-100  text-center">
                            <h1 class=""> <?php echo $data['titulo']; ?> </h1>
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
                    <div class="row mt-5">
                        <div class="col-sm-12  text-center">
                            <button class="btn btn-outline-info" data-toggle="modal" data-target="#modalCompartilhar" >Compartilhar</button>
                        </div>
                    </div>
                    <div class="mt-4" style="background-color: #e3f2fd;" >
                        <div class="row">
                            <div class="col-sm-12  text-center">
                                <h6 id="comentario" class="my-4">Deixe seu Comentário:</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <form method="POST" action="./database/insert.php?id=<?php echo $data['Id']; ?>" id="formcomment">
                                    <div class="form-row">
                                        <input id="nome" name="nome" hidden="true" value="<?php echo $datauser['nome']; ?>" >
                                        <input id="tituloc" name="tituloc" hidden="true" value="<?php echo $data['titulo']; ?>" >
                                        <label for="comment"></label>
                                        <textarea class="form-control mx-3" name="comment" id="comment"></textarea>
                                    </div>
                                    <div class="form-row my-4">
                                        <div class="form-group col-sm-12">
                                            <?php if(isset($_SESSION['usuario'])): ?>
                                            <button type="submit" id="btncomment" name="btncomment" class="btn btn-outline-info">Enviar comentário</Em></button>
                                            <?php else: ?>
                                            <a tabindex="0" class="btn btn-outline-info" role="button" data-toggle="popover" data-placement="right" data-trigger="focus" title="Entre Para Comentar" data-content="Crie uma conta gratuitamente no site para poder comentar nas notícias" >Enviar comentário</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    $titulo = $data['titulo'];
                    $connectcomment = mysqli_connect("localhost", "root", "", "comment");
                    $sqlcomment = "SELECT * FROM comments WHERE titulo = '$titulo'";
                    $resultcomment = mysqli_query($connectcomment, $sqlcomment);
                    while($datacomment = mysqli_fetch_array($resultcomment)):
                    ?>
                    <div class="row m-1 p-2 border rounded">
                        <div class="col-sm-12">
                            <h4><?php echo $datacomment['nome']; ?></h4>
                        </div>
                        <div class="col-sm-12">
                            <p><?php echo $datacomment['comment']; ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCompartilhar" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Compartilhar</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <spam>&times;</spam>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="btn-group btn-block btn-group-lg justify-content-center" role="group">
                            <a class="btn btn-outline-primary" href="#" ><i class="fa fa-facebook-f" aria-hidden="true"></i></a>
                            <a class="btn btn-outline-info" href="#" ><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a class="btn btn-outline-warning" href="#" ><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a class="btn btn-outline-success" href="#" ><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                            <a class="btn btn-outline-secondary" href="#" ><i class="fa fa-copy" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>