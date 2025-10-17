<?php

session_start();

include_once('includes/conexao.php');
include_once('obj/Produto.php');

$id = $_GET['id'] ?? null;
if ($id) {
    $produto_obj = new Produto($conexao);
    $produto_obj->excluir_produto($id);
    header("Location: estoque.php");
    exit();
}

?>