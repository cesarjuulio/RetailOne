<?php 

session_start();

include_once('includes/conexao.php');
include 'Usuario.php';

$usuario_obj = new Usuario($conexao);
$usuarios = $usuario_obj->get_atores();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários - RetailOne</title>
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/funcionarios.css">
</head>
<body>
    <?php include 'includes/nav.php' ?>

    <div class="container">
        <h2>Funcionários Cadastrados</h2>

        <a href="add-usuario.php" class="add-user">+ Adicionar Usuário</a>
        
        <table>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)) : ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['matricula']) ?></td>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['telefone']) ?></td>
                            <td class="tipo"><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align:center;">Nenhum funcionário cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
