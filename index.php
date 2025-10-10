<?php 

session_start();
include_once('includes/conexao.php');

if (!isset($_SESSION['matricula'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetailOne - Menu</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome (ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
         
    </style>
</head>
<body>
    <?php include 'includes/nav.php' ?>

    <main class="container">
        <h2>Escolha uma opção:</h2>
        <div class="grid">
        <a href="perfil.php" class="card">
            <i class="fas fa-user-circle"></i>
            <span>Meu Perfil</span>
        </a>
        <a href="estoque.php" class="card">
            <i class="fas fa-boxes-stacked"></i>
            <span>Estoque</span>
        </a>

        <?php if ($_SESSION['tipo_usuario'] === 'administrador'): ?>
            <a href="funcionarios.php" class="card-funcionarios">
            <i class="fas fa-users"></i>
            <span>Funcionários</span>
            </a>
        <?php endif; ?>
        </div>
    </main>
</body>

</html>
