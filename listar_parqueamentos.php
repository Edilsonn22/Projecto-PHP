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

// Consulta todos os registos de parqueamento
$sql = "SELECT 
      p.codigo_parqueamento,
      v.matricula,
      v.marca,
      pr.nome AS nome_proprietario,
      p.numero_pista,
      p.data_parqueamento,
      p.hora_entrada,
      p.hora_saida
  FROM parqueamento p
  JOIN veiculos v ON p.codigo_veiculo = v.codigo_veiculo
  JOIN proprietarios pr ON p.codigo_proprietario = pr.codigo_proprietario
  ORDER BY p.codigo_parqueamento ASC
  ";

$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title>Registos de Parqueamento</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .styled-table {
      width: 100%;
      border-collapse: collapse;
      font-family: sans-serif;
      font-size: 14px;
      text-align: left;
    }

    .styled-table thead tr {
      background-color: #0044ff;
      color: #ffffff;
    }

    .styled-table th,
    .styled-table td {
      padding: 12px 15px;
      border: 1px solid #ddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
      background-color: #f9f9f9;
    }

    .styled-table tbody tr:hover {
      background-color: #f1f1f1;
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

    .btn {
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      color: #fff;
      margin-right: 5px;
    }

    .btn.edit {
      background-color: #4CAF50;
    }

    .btn.delete {
      background-color: #f44336;
    }

    .btn.hora {
      background-color: #0044ff;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <img src="logo.png" class="logo">
 <nav class="content">
        <a href="Menu.php" ><i class="fa fa-chart-bar"></i> Dashboard</a>
        <a href="parqueamento.php" class="active"><i class="fa fa-list"></i> Parqueamento</a>
        <a href="adicionarVeiculo.php"><i class="fa fa-car"></i> Veículos</a>
        <a href="proprietario.php" ><i class="fa fa-user"></i> Proprietários</a>
      </nav>
      <div class="footer">
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Sair</a>
      </div>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
      <header>
        <h1>Lista de Parqueamentos</h1>
        <div class="user">
          <img src="user.jpg" alt="User">
        </div>
      </header>

      <section class="content-box">
        <?php if (isset($_SESSION['sucesso'])): ?>
          <div class="alert alert-success">
            <?= $_SESSION['sucesso'];
            unset($_SESSION['sucesso']); ?>
          </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['erro'])): ?>
          <div class="alert alert-error">
            <?= $_SESSION['erro'];
            unset($_SESSION['erro']); ?>
          </div>
        <?php endif; ?>

        <table class="styled-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Matrícula</th>
              <th>Marca</th>
              <th>Proprietário</th>
              <th>Pista</th>
              <th>Data</th>
              <th>Entrada</th>
              <th>Saída</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($resultado->num_rows > 0): ?>
              <?php while ($reg = $resultado->fetch_assoc()): ?>
                <tr>
                  <td><?= $reg['codigo_parqueamento'] ?></td>
                  <td><?= htmlspecialchars($reg['matricula']) ?></td>
                  <td><?= htmlspecialchars($reg['marca']) ?></td>
                  <td><?= htmlspecialchars($reg['nome_proprietario']) ?></td>
                  <td><?= $reg['numero_pista'] ?></td>
                  <td><?= $reg['data_parqueamento'] ?></td>
                  <td><?= $reg['hora_entrada'] ?></td>
                  <td><?= $reg['hora_saida'] ?: '<em>—</em>' ?></td>
                  <td>
                    <a href="editar_parqueamento.php?codigo=<?= $reg['codigo_parqueamento'] ?>" class="btn edit"><i
                        class="fa fa-pen"></i></a>
                    <a href="excluirParqueamento.php?codigo=<?= $reg['codigo_parqueamento'] ?>" class="btn delete"
                      onclick="return confirm('Deseja eliminar este registo?');"><i class="fa fa-trash"></i></a>
                    <a href="editar_hora_saida.php?codigo=<?= $reg['codigo_parqueamento'] ?>" class="btn hora"><i
                        class="fa fa-clock"></i> Saída</a>

                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="9">Nenhum registo encontrado.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>

</html>
<?php $conexao->close(); ?>