<?php
include 'conn.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$avatar = $_FILES['foto']['name'];
$senha = $_POST['senha'];
$PASTA = "img/";
$ext  = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
$AVATARF = $nome . '.' . $ext;

$avatarbd = $PASTA . $AVATARF;

$testar_nome = $conec->query("SELECT * FROM usuarios WHERE '$nome' = nome_user");
$testar_email = $conec->query("SELECT * FROM usuarios WHERE '$email' = email_user");
$check_email = mysqli_num_rows($testar_email);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

if ($check_email==1 ){
    echo "Email em uso";
}else{

$conec->query("INSERT INTO  usuarios(nome_user,email_user,senha_user,foto_user) VALUES ('$nome', '$email','$senha','$avatarbd')");

if(move_uploaded_file($_FILES['foto']['tmp_name'],$PASTA . $AVATARF)){
    
}
else{
    $result_message = "Não foi possivel concluir o upload da imagem.";
} 
echo "deu certo";
}


$dados = $conec->query("SELECT * FROM usuarios");

while ($linha = $dados->fetch_assoc()){

    $nome = $linha['nome_user'];
    $senha = $linha['senha_user'];
    $email = $linha['email_user'];
    echo "$email <br>","$nome <br>";
}

if ($conec->connect_error) {
    die("Erro na conexão: " . $conec->connect_error);
}

// Iniciar sessão para pegar ID do usuário logado
session_start();
$id_user = $_SESSION['id_user']; // precisa estar salvo no login

// Receber dados do formulário
$nome  = $_POST['nome_user'];
$email = $_POST['email_user'];
 // Criptografa a senha

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
    $stmt = $conec->prepare($sql);
    $stmt->bind_param("usuarios", $nome, $email, $senha, $foto, $id_user);
} else {
    $sql = "UPDATE usuarios SET nome=?, email=?, senha=? WHERE id=?";
    $stmt = $conec->prepare($sql);
    $stmt->bind_param("usuarios", $nome, $email, $senha, $id_user);
}

// Executar
if ($stmt->execute()) {
    echo "<script>alert('Perfil atualizado com sucesso!'); window.location='alterarPerfil.html';</script>";
} else {
    echo "Erro: " . $stmt->error;
}

$conec->close();
?>

