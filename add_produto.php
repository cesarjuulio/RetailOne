<?php

session_start();
include_once 'includes/conexao.php';

if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['adicionar'])) {
    include 'obj/Produto.php';
    $produto_obj = new Produto($conexao);
    $produto_obj->cadastrar_produto($_POST['nome'], $_POST['descricao'], $_POST['fornecedor'], $_POST['marca'], $_POST['categoria'], $_POST['preco_compra'], $_POST['preco_venda'], $_POST['estoque'], $_POST['estoque_minimo'], $_POST['unidade_medida'], $_POST['ncm'], $_POST['validade']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto - RetailOne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro-produto.css">
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Produto</h2>
        <form action="" method="post">
            <input type="text" placeholder="Nome do produto" name="nome" required>
            <textarea placeholder="Descrição" name="descricao"></textarea>
            <input type="text" placeholder="Fornecedor" name="fornecedor">
            <input type="text" placeholder="Marca" name="marca">
            <input type="text" placeholder="Categoria" name="categoria">
            <input type="number" step="0.01" placeholder="Preço de compra" name="preco_compra" required>
            <input type="number" step="0.01" placeholder="Preço de venda" name="preco_venda" required>
            <input type="number" placeholder="Estoque" name="estoque" required>
            <input type="number" placeholder="Estoque mínimo" name="estoque_minimo" required>
            <input type="text" placeholder="Unidade de medida" name="unidade_medida" value="un">
            <input type="text" placeholder="NCM" name="ncm">
            <label for="validade">Validade:</label>
            <input type="date" name="validade">
            <button type="submit" name="adicionar">Cadastrar Produto</button>
        </form>
    </div>
</body>
</html>
