<?php
    header('Content-Type: application/json');

    $pdo = new PDO('mysql:host=localhost; dbname=news;', 'root', '');

    $stmt = $pdo->prepare('SELECT * FROM news ORDER BY id DESC');
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
        echo json_encode('Nenhum comentário encontrado');
    }
?>