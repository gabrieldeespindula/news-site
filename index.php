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
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>
        <?php include_once 'includes/header.php'; ?>

        <div id="carouselSite" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#carouselSite" data-slide-to="0" class="active"></li>
                <li data-target="#carouselSite" data-slide-to="1"></li>
                <li data-target="#carouselSite" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/patrocinio1.jpg" class="img-fluid d-block mx-auto">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Anuncie Aqui</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/patrocinio2.jpg" class="img-fluid d-block mx-auto">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Anuncie Aqui</h3>
                        <p>Duis sed viverra elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/patrocinio3.jpg" class="img-fluid d-block mx-auto">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Anuncie Aqui</h3>
                        <p>Phasellus porta placerat lorem, ac ullamcorper augue placerat sed.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselSite" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselSite" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">Avançar</span>
            </a>
        
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center mt-5">Ultimas Notícias</h1>
            </div>
            <div class="row w-100">
                <?php
                $count = 1;
                $countwo = 1;
                while ($data = mysqli_fetch_array($result)):
                ?>
                <div class="card mx-auto my-5">
                    <a href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo '<img class="rounded img-fluid" height="300px" width="300px" src=data:image;base64,'.$data['img'].' />'; ?></a>
                    <div class="card-body text-center">
                        <a class="h6 card-text" href="readnews.php?id=<?php echo $data['Id'] ?>"><?php echo $data['titulo'] ?></a>
                        <h6 class="card-subtitle my-2 text-muted"><?php echo $data['data'] ?><h6>
                    </div>
                </div>
                <?php
                $count ++;
                if($count == 4):
                ?>
            </div>
            <div class="row">
                <?php $count = 1;
                endif;
                if($countwo == 7):
                    break;
                endif;
                endwhile; ?>
            </div>
        </div>
        <div class="text-center">
            <a href="allnews.php" class="btn btn-outline-danger">Veja mais notícias</a>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-5">
                    <h1 class=""><i class="fa fa-bell text-danger" aria-hidden="true"></i> Receba Notificações</h1>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputNome">Seu Nome:</label>
                                    <input type="text" class="form-control" id="inputNome" placeholder="Nome">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputSobrenome">Seu Sobrenome:</label>
                                    <input type="text" class="form-control" id="inputSobrenome" placeholder="Sobrenome">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label for="inputEndereco">Seu Endereço:</label>
                                    <input type="text" class="form-control" id="inputEndereco" placeholder="Endereço Completo">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputCidade">Sua Cidade:</label>
                                    <input type="text" class="form-control" id="inputCidade" placeholder="Cidade">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="selectEstado">Seu Estado:</label>
                                    <select id="selectEstado" class="form-control">
                                        <option selected>SC</option>
                                        <option>RS</option>
                                        <option>PR</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="inputCep">CEP:</label>
                                    <input type="text" class="form-control" id="inputCEP" placeholder="00000-000">
                                </div>
                            
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputCelular">Seu Número de Celular:</label>
                                    <input type="text" class="form-control" id="inputCeluler" placeholder="(99) 99999-9999">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail">Seu Email:</label>
                                    <input type="email" class="form-control" id="inputEmail" placeholder="seuemail@email.com">
                                </div>                       
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" id="checkboxWhatsapp">Notificar pelo WhatsApp.
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                        <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" id="checkboxEmail">Notificar pelo Email.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <button type="submit" class="btn btn-danger">Enviar</button>
                                    <a tabindex="0" class="btn btn-secondary ml-2" role="button" data-toggle="popover" data-placement="right" data-trigger="focus" title="Receba Notificações" data-content="Sempre que houver uma nova notícia receba mensagem no WhatsApp ou email com o link acesso." >Ajuda</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>


    </body>
</html>