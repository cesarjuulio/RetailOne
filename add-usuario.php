<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include_once 'includes/conexao.php';

if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['cadastrar'])) {

    if (empty($_POST['matricula']) || empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['senha'])) {
        echo "<script>alert('Preencha todos os campos!');</script>";
    } else {
        $matricula = $conexao->real_escape_string($_POST['matricula']);
        $nome = $conexao->real_escape_string($_POST['nome']);
        $email = $conexao->real_escape_string($_POST['email']);
        $telefone = $conexao->real_escape_string($_POST['telefone']);
        $senha = $conexao->real_escape_string($_POST['senha']);
        $tipo_usuario = isset($_POST['tipo_usuario']) ? $conexao->real_escape_string($_POST['tipo_usuario']) : 'padrao';

        $check_sql = "SELECT * FROM usuario WHERE matricula = '$matricula'";
        $check_query = $conexao->query($check_sql);

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        if ($check_query->num_rows > 0) {
            echo "<script>alert('Matrícula já cadastrada!');</script>";
        } else {
            $sql_code = "INSERT INTO usuario (matricula, nome, email, telefone, senha, tipo_usuario)
                         VALUES ('$matricula', '$nome', '$email', '$telefone', '$senha_hash', '$tipo_usuario')";

            if ($conexao->query($sql_code)) {
                echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar funcionário: " . $conexao->error . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário - RetailOne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro-usuario.css">
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Funcionário</h2>
        <form action="" method="post">
            <input type="number" placeholder="Matrícula" name="matricula" required>
            <input type="text" placeholder="Nome completo" name="nome" required>
            <input type="email" placeholder="E-mail" name="email" required>
            <input type="text" placeholder="Telefone" name="telefone" required>
            <input type="password" placeholder="Senha" name="senha" required>

            <label for="tipo_usuario">Tipo de usuário:</label>
            <select name="tipo_usuario" required>
                <option value="padrao">Padrão</option>
                <option value="administrador">Administrador</option>
            </select>

            <button type="submit" name="cadastrar">Cadastrar</button>
        </form>
    </div>
</body>
</html>
