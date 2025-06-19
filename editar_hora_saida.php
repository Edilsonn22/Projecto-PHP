<?php
session_start();

// Conexão
$host = "localhost";
$user = "root";
$pass = "869444368";
$dbname = "sistema_registo_veiculos";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname, $port);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}


$codigo = (int) $_GET['codigo'];

// Buscar dados do registo completo
$sql = "SELECT 
    p.codigo_parqueamento,
    p.hora_entrada,
    p.hora_saida,
    p.data_parqueamento,
    p.numero_pista,
    v.matricula,
    v.marca,
    pr.nome AS nome_proprietario
FROM parqueamento p
JOIN veiculos v ON v.codigo_veiculo = p.codigo_veiculo
JOIN proprietarios pr ON pr.codigo_proprietario = p.codigo_proprietario
WHERE p.codigo_parqueamento = $codigo";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Registo não encontrado.";
    exit();
}

$dados = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Editar Hora de Saída</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-box {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #0044ff;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }

        input[type="time"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
        }

        p {
            margin: 8px 0;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #0044ff;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #002db3;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- MENU LATERAL -->
        <aside class="sidebar">
            <img src="logo.png" class="logo">
            <nav class="content">
                <a href="Menu.php" class="active"><i class="fa fa-chart-bar"></i> Dashboard</a>
                <a href="parqueamento.php"><i class="fa fa-list"></i> Parqueamento</a>
                <a href="adicionarVeiculo.php"><i class="fa fa-car"></i> Veículos</a>
                <a href="proprietario.php"><i class="fa fa-user"></i> Proprietários</a>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <h1></h1>
                <div class="user">
                    <img src="user.jpg" alt="User">
                </div>
            </header>
            <div class="form-box">
                <h2>Editar Hora de Saída</h2>

                <p><strong>Matrícula:</strong> <?= htmlspecialchars($dados['matricula']) ?></p>
                <p><strong>Marca:</strong> <?= htmlspecialchars($dados['marca']) ?></p>
                <p><strong>Proprietário:</strong> <?= htmlspecialchars($dados['nome_proprietario']) ?></p>
                <p><strong>Data:</strong> <?= $dados['data_parqueamento'] ?></p>
                <p><strong>Entrada:</strong> <?= $dados['hora_entrada'] ?></p>
                <p><strong>Pista:</strong> <?= $dados['numero_pista'] ?></p>

                <form method="POST" action="atualizar_hora_saida.php">
                    <input type="hidden" name="codigo_parqueamento" value="<?= $dados['codigo_parqueamento'] ?>">

                    <label for="hora_saida">Nova Hora de Saída:</label>
                    <input type="time" name="hora_saida" id="hora_saida" value="<?= $dados['hora_saida'] ?>" required>

                    <button type="submit" name="submeter">Atualizar Hora de Saída</button>
        </main>
        </form>
    </div>

</body>

</html>