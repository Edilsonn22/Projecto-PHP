<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Registo de Proprietário</title>
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
      <a href="Menu.php"><i class="fa fa-chart-bar"></i> Dashboard</a>
        <a href="parqueamento.php" ><i class="fa fa-list"></i> Parqueamento</a>
      <a href="adicionarVeiculo.php"><i class="fa fa-car"></i> Veículos</a>
      <a href="proprietario.php" class="active"><i class="fa fa-user"></i> Proprietários</a>

    </nav>
  </aside>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="main-content">
    <header>
      <h1>Registar Novo Proprietário</h1>
      <div class="user">
        <img src="user.jpg" alt="Utilizador">
      </div>
    </header>

    <section class="content-box">
      <form action="inserirProprietario.php" method="POST">
        <div style="display: flex; flex-direction: column; gap: 20px;">
          <div>
            <label for="nome"><strong>Nome:</strong></label><br>
            <input type="text" id="nome" name="nome"  required>
          </div>

          <div>
            <label for="telefone"><strong>Telefone:</strong></label><br>
            <input type="text" id="telefone" name="telefone" placeholder="Ex: +258 84 ......" required>
          </div>

          <div>
            <label for="bi"><strong>BI (Bilhete de Identidade):</strong></label><br>
            <input type="text" id="bi" name="bi" required>
          </div>

          <button type="submit" name="submeter">Registar Proprietário</button>
        </div>
      </form>
    </section>
  </main>
</div>
</body>
</html>
