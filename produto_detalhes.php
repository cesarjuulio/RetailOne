<?php

    session_start();
    include_once('includes/conexao.php');
    include 'Produto.php';

    $id = $_GET['id'] ?? 0;
    $produto_obj = new Produto($conexao);
    $produto = $produto_obj->get_produto($id);

    if (!$produto) {
        echo "<p>Produto não encontrado.</p>";
        exit();
    }
    ?>

    <h3><?= htmlspecialchars($produto['nome']) ?></h3>
    <p><strong>ID: </strong> <?= htmlspecialchars($produto['id']) ?></p>
    <p><strong>Descrição:</strong> <?= htmlspecialchars($produto['descricao']) ?></p>
    <p><strong>Fornecedor:</strong> <?= htmlspecialchars($produto['fornecedor']) ?></p>
    <p><strong>Marca:</strong> <?= htmlspecialchars($produto['marca']) ?></p>
    <p><strong>Categoria:</strong> <?= htmlspecialchars($produto['categoria']) ?></p>
    <p><strong>Preço de Compra:</strong> R$ <?= number_format($produto['preco_compra'],2,",",".") ?></p>
    <p><strong>Preço de Venda:</strong> R$ <?= number_format($produto['preco_venda'],2,",",".") ?></p>
    <p><strong>Estoque:</strong> <?= htmlspecialchars($produto['estoque']) ?></p>
    <p><strong>Estoque Mínimo:</strong> <?= htmlspecialchars($produto['estoque_minimo']) ?></p>
    <p><strong>Unidade:</strong> <?= htmlspecialchars($produto['unidade_medida']) ?></p>
    <p><strong>NCM:</strong> <?= htmlspecialchars($produto['ncm']) ?></p>
    <p><strong>Validade:</strong> <?= htmlspecialchars($produto['validade'] ?? 'N/A') ?></p>
    <p><strong>Data de Cadastro:</strong> <?= htmlspecialchars($produto['data_cadastro']) ?></p>