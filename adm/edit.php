<!DOCTYPE html>
<?php
// sessions
session_start();

// verification
if(!isset($_SESSION['logged'])):
    header ('location: adm.php');
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
        <title>Edit</title>
    </head>
    <body>
        <div>
            <h1 class="padding">Edite esta notícia</h1>
        </div>
        <div>
            <form action="../database/update.php?id=<?php echo $data['Id'] ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="titulo">Título</label>
                    <input type="text" name="tituloedit" id="titulo" value="<?php echo $data['titulo']; ?>" required>
                </div>
                <div>
                    <label for="texto">Texto</label>
                    <textarea rows="6" id="texto" name="textoedit" required> <?php echo $data['texto']; ?> </textarea>
                </div>
                <div>
                    <p>imagem atual:</p>
                    <?php echo '<img height="250px" width="250px" src=data:image;base64,'.$data['img'].' />'; ?>
                </div>
                <div>
                    <label for="img">Imagem: se não quiser trocar apenas não selecione nenhuma</label>
                    <input type="file" name="imgedit" id="img">
                </div>
                <div>
                    <button id="btn" name="btn-concluir" type="submit">Concluir</button>
                </div>
            </form>
            <form action="../database/delete.php?id=<?php echo $data['Id'] ?>" method="POST">
                <button id="btn" name="btn-deletephp" type="submit">EXCLUIR NOTÍCIA</button>
            </form>
        </div>
    </body>

</html>
