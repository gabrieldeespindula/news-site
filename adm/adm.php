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

        <title>Login</title>


    </head>

    <body>
        <h1> Login </h1>

        <?php
        if(!empty($errors)):
            foreach($errors as $error):
                echo $error;
            endforeach;
        endif;
        ?>


        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div>
                <label for="login">Login:</label>
                <input type="text" name="login" id="login"><br>
            </div>
            <div>
                <label for="password" class="font-20">Password:</label>
                <input type="password" name="password" id=password><br>
            </div>
        <button type="submit" name="button-login"> Log In </button>
        </form>

    </body>
</html>