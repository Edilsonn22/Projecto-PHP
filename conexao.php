<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conexao</title>
</head>
<body>
     <?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $host = "localhost";
        $user = "root";
        $pass = "869444368";
        $dbname = "sistema_registo_veiculos";
        $port = 3306;

        $conexao = mysqli_connect($host, $user, $pass, $dbname, $port);
        if ($conexao -> connect_error){
            echo "conexao MySQL Falhou: " . $mysqli -> connect_error;
            exit();
         
        }else{
            echo "Conexao de PHP com MySQL feito com sucesso usando: ", $conexao -> host_info;
          
        }
    ?>    
</body>
</html>