<?php
// connecting
require_once 'database/dbconnectlogin.php';

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
        <link rel="stylesheet" type="text/css" href="css/adm.css">
        <title>Add</title>
    </head>
    <body>
        <div class="center">
            <h1 class="padding">Adicione uma nova notícia</h1>
        </div>
        <div style="margin-left: 30px; margin-right: 30px;">
            <form action="./database/create.php" method="POST" enctype="multipart/form-data">
                <div class="padding font-20">
                    <label for="titulo">Título</label>
                    <input class="padding font-20 titulo-input" type="text" name="titulo" id="titulo" required>
                </div>
                <div class="padding font-20">
                    <label for="texto">Texto</label>
                    <textarea class="padding font-20" rows="6" id="texto" name="texto" required></textarea>
                </div>
                <div class="padding font-20">
                    <label for="img">Imagem</label>
                    <input type="file" name="img" id="img" required>
                </div>
                <div class="padding">
                    <button class="button" id="btn" name="btn" type="submit">Concluir</button>
                </div>
            </form>
        </div>
    </body>

</html>