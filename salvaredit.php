<?php
// Conexão com o banco
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecomap";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Iniciar sessão para pegar ID do usuário logado
session_start();
$id_usuario = $_SESSION['id']; // precisa estar salvo no login

// Receber dados do formulário
$nome  = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

// Upload da foto
$foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $pasta = "uploads/";
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }
    $nomeArquivo = uniqid() . "-" . basename($_FILES['foto']['name']);
    $destino = $pasta . $nomeArquivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
        $foto = $destino;
    }
}

// Montar SQL (se tiver foto, atualiza também)
if ($foto) {
    $sql = "UPDATE usuarios SET nome=?, email=?, senha=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $senha, $foto, $id_usuario);
} else {
    $sql = "UPDATE usuarios SET nome=?, email=?, senha=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $senha, $id_usuario);
}

// Executar
if ($stmt->execute()) {
    echo "<script>alert('Perfil atualizado com sucesso!'); window.location='alterarPerfil.html';</script>";
} else {
    echo "Erro: " . $stmt->error;
}

$conn->close();
?>
