<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = new mysqli($host, $user, $pass, $dbname, $port);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

if (isset($_POST['submeter'])) {
    $nome = $conexao->real_escape_string($_POST['nome']);
    $telefone = $conexao->real_escape_string($_POST['telefone']);
    $bi = $conexao->real_escape_string($_POST['bi']);

    $sql = "INSERT INTO proprietarios (nome, telefone, BI)
            VALUES ('$nome', '$telefone', '$bi')";

    if ($conexao->query($sql) === TRUE) {
        $_SESSION['sucesso'] = "Proprietário registado com sucesso!";
        header("Location: parqueamento.php");
        exit();
    } else {
        $_SESSION['erro'] = "Erro ao registar proprietário: " . $conexao->error;
        header("Location: proprietario.php");
        exit();
    }
}
?>
