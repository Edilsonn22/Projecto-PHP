<?php
session_start();

// Conexão
$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$con = new mysqli($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
    die("Erro de conexão: " . $con->connect_error);
}

// Validar se foi passado o código
if (!isset($_GET['id'])) {
    echo "ID não fornecido.";
    exit();
}

$id = (int) $_GET['id'];

// Buscar viatura
$sql = "SELECT * FROM veiculos WHERE codigo_veiculo = $id";
$resultado = $con->query($sql);
if ($resultado->num_rows === 0) {
    echo "Viatura não encontrada.";
    exit();
}
$veiculo = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title>Registo de Veículo</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>

    .main-content {
      flex: 1;
      padding: 30px;
      background: #fff;
      overflow-y: auto;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .user img {
      width: 40px;
      border-radius: 50%;
    }

    .content-box {
      margin-top: 30px;
      padding: 20px;
      background: #eef1fb;
      border-radius: 12px;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    button {
      padding: 12px;
      background-color: #0044ff;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
    }

    button:hover {
      background-color: #002db3;
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
        <a href="Menu.php"><i class="fa fa-chart-bar"></i> Dashboard </a>
        <a href="parqueamento.php"><i class="fa fa-list"></i> Parqueamento</a>
        <a href="adicionarVeiculo.php" class="active"><i class="fa fa-car"></i> Veículos</a>
        <a href="proprietario.php"><i class="fa fa-user"></i> Proprietários</a>
      </nav>
      <div class="footer">
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Sair</a>
      </div>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
      <header>
        <h1>Editar Veículo</h1>
        <div class="user">
          <img src="user.jpg" alt="Utilizador">
        </div>
      </header>
        <div style="text-align: right; margin-top: 15px;">
          <a href="listarVeiculo.php" class="btn-secundario"><i class="fa fa-list"></i> Ver Lista</a>
        </div>
      <section class="content-box">
        <form action="atualizar_viatura.php" method="POST">
          <div style="display: flex; flex-direction: column; gap: 20px;">
          
                  <input type="hidden" name="codigo_veiculo" value="<?= $veiculo['codigo_veiculo'] ?>">
            <div>
              <label for="matricula"><strong>Matrícula:</strong></label><br>
              <input type="text" id="matricula" name="matricula"value="<?= htmlspecialchars($veiculo['matricula']) ?>"required>
            </div>

            <div>
              <label for="marca"><strong>Marca:</strong></label><br>
              <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($veiculo['marca']) ?>" required>
            </div>

            <div>
              <label for="ano"><strong>Ano de Fabrico:</strong></label><br>
              <input type="number" id="ano" name="ano" placeholder="Ex: 2015" value="<?= htmlspecialchars($veiculo['ano_fabrico']) ?>" required>
            </div>

            <div>
              <label><strong>Tipo:</strong></label><br>
              <label style="margin-right: 15px;">
                <input type="radio" name="tipo" value="Ligeiro" <?= $veiculo['tipo'] == "Ligeiro" ? 'checked' : '' ?> required> Ligeiro
              </label>
              <label>
                <input type="radio" name="tipo"  value="Pesado" <?= $veiculo['tipo'] == "Pesado" ? 'checked' : '' ?> required> Pesado
              </label>
            </div>
                <button type="submit" name="submeter">Atualizar Veículo</button>

          </div>
        </form>
      </section>

    </main>
  </div>
</body>

</html>