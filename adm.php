<?php
// connecting
require_once 'database/dbconnectlogin.php';

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
                $errors[] = "<li> Login and password don´t match. </li>";
            endif;
        else:
            $errors[] = "<li> User not found.</li>";
        endif;
    endif;

endif;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/adm.css">

        <title>Login</title>


    </head>

    <body class="center">
        <h1 class="padding"> Login </h1>

        <?php
        if(!empty($errors)):
            foreach($errors as $error):
                echo $error;
            endforeach;
        endif;
        ?>


        <form action="" method="POST">
            <div class="padding">
                <label for="login" class="font-20">Login:</label>
                <input class="padding font-20" type="text" name="login" id="login"><br>
            </div>
            <div class="padding">
                <label for="password" class="font-20">Password:</label>
                <input class="padding font-20" type="password" name="password" id=password><br>
            </div>
        <button class="padding font-20" type="submit" name="button-login"> Log In </button>
        </form>

    </body>
</html>