<?php
// connecting
require_once '../database/dbconnectlogin.php';

// sessions
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: adm.php');
endif;
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add</title>
    </head>
    <body>
        <div>
            <h1>Adicione uma nova notícia</h1>
        </div>
        <div>
            <form action="../database/create.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" required>
                </div>
                <div>
                    <label for="texto">Texto</label>
                    <textarea rows="6" id="texto" name="texto" required></textarea>
                </div>
                <div>
                    <label for="img">Imagem</label>
                    <input type="file" name="img" id="img" required>
                </div>
                <div>
                    <button id="btn" name="btn" type="submit">Concluir</button>
                </div>
            </form>
        </div>
    </body>

</html>