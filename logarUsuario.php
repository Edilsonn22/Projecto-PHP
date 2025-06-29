<?php
session_start(); // Iniciar sessão

$login = $_POST['user'];
$password = $_POST['password'];

// Habilita erros no mysqli (sem alterar tua lógica de conexão)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

// Conexão padrão (mantida)
$conexao = mysqli_connect($host, $user, $pass, $dbname, $port) or
    die("Sem conexao com o servidor");

// Consulta SQL
$sql = "SELECT * FROM login_usuarios WHERE username = '".$login."' AND senha = '".$password."';";


$result = $conexao->query($sql);

// Verificação do login
if ($result->num_rows > 0) {
    // VARIÁVEIS DE SESSÃO
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['ultima_entrada'] = date("Y-m-d H:i:s");

    // COOKIE: guarda o nome de usuário e última entrada (por 30 dias)
    setcookie("ultimo_login", $login, time() + (86400 * 30), "/");
    setcookie("ultima_entrada", $_SESSION['ultima_entrada'], time() + (86400 * 30), "/");

    unset($_SESSION['erro_login']);
    header('location: Menu.php');
    exit();
} else {
    // Limpa sessão
    unset($_SESSION['login']);
    unset($_SESSION['password']);

    $_SESSION['erro_login'] = "Nome de utilizador ou palavra-passe incorretos.";
    header('location: login.php');
    exit();
}
?>
