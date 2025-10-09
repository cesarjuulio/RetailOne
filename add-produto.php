<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include_once 'includes/conexao.php';

if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['adicionar'])) {
    // Campos obrigatórios
    $required = ['nome', 'preco_compra', 'preco_venda', 'estoque', 'estoque_minimo'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            echo "<script>alert('Preencha todos os campos obrigatórios!');</script>";
            exit();
        }
    }

    $nome = $conexao->real_escape_string($_POST['nome']);
    $descricao = $conexao->real_escape_string($_POST['descricao']);
    $fornecedor = $conexao->real_escape_string($_POST['fornecedor']);
    $marca = $conexao->real_escape_string($_POST['marca']);
    $categoria = $conexao->real_escape_string($_POST['categoria']);
    $preco_compra = floatval($_POST['preco_compra']);
    $preco_venda = floatval($_POST['preco_venda']);
    $estoque = intval($_POST['estoque']);
    $estoque_minimo = intval($_POST['estoque_minimo']);
    $unidade_medida = $conexao->real_escape_string($_POST['unidade_medida']);
    $ncm = $conexao->real_escape_string($_POST['ncm']);
    $validade = !empty($_POST['validade']) ? $conexao->real_escape_string($_POST['validade']) : null;

    $sql = "INSERT INTO produto 
        (nome, descricao, fornecedor, marca, categoria, preco_compra, preco_venda, estoque, estoque_minimo, unidade_medida, ncm, validade)
        VALUES 
        ('$nome', '$descricao', '$fornecedor', '$marca', '$categoria', $preco_compra, $preco_venda, $estoque, $estoque_minimo, '$unidade_medida', '$ncm', " . ($validade ? "'$validade'" : "NULL") . ")";

    if ($conexao->query($sql)) {
        echo "<script>alert('Produto cadastrado com sucesso!'); window.location='add-produto.php';</script>";
        header('Location: estoque.php');
    } else {
        echo "<script>alert('Erro ao cadastrar produto: " . $conexao->error . "');</script>";
    }
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
