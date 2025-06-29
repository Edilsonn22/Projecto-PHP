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

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    $_SESSION['erro'] = "ID da viatura não fornecido.";
    header("Location: listarVeiculo.php");
    exit();
}

$id = (int) $_GET['id'];

// Tenta eliminar
$sql = "DELETE FROM veiculos WHERE codigo_veiculo = $id";

if ($conexao->query($sql) === TRUE) {
    $_SESSION['sucesso'] = "Viatura eliminada com sucesso.";
} else {
    $_SESSION['erro'] = "Erro ao eliminar viatura: " . $conexao->error;
}

$conexao->close();
header("Location: listarVeiculo.php");
exit();
?>
