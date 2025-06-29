<?php
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$con = new mysqli($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
  die("Erro de conexão: " . $con->connect_error);
}

$veiculos = $con->query("SELECT codigo_veiculo, matricula FROM veiculos ORDER BY matricula");
$proprietarios = $con->query("SELECT codigo_proprietario, nome FROM proprietarios ORDER BY nome");

$mensagem = "";
if (isset($_GET['sucesso'])) {
  $mensagem = "<div style='background:#c1ffd7;padding:10px;border-radius:5px;margin-bottom:15px;'>Registo efetuado com sucesso.</div>";
} elseif (isset($_GET['erro'])) {
  $mensagem = "<div style='background:#ffd1d1;padding:10px;border-radius:5px;margin-bottom:15px;'>" . $_GET['erro'] . "</div>";
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title>Parqueamento</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    form label {
      display: block;
      margin-top: 20px;
      font-weight: bold;
      color: #555;
    }

    form select,
    form input[type="text"],
    form input[type="date"],
    form input[type="time"] {
      width: 100%;
      padding: 10px 12px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1em;
      transition: border-color 0.2s;
    }

    .btn-inline {
      display: inline-block;
      margin-top: 8px;
      margin-left: 8px;
      font-size: 0.9em;
      color: #0044ff;
      text-decoration: none;
      vertical-align: middle;
      transition: color 0.2s;
    }

    .btn-inline:hover {
      color: #002db3;
    }

    button {
      margin-top: 30px;
      width: 100%;
      padding: 12px;
      background: #0044ff;
      color: #fff;
      font-size: 1em;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.2s;
    }

    button:hover {
      background: #002db3;
    }
    .btn-secundario {
    background: #e0e0e0;
    color: #333;
    padding: 10px 15px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
    transition: background 0.3s ease;
  }

  .btn-secundario:hover {
    background: #d0d0d0;
    color: #000;
  }

  </style>
</head>

<body>
  <div class="container">
    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <img src="logo.png" class="logo">
      <nav class="content">
        <a href="Menu.php"><i class="fa fa-chart-bar"></i> Dashboard</a>
        <a href="parqueamento.php" class="active"><i class="fa fa-list"></i> Parqueamento</a>
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
        <h1>Registar Parqueamento</h1>
        <div class="user">
          <img src="user.jpg" alt="Utilizador">
        </div>
      </header>
      <div style="text-align: right; margin-top: 15px;">
          <a href="listar_parqueamentos.php" class="btn-secundario"><i class="fa fa-list"></i> Ver Lista</a>
        </div>
      <section class="content-box">
        <?= $mensagem ?>
        <form action="processar_parqueamento.php" method="POST">
  
          <!-- 1. Veículo -->
          <label for="codigo_viatura">Veículo:</label>
          <select name="codigo_viatura" id="codigo_viatura" required>
            <option value="">-- Selecionar veículo --</option>

            <?php while ($veiculo = $veiculos->fetch_assoc()): ?>
              <option value="<?= $veiculo['codigo_veiculo'] ?>">
                <?= htmlspecialchars($veiculo['matricula']) ?>
              </option>
            <?php endwhile; ?>
          </select>

          </select>
          <a href="adicionarVeiculo.php?novo=1" class="btn-inline"><i class="fa fa-plus"></i> Novo Veículo</a>

          <!-- 2. Proprietário -->
          <label for="codigo_proprietario">Proprietário:</label>
          <select name="codigo_proprietario" id="codigo_proprietario" required>
            <option value="">-- Selecionar proprietário --</option>
            <?php while ($proprietario = $proprietarios->fetch_assoc()): ?>
              <option value="<?= $proprietario['codigo_proprietario'] ?>">
                <?= htmlspecialchars($proprietario['nome']) ?>
              </option>
            <?php endwhile; ?>
          </select>

          </select>
          <a href="proprietario.php?novo=1" class="btn-inline"><i class="fa fa-plus"></i> Novo Proprietário</a>

          <!-- 3. Dados de Parqueamento -->
          <label for="numero_pista">Número da Pista:</label>
          <input type="text" name="numero_pista" id="numero_pista" required placeholder="Ex: A1">

          <label for="data_parqueamento">Data:</label>
          <input type="date" name="data_parqueamento" id="data_parqueamento" required>

          <label for="hora_entrada">Hora de Entrada:</label>
          <input type="time" name="hora_entrada" id="hora_entrada" required>

          <button type="submit" name="submeter"> Registar</button>

        </form>
        

      </section>
    </main>

  </div>
</body>

</html>