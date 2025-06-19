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

// Verificar se o formulário foi submetido
if (isset($_POST['submeter'])) {
    $codigo = (int) $_POST['codigo_parqueamento'];
    $hora_saida = $_POST['hora_saida'];

    // Verificar se foi preenchida
    if (empty($hora_saida)) {
        $_SESSION['erro'] = "Hora de saída é obrigatória.";
        header("Location: editar_hora_saida.php?codigo=$codigo");
        exit();
    }

    // Atualizar a hora de saída
    $sql = "UPDATE parqueamento 
            SET hora_saida = '$hora_saida' 
            WHERE codigo_parqueamento = $codigo";

    if ($conexao->query($sql) === TRUE) {
        $_SESSION['sucesso'] = "Hora de saída atualizada com sucesso.";
        header("Location: listar_parqueamentos.php");
        exit();
    } else {
        $_SESSION['erro'] = "Erro ao atualizar: " . $conexao->error;
        header("Location: editar_hora_saida.php?codigo=$codigo");
        exit();
    }
} else {
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: listar_parqueamentos.php");
    exit();
}
?>