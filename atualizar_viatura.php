<?php
session_start();

// Conexão com base de dados
$host = "localhost";
$user = "root";
$pass = "869444368"; // Altere se necessário
$dbname = "sistema_registo_veiculos";
$port = 3306;

$con = new mysqli($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
    die("Erro de conexão: " . $con->connect_error);
}

// Verifica se o formulário foi submetido
if (isset($_POST['submeter'])) {
    // Validação dos campos recebidos
    $matricula = trim($_POST['matricula']);
    $marca = trim($_POST['marca']);
    $ano = (int) $_POST['ano'];
    $tipo = $_POST['tipo'];

    // Verifica se os campos estão vazios
    if (empty($matricula) || empty($marca) || empty($ano) || empty($tipo)) {
        $_SESSION['erro'] = "Preencha todos os campos.";
        header("Location: listarVeiculo.php");
        exit();
    }

    // Obtém o ID do veículo
    if (!isset($_POST['codigo_veiculo']) && !isset($_GET['id'])) {
        $_SESSION['erro'] = "Código da viatura não fornecido.";
        header("Location: listarVeiculo.php");
        exit();
    }

    $codigo_veiculo = isset($_POST['codigo_veiculo']) ? (int) $_POST['codigo_veiculo'] : (int) $_GET['id'];

    // Atualizar dados
    $sql = "UPDATE veiculos 
            SET matricula = '$matricula',
                marca = '$marca',
                ano_fabrico = $ano,
                tipo = '$tipo'
            WHERE codigo_veiculo = $codigo_veiculo";

    if ($con->query($sql) === TRUE) {
        $_SESSION['sucesso'] = "Veículo atualizado com sucesso.";
    } else {
        $_SESSION['erro'] = "Erro ao atualizar: " . $con->error;
    }

    // Redireciona para a listagem
    header("Location: listarVeiculo.php");
    exit();
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: listarVeiculo.php");
    exit();
}

$con->close();
?>
