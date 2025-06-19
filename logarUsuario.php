<?php
session_start();

$login = $_POST['user'];
$password = $_POST['password'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = mysqli_connect($host, $user, $pass, $dbname, $port) or
    die("Sem conexao com o servidor");


$sql = "SELECT * FROM login_usuarios WHERE username = '".$login."' AND senha = '".$password."';";

echo "<script>console.log('" . $sql . "')</script>";
echo($sql);

$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
      unset($_SESSION['erro_login']);
    header('location: Menu.php');
    exit();
} else {
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    $_SESSION['erro_login'] = "Nome de utilizador ou palavra-passe incorretos.";
    header('location: login.php');
    exit();
}
?>
