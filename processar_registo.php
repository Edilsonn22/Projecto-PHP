<?php
session_start();
// Conexão
$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = new mysqli($host, $user, $pass, $dbname, $port);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Consulta para obter os dados da tabela combinando veículos, registos e proprietários
$sql = "SELECT 
    v.codigo_veiculo,
    v.matricula,
    v.marca,
    v.ano_fabrico,
    p.nome AS nome_proprietario
FROM veiculos v
JOIN proprietarios p ON v.codigo_proprietario = p.codigo_proprietario
ORDER BY v.codigo_veiculo DESC;";

$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Veículos - Gestão de Parque</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
/* Adiciona isso no <style> do <head> ou em style.css */

.styled-table {
  width: 100%;
  border-collapse: collapse;
  font-family: sans-serif;
  font-size: 14px;
  text-align: left;
}

.styled-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
}

.styled-table th, .styled-table td {
  padding: 12px 15px;
  border: 1px solid #dddddd;
}

.styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.styled-table tbody tr:hover {
  background-color: #f1f1f1;
}

.btn {
  padding: 6px 10px;
  border: none;
  border-radius: 4px;
  text-decoration: none;
  color: #fff;
  margin-right: 5px;
}

.btn.edit {
  background-color: #4CAF50; /* Verde */
}

.btn.delete {
  background-color: #f44336; /* Vermelho */
}

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 4px;
    }
    .alert-success {
      background-color: #dff0d8;
      color: #3c763d;
    }
    .alert-error {
      background-color: #f2dede;
      color: #a94442;
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
      <a href="adicionarVeiculo.php" class="active"><i class="fa fa-car"></i> Veículos</a>
      <a href="proprietarios.html"><i class="fa fa-user"></i> Proprietários</a>
      <a href="registos.html"><i class="fa fa-list"></i> Registos</a>
    </nav>
    <div class="footer">
      <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Sair</a>
    </div>
  </aside>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="main-content">
    <header>
      <h1>Lista de Veículos</h1>
      <div class="user">
        <img src="user.jpg" alt="User">
      </div>
    </header>

    <section class="content-box">
      <?php if (isset($_SESSION['sucesso'])): ?>
        <div class="alert alert-success">
          <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
        </div>
      <?php endif; ?>
      
      <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-error">
          <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
      <?php endif; ?>

      <table class="styled-table">
        <thead>
          <tr>
            <th>Código</th>
            <th>Matrícula</th>
            <th>Modelo</th>
            <th>Proprietário</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($resultado->num_rows > 0): ?>
            <?php while ($linha = $resultado->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($linha['codigo_veiculo']) ?></td>
                <td><?= htmlspecialchars($linha['matricula']) ?></td>
                <td><?= htmlspecialchars($linha['marca']) ?></td>
                <td><?= htmlspecialchars($linha['nome_proprietario']) ?></td>
                <td>
                  <a href="editar_veiculo.php?id=<?= $linha['codigo_veiculo'] ?>" class="btn edit"><i class="fa fa-pen"></i></a>
                  <a href="eliminar_veiculo.php?id=<?= $linha['codigo_veiculo'] ?>" class="btn delete" onclick="return confirm('Tem certeza que deseja eliminar este veículo?');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="5">Nenhum veículo registado.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>
</div>
</body>
</html>
<?php $conexao->close(); ?>