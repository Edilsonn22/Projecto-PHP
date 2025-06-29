<?php
session_start();

// Conexão
$host = "localhost";
$user = "root";
$pass = "869444368"; // Ajusta conforme a tua base
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = new mysqli($host, $user, $pass, $dbname, $port);
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Verifica se o formulário foi submetido
if (isset($_POST['submeter'])) {

    $codigo = (int) $_POST['codigo_proprietario'];
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $bi = trim($_POST['BI']);

    // se estiver vazio
    if (empty($nome) || empty($telefone) || empty($bi)) {
        $_SESSION['erro'] = "Todos os campos são obrigatórios.";
        header("Location: editar_proprietario.php?id=$codigo");
        exit();
    }

    // Atualiza o registo
    $sql = "UPDATE proprietarios 
            SET nome = '$nome', telefone = '$telefone', BI = '$bi' 
            WHERE codigo_proprietario = $codigo";

    if ($conexao->query($sql) === TRUE) {
        $_SESSION['sucesso'] = "Proprietário atualizado com sucesso!";
        header("Location: listarProprietario.php");
    } else {
        $_SESSION['erro'] = "Erro ao atualizar: " . $conexao->error;
        header("Location: editar_proprietario.php?id=$codigo");
    }

} else {
    // Se alguém tentar aceder direto
    $_SESSION['erro'] = "Acesso inválido.";
    header("Location: proprietario.php");
}
?>
