<?php

session_start();
include_once 'includes/conexao.php';


if (isset($_POST['cadastrar'])) {
    include 'obj/Usuario.php';
    $usuario_obj = new Usuario($conexao);
    $usuario_obj->cadastrar_usuario($_POST['matricula'], $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['senha'], $_POST['tipo_usuario']);
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
