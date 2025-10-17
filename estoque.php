<?php

session_start();
include_once('includes/conexao.php');
include 'obj/Produto.php';

if (!isset($_SESSION['matricula'])) {
    header("Location: login.php");
    exit();
}

$produto_obj = new Produto($conexao);
$filtro = $_GET['pesquisa'] ?? '';
$produtos = $produto_obj->get_produtos($filtro);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque - RetailOne</title>
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/estoque.css">
</head>
<body>

    <?php include 'includes/nav.php' ?>

    <div class="container">
        <h2>Estoque de Produtos</h2>

        <a href="add_produto.php" class="add-produto">+ Adicionar Produto</a>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($produtos)) : ?>
                <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td>
                        <a href="#" class="detalhes-produto" data-id="<?= $produto['id'] ?>">
                            <?= htmlspecialchars($produto['nome']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($produto['estoque']) ?></td>
                    <td>
                        <a href="excluir-produto.php?id=<?= $produto['id'] ?>" class="btn-excluir">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="3" style="text-align:center;">Nenhum produto encontrado.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal de Detalhes -->
    <div id="modal_detalhes" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="detalhes"></div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.detalhes-produto').forEach(link => {
        link.addEventListener('click', function(e){
            e.preventDefault();
            let id = this.dataset.id;
            fetch('produto_detalhes.php?id=' + id)
            .then(res => res.text())
            .then(html => {
                document.getElementById('detalhes').innerHTML = html;
                document.getElementById('modal_detalhes').style.display = 'block';
            });
        });
    });

    document.querySelector('.close').addEventListener('click', function(){
        document.getElementById('modal_detalhes').style.display = 'none';
    });

    window.onclick = function(event) {
        if(event.target == document.getElementById('modal_detalhes')){
            document.getElementById('modal_detalhes').style.display = 'none';
        }
    }
    </script>
</body>
</html>