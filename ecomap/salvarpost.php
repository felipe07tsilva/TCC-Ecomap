<?php

header("Content-Type: application/json; charset=UTF-8");

include 'conn.php';

$dados = $conec->query("SELECT * FROM posts");

if ($conec->connect_error) {
    die(json_encode(["error" => "Falha na conexão: " . $conec->connect_error]));
}

// Recebe JSON do frontend
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "Nenhum dado recebido"]);
    exit;
}

// Prepara SQL
$stmt = $conec->prepare("INSERT INTO posts (user, caption, image, time, likes, comments) VALUES (?, ?, ?, ?, ?, ?)");

$comments = json_encode($data['comments']); // salva os comentários como JSON
$stmt->bind_param("ssssss",
    $data['user'],
    $data['caption'],
    $data['image'],
    $data['time'],
    $data['likes'],
    $comments
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "id" => $stmt->insert_id]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
$conec->close();