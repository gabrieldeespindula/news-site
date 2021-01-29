<?php
    header('Content-Type: application/json');

    $titulo = $_POST['tituloc'];
    $nome = $_POST['nome'];
    $comment = $_POST['comment'];
    $id = $_GET['id'];

    $pdo = new PDO('mysql:host=localhost; dbname=comment', 'root', '');

    $stmt = $pdo->prepare("INSERT INTO comments (titulo, nome, comment) VALUES ('$titulo', '$nome', '$comment')");
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        echo json_encode('Comentário Salvo com Sucesso');
    } else {
        echo json_encode('Falha ao salvar comentário');
    }

    header('location: ../readnews.php?id='.$id);
?>