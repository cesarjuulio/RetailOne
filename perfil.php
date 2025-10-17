<?php 
session_start();
include_once('includes/conexao.php');

// Redireciona se não estiver logado
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    header("Location: login.php");
    exit();
}

$matricula = $_SESSION['matricula'];

// Busca os dados do usuário no banco
$sql = "SELECT nome, email, telefone, tipo_usuario FROM usuario WHERE matricula = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $matricula);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$nome = htmlspecialchars($usuario['nome']);
$email = htmlspecialchars($usuario['email']);
$telefone = htmlspecialchars($usuario['telefone']);
$tipo_usuario = htmlspecialchars($usuario['tipo_usuario']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Pessoal - RetailOne</title>
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/nav.php' ?>

    <main class="container">
        <h2>Perfil Pessoal</h2>
        <div class="perfil-info">
            <p><strong>Nome:</strong> <?= $nome ?></p>
            <p><strong>Matrícula:</strong> <?= $matricula ?></p>
            <p><strong>E-mail:</strong> <?= $email ?></p>
            <p><strong>Telefone:</strong> <?= $telefone ?></p>
            <p><strong>Tipo de usuário:</strong> <?= $tipo_usuario ?></p>
        </div>
    </main>
</body>
</html>
