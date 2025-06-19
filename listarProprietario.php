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

  // Consulta de todos os proprietários
  $sql = "SELECT codigo_proprietario, nome, telefone, BI FROM proprietarios ORDER BY codigo_proprietario DESC";
  $resultado = $conexao->query($sql);
  ?>
  <!DOCTYPE html>
  <html lang="pt">
  <head>
    <meta charset="UTF-8">
    <title>Lista de Proprietários</title>
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

      .styled-table th, .styled-table td {
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
    </style>
  </head>
  <body>
  <div class="container">
    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <img src="logo.png" class="logo">
      <nav class="content">
        <a href="Menu.php"><i class="fa fa-chart-bar"></i> Dashboard</a>
        <a href="veiculos.php"><i class="fa fa-car"></i> Veículos</a>
        <a href="proprietarios.php" class="active"><i class="fa fa-user"></i> Proprietários</a>
        <a href="listar_parqueamentos.php"><i class="fa fa-list"></i> Parqueamento</a>
      </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
      <header>
        <h1>Lista de Proprietários</h1>
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
              <th>Nome</th>
              <th>Telefone</th>
              <th>BI</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($resultado->num_rows > 0): ?>
              <?php while ($proprietario = $resultado->fetch_assoc()): ?>
                <tr>
                  <td><?= $proprietario['codigo_proprietario'] ?></td>
                  <td><?= htmlspecialchars($proprietario['nome']) ?></td>
                  <td><?= htmlspecialchars($proprietario['telefone']) ?></td>
                  <td><?= htmlspecialchars($proprietario['BI']) ?></td>
                  <td>
                    <a href="editar_proprietario.php?id=<?= $proprietario['codigo_proprietario'] ?>" class="btn edit"><i class="fa fa-pen"></i></a>
                    <a href="eliminar_proprietario.php?id=<?= $proprietario['codigo_proprietario'] ?>" class="btn delete" onclick="return confirm('Deseja eliminar este proprietário?');"><i class="fa fa-trash"></i></a>
                  </td>


                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="5">Nenhum proprietário registado.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>
  </body>
  </html>

  <?php $conexao->close(); ?>
