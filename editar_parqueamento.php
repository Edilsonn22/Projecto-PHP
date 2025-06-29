<?php
session_start();

// Conexão com a base de dados
$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname, $port);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se foi passado o código
if (!isset($_GET['codigo'])) {
    echo "Código do parqueamento não fornecido.";
    exit();
}

$codigo = (int) $_GET['codigo'];

// Busca dados do parqueamento
$sql = "SELECT 
            p.*,
            v.matricula,
            v.marca,
            pr.nome AS nome_proprietario
        FROM parqueamento p
        JOIN veiculos v ON v.codigo_veiculo = p.codigo_veiculo
        JOIN proprietarios pr ON pr.codigo_proprietario = p.codigo_proprietario
        WHERE p.codigo_parqueamento = $codigo";

$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    echo "Registo não encontrado.";
    exit();
}

$dados = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Editar Parqueamento</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .form-box {
      max-width: 700px;
      margin: 40px auto;
      background: #eef1fb;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-box h2 {
      text-align: center;
      color: #0044ff;
      margin-bottom: 20px;
    }

    .form-box p {
      margin: 6px 0;
      font-size: 15px;
    }

    label {
      font-weight: bold;
      margin-top: 18px;
      display: block;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background: #0044ff;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background: #002db3;
    }

    .back-link {
      display: block;
      margin-top: 25px;
      text-align: center;
      color: #0044ff;
      font-weight: bold;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
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
  </aside>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="main-content">
    <header>
      <h1>Editar Registo de Parqueamento</h1>
      <div class="user">
        <img src="user.jpg" alt="Utilizador">
      </div>
    </header>

    <section class="form-box">
      <h2>Editar Dados</h2>
      <form action="atualizar_parqueamento.php" method="POST">
        <input type="hidden" name="codigo_parqueamento" value="<?= $dados['codigo_parqueamento'] ?>">

        <p><strong>Matrícula:</strong> <?= htmlspecialchars($dados['matricula']) ?></p>
        <p><strong>Marca:</strong> <?= htmlspecialchars($dados['marca']) ?></p>
        <p><strong>Proprietário:</strong> <?= htmlspecialchars($dados['nome_proprietario']) ?></p>

        <label for="numero_pista">Número da Pista:</label>
        <input type="text" name="numero_pista" id="numero_pista" value="<?= $dados['numero_pista'] ?>" required>

        <label for="data_parqueamento">Data:</label>
        <input type="date" name="data_parqueamento" id="data_parqueamento" value="<?= $dados['data_parqueamento'] ?>" required>

        <label for="hora_entrada">Hora de Entrada:</label>
        <input type="time" name="hora_entrada" id="hora_entrada" value="<?= $dados['hora_entrada'] ?>" required>

        <button type="submit" name="submeter">Atualizar Registo</button>
      </form>

      <!-- Link de voltar -->
      <a href="listar_parqueamentos.php" class="back-link"><i class="fa fa-arrow-left"></i> Voltar à Lista</a>
    </section>
  </main>
</div>

</body>
</html>

<?php $conn->close(); ?>
