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

// Só processa se foi submetido o formulário
if (isset($_POST['submeter'])) {
    $matricula = $conexao->real_escape_string($_POST['matricula']);
    $marca = $conexao->real_escape_string($_POST['marca']);
    $ano = (int) $_POST['ano'];
    $tipo = $conexao->real_escape_string($_POST['tipo']);

    // Inserção
    $sql = "INSERT INTO veiculos (matricula, marca, ano_fabrico, tipo)
            VALUES ('$matricula', '$marca', $ano, '$tipo')";

    if ($conexao->query($sql) === TRUE) {
        $_SESSION['sucesso'] = "Veículo registado com sucesso!";
        header("Location: parqueamento.php"); // Leva o utilizador para o parqueamento
        exit();
    } else {
        $_SESSION['erro'] = "Erro ao registar veículo: " . $conexao->error;
        header("Location: adicionarVeiculo.php");
        exit();
    }
}
?>
