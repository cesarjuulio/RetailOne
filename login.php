<?php 
session_start(); 

include_once('includes/conexao.php');

if (isset($_POST['login'])) {

    if(empty($_POST['matricula']) || empty($_POST['senha'])) {
        echo "Preencha todos os campos!";
    } else {
        $matricula = $conexao->real_escape_string($_POST['matricula']);
        $senha = $_POST['senha']; // senha em texto puro enviada pelo formulário

        // Buscar usuário pela matrícula
        $sql_code = "SELECT * FROM usuario WHERE matricula = '$matricula'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . htmlspecialchars($conexao->error));

        if($sql_query->num_rows == 1) {
            $usuario = $sql_query->fetch_assoc();

            // Verificar a senha
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['matricula'] = $usuario['matricula'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Falha ao logar! Matrícula ou senha incorretos.');</script>;";
            }

        } else {
            echo "<script>alert('Falha ao logar! Matrícula ou senha incorretos.');</script>;";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - RetailOne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/logo_nav.png" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h2>Login RetailOne</h2>
        <form action="login.php" method="post">
            <input type="text" placeholder="Matrícula" name="matricula" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <button type="submit" name="login">Entrar</button>
        </form>
    </div>
</body>
</html>
