<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conexao = new mysqli($host, $user, $pass, $dbname, $port);

if ($conexao->connect_error) {
    echo "Conexão MySQL falhou: " . $conexao->connect_error;
    exit();
} else {
    if (isset($_GET["codigo"])) {
        $codigo = $conexao->real_escape_string($_GET["codigo"]);

        $sql = "DELETE FROM parqueamento WHERE codigo_parqueamento= '$codigo'";

        if ($conexao->query($sql) === TRUE) {
            header("Location: listar_parqueamentos.php");
            exit();
        } else {
            echo "Erro das instruções SQL: " . $sql . "<br>" . $conexao->error;
        }
    } else {
        echo "Código do aluno não informado.";
    }
}

$conexao->close();
?>