<?php
// connecting
require_once '../database/dbconnectlogin.php';

// sessions
session_start();


// send button
if(isset($_POST['button-login'])):
    $errors = array();
    $login = mysqli_escape_string($connectlogin, $_POST['login']);
    $password = mysqli_escape_string($connectlogin, $_POST['password']);
    
    if (empty($login) or empty($password)):
        $errors[] = "<li> The login / password field needs to be filled. </li>";
    else:
        $sql = "SELECT login FROM news WHERE login = '$login'";
        $result = mysqli_query($connectlogin, $sql);

        if(mysqli_num_rows($result) > 0):
            $sql = "SELECT * FROM news WHERE login = '$login'";
            $result = mysqli_query($connectlogin, $sql);
            $data = mysqli_fetch_array($result);
            mysqli_close($connectlogin);


            if(password_verify($password, $data['password'])):
                $_SESSION['logged'] = true;
                $_SESSION['id_user'] = $data['Id'];
                header('location: read.php');
            else:
                $errors[] = "<li> Senha incorreta. </li>";
            endif;
        else:
            $errors[] = "<li> Usuário não encontrado.</li>";
        endif;
    endif;

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
        <title>Login</title>
    </head>

    <body>
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

        <div class="container">
            <div class="row">
                <div class="col-12 text-center my-5">
                    <h1 class="">Login</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                if(!empty($errors)):
                    foreach($errors as $error):
                        echo '<h6>'.$error.'</h6>';
                    endforeach;
                endif;
                ?>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputLogin">Login</label>
                                    <input type="text" class="form-control" id="inputLogin"  name="login">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputPassword">Senha:</label>
                                    <input type="password" name="password" class="form-control" id="inputSobrenome">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group text-center mt-3 col-sm-12">
                                    <button type="submit" class="btn btn-info" name="button-login">Entrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>