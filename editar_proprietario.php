<?php
session_start();

// Conexão
$host = "localhost";
$user = "root";
$pass = "869444368"; // Usa a tua senha atual
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = new mysqli($host, $user, $pass, $dbname, $port);
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Validar se foi passado o ID
if (!isset($_GET['id'])) {
    echo "ID do proprietário não fornecido.";
    exit();
}

$id = (int) $_GET['id'];

// Buscar dados do proprietário
$sql = "SELECT * FROM proprietarios WHERE codigo_proprietario = $id";
$resultado = $conexao->query($sql);
if ($resultado->num_rows === 0) {
    echo "Proprietário não encontrado.";
    exit();
}
$proprietario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Editar Proprietário</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .main-content {
      flex: 1;
      padding: 30px;
      background: #fff;
    }

    .content-box {
      background: #eef1fb;
      padding: 20px;
      border-radius: 10px;
    }

    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    input[type="text"], input[type="tel"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
    }

    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #0044ff;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background-color: #002db3;
    }

    .btn-voltar {
      background-color: #ccc;
      color: #000;
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 5px;
      font-weight: bold;
      margin-top: 10px;
      display: inline-block;
    }

    .btn-voltar:hover {
      background-color: #bbb;
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <img src="logo.png" class="logo">
      <nav class="content">
        <a href="Menu.php"><i class="fa fa-chart-bar"></i> Dashboard</a>
        <a href="parqueamento.php"><i class="fa fa-list"></i> Parqueamento</a>
        <a href="veiculos.php"><i class="fa fa-car"></i> Veículos</a>
        <a href="proprietario.php" class="active"><i class="fa fa-user"></i> Proprietários</a>
      </nav>
      <div class="footer">
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Sair</a>
      </div>
    </aside>

    <main class="main-content">
      <header>
        <h1>Editar Proprietário</h1>
        <div class="user"><img src="user.jpg" alt="User"></div>
      </header>

      <section class="content-box">
        <form action="atualizar_proprietario.php" method="POST">
          <input type="hidden" name="codigo_proprietario" value="<?= $proprietario['codigo_proprietario'] ?>">

          <label for="nome">Nome:</label>
          <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($proprietario['nome']) ?>" required>

          <label for="telefone">Telefone:</label>
          <input type="tel" name="telefone" id="telefone" value="<?= htmlspecialchars($proprietario['telefone']) ?>" required>

          <label for="BI">Bilhete de Identidade:</label>
          <input type="text" name="BI" id="BI" value="<?= htmlspecialchars($proprietario['BI']) ?>" required>

          <button type="submit" name="submeter">Atualizar Dados</button>
        </form>
        <br>
        <a href="proprietario.php" class="btn-voltar"><i class="fa fa-arrow-left"></i> Voltar à Lista</a>
      </section>
    </main>
  </div>
</body>
</html>
