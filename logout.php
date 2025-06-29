<?php
// Iniciar a sessão para destruir
session_start();

// Limpar todas as variáveis de sessão
session_destroy();

// Opcionalmente, apagar cookies definidos (por exemplo, "ultima_entrada")
setcookie("ultima_entrada", "", time() - 3600, "/");

// Redirecionar para login
header("Location: login.php");
exit();
?>