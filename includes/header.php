<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbnews = "news";

$connectusuario = mysqli_connect("localhost", "root", "", "logindb");

// clear
function clear($input){
    global $connectusuario;
    // sql
    $var = mysqli_escape_string($connectusuario, $input);
    // xss
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_POST['btncriar'])):

    $nomec = clear($_POST['nomecriar']);
    $emailc = clear($_POST['emailcriar']);
    $senhac = password_hash(clear($_POST['senhacriar']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nomec', '$emailc', '$senhac')";
    if (mysqli_query($connectusuario, $sql)):
        $result = mysqli_query($connectusuario, "SELECT id FROM usuarios ORDER BY id DESC");
        $data = mysqli_fetch_array($result);      
        $_SESSION['usuario'] = $data[0];
    endif;
    header('location: index.php');
endif;

if (isset($_POST['btnentrar'])):

    $email = clear($_POST['email']);
    $senha = clear($_POST['senha']);

    $sql = "SELECT email FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($connectusuario, $sql);

    if(mysqli_num_rows($result) > 0):
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($connectusuario, $sql);
        $data = mysqli_fetch_array($result);
        mysqli_close($connectusuario);


        if(password_verify($senha, $data['senha'])):
            $_SESSION['usuario'] = $data['id'];
            header('location: index.php');
        endif;
    endif;
endif;

?>
<nav id="header" class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
        <a class="navbar-brand h1 mb-0" href="index.php">Notícia Top</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <spam class="navbar-toggler-icon" ></spam>
        </button>

        <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav my-3 mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php" >Início</a>
                        <a class="dropdown-item" href="index.php#noticiashf" >Notícias</a>
                        <a class="dropdown-item" href="index.php#videos" >Vídeos</a>
                        <a class="dropdown-item" href="#redes" >Redes Sociais</a>
                    </div>
                </li>
            </ul>
            <div class="navbar-nav my-3 float-right">
                <div class="nav-item">
                    <?php if(!isset($_SESSION['usuario'])): ?>
                    <button class="btn btn-light" data-toggle="modal" data-target="#modalEntrar" >Entrar</button>
                    <?php else: 
                            $id = $_SESSION['usuario'];
                            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
                            $result = mysqli_query($connectusuario, $sql);
                            $data = mysqli_fetch_array($result); ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data['nome']; ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                            <a class="dropdown-item" href="./database/logout.php" >Sair</a>
                        </div>
                </li>
                    <?php endif; ?>
                </div>
            </div>
            <form action="busca.php" class="form-inline" method="POST">
                <input class="form-control ml-2 mr-2" name="busca" type="search" placeholder="Busque por notícias">
                <button class="btn btn-dark" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
<div class="modal fade" id="modalEntrar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entrar</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <spam>&times;</spam>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" required>
                        </div>
                    </div>
                    <div class="form-row col-sm-12">
                        <div class="col-sm-6 text-center">
                            <button type="submit" name="btnentrar" id="btnentrar" class="btn btn-outline-success">Entrar</button>
                        </div>
                        <div class="col-sm-6 text-center">
                            <button type="button" class="btn btn-outline-secondary"  data-toggle="modal" data-target="#modalCriar">Criar conta</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCriar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Conta</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <spam>&times;</spam>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="nome">Nome Completo</label>
                            <input type="text" class="form-control" name="nomecriar" id="nomecriar" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="emailcriar" id="emailcriar" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" name="senhacriar" id="senhacriar" required>
                        </div>
                    </div>
                    <div class="form-row col-sm-12">
                        <div class="col-sm-12 text-center">
                            <button name="btncriar" id="btncriar" type="submit" class="btn btn-outline-success">Criar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>