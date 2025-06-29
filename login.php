<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Roboto", sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: whitesmoke;
      padding: 40px 50px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    img{
      width:10vh;
      height: auto;

    }

    h1 {
      font-weight: 400;
      margin-bottom: 30px;
      color: #202124;
      font-size: 24px;
    }

    input {
      width: 100%;
      padding: 14px 12px;
      margin-bottom: 20px;
      font-size: 16px;
      border: 1px solid #dadce0;
      border-radius: 4px;
      background-color: #fff;
      transition: border-color 0.2s;
    }

    input:focus {
      border-color: #1a73e8;
      outline: none;
      box-shadow: 0 0 0 1px #1a73e8;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #1a73e8;
      color: white;
      font-weight: 500;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #1558b0;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      color: #1a73e8;
      font-size: 14px;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: #d93025;
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">

    <form action="logarUsuario.php" method="post" class="login">
      <h1>Login</h1>
      <input type="text" name="user" id="user" placeholder="Nome de utilizador" required />
      <input type="password" name="password" id="password" placeholder="Palavra-passe" onblur="validarSenha()" required />
      <button type="submit" id="enviar" value="Enviar">Entrar</button>
      <?php session_start(); ?>

        <?php if (isset($_SESSION['erro_login'])): ?>
                <p style="color: red; text-align: center;">
                    <?= $_SESSION['erro_login']; ?>
                </p>
                    <?php unset($_SESSION['erro_login']); ?>
            <?php endif; ?>
    </form>
  </div>
</body>
</html>
