<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Gestão de Veículos</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <img src="logo.png" class="logo">
      <nav class="content">
        <a href="Menu.php" class="active"><i class="fa fa-chart-bar"></i> Dashboard</a>
        <a href="parqueamento.php"><i class="fa fa-list"></i> Parqueamento</a>
        <a href="adicionarVeiculo.php"><i class="fa fa-car"></i> Veículos</a>
        <a href="proprietario.php"><i class="fa fa-user"></i> Proprietários</a>
      </nav>
      <div class="footer">
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Sair</a>
      </div>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
      <header>
        <h1>Gestão de Veículos no Parque</h1>
        <div class="user">
          <img src="user.jpg" alt="User"> 
        </div>
      </header>

      <section class="content-box">
        <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['login']) ?>!</h2>
        <p>A sua última entrada foi em: 
          <?= isset($_COOKIE['ultima_entrada']) ? htmlspecialchars($_COOKIE['ultima_entrada']) : 'N/D' ?>
        </p>
      </section>
    </main>
  </div>
</body>
</html>
