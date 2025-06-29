<?php
session_start();

// Conexão com base de dados
$host = "localhost";
$user = "root";
$pass = "869444368"; 
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = new mysqli($host, $user, $pass, $dbname, $port);
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Verificar se os dados vieram do formulário
if (isset($_POST['submeter'])) {
    $codigo      = (int) $_POST['codigo_parqueamento'];
    $pista       = $conexao->real_escape_string(trim($_POST['numero_pista']));
    $data        = $_POST['data_parqueamento'];
    $horaEntrada = $_POST['hora_entrada'];

    // Validação simples (pode melhorar conforme necessidade)
    if (empty($pista) || empty($data) || empty($horaEntrada)) {
        $_SESSION['erro'] = "Todos os campos obrigatórios devem ser preenchidos.";
        header("Location: editar_parqueamento.php?codigo=$codigo");
        exit();
    }

    // Atualizar registo
    $sql = "UPDATE parqueamento 
            SET numero_pista = '$pista',
                data_parqueamento = '$data',
                hora_entrada = '$horaEntrada'
            WHERE codigo_parqueamento = $codigo";

    if ($conexao->query($sql) === TRUE) {
        $_SESSION['sucesso'] = "Parqueamento atualizado com sucesso.";
        header("Location: listar_parqueamentos.php");
    } else {
        $_SESSION['erro'] = "Erro ao atualizar: " . $conexao->error;
        header("Location: editar_parqueamento.php?codigo=$codigo");
    }
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: listar_parqueamentos.php");
}
?>
