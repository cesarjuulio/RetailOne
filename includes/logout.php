<?php

session_start();

// Limpa todas as variáveis de sessão
$_SESSION = [];

session_destroy();

header("Location: ../login.php");
exit();

?>