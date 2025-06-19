<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$con = new mysqli($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}

if (isset($_POST['submeter'])) {
    $codigoVeiculo = (int) $_POST['codigo_viatura'];
    $codigoProprietario = (int) $_POST['codigo_proprietario'];
    $numeroPista = $con->real_escape_string($_POST['numero_pista']);
    $data = $_POST['data_parqueamento'];
    $horaEntrada = $_POST['hora_entrada'];
    $horaSaida = $_POST['hora_saida'] ?: null;

    $sql = "
        INSERT INTO parqueamento (
            codigo_veiculo, codigo_proprietario, numero_pista,
            data_parqueamento, hora_entrada
        )
        VALUES (
            $codigoVeiculo, $codigoProprietario, '$numeroPista',
            '$data', '$horaEntrada' 
        )
    ";

    if ($con->query($sql) === TRUE) {
        header("Location: listar_parqueamentos.php?sucesso=1");
        exit();
    } else {
        $erro = urlencode("Erro ao registar: " . $con->error);
        header("Location: parqueamento.php?erro=$erro");
        exit();
    }
}
?>
