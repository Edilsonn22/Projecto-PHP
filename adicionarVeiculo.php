<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Registo de Veículo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: #f4f6fc;
      color: #333;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    /* Menu lateral */
    .sidebar {
      width: 240px;
      background: #0044ff;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      padding: 20px;
    }

    .logo {
      width: 10vh;
      margin: 0 auto 20px auto;
    }

    .sidebar nav a {
      color: white;
      text-decoration: none;
      padding: 12px;
      display: flex;
      align-items: center;
      gap: 10px;
      border-radius: 10px;
      transition: 0.3s;
    }

    .sidebar nav a:hover,
    .sidebar nav a.active {
      background: #002db3;
    }

    /* Conteúdo principal */
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

    input[type="text"], input[type="number"] {
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
  </style>
</head>
<body>
  <div class="container">
    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <img src="logo.png" class="logo">
      <nav class="content">
        <a href="Menu.php"><i class="fa fa-chart-bar"></i> Dashboard    </a>
        <a href="parqueamento.php"><i class="fa fa-list"></i> Parqueamento</a>
        <a href="adicionarVeiculo.php" class="active"><i class="fa fa-car"></i> Veículos</a>
        <a href="proprietarios.html"><i class="fa fa-user"></i> Proprietários</a>
     
      </nav>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
      <header>
        <h1>Registar Novo Veículo</h1>
        <div class="user">
          <img src="user.jpg" alt="Utilizador">
        </div>
      </header>

      <section class="content-box">
  <form action="inserirVeiculo.php" method="POST">
    <div style="display: flex; flex-direction: column; gap: 20px;">

      <div>
        <label for="matricula"><strong>Matrícula:</strong></label><br>
        <input type="text" id="matricula" name="matricula" placeholder="ABC-123-MZ" required>
      </div>

      <div>
        <label for="marca"><strong>Marca:</strong></label><br>
        <input type="text" id="marca" name="marca" placeholder="Toyota Corolla..." required>
      </div>

      <div>
        <label for="ano"><strong>Ano de Fabrico:</strong></label><br>
        <input type="number" id="ano" name="ano" placeholder="Ex: 2015" min="1900" max="2099" required>
      </div>

      <div>
        <label><strong>Tipo:</strong></label><br>
        <label style="margin-right: 15px;">
          <input type="radio" name="tipo" value="Ligeiro" required> Ligeiro
        </label>
        <label>
          <input type="radio" name="tipo" value="Pesado" required> Pesado
        </label>
      </div>

      <button type="submit" name="submeter">Registar Veículo</button>
    </div>
  </form>
</section>

    </main>
  </div>
</body>
</html>