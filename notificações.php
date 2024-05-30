<?php
$dbHost = '34.95.244.237';
$dbUsername = 'turma3';
$dbPassword = '123456';
$dbName = 'bd_php';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Consulta para obter os dados da tabela 'mensagem'
$sql = "SELECT email, nome, telefone, mensagem FROM mensagem";
$resultado = $conexao->query($sql);

$mensagens = [];
if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $mensagens[] = $row;
    }
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" href='home.css'>
    <style>
        .main {
            max-height: 60vh; /* Define a altura máxima como 75% da altura da viewport */
            overflow-y: auto; /* Adiciona a barra de rolagem vertical */
            padding-top: 80px; /* Adiciona espaço para evitar que a última mensagem seja cortada */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"></div>
        <div class="main">
            <h4>Notificações</h4>
            <div class="list-group">
                <?php
                // Obter a data e hora atual
                $dataAtual = date("d/m/Y H:i:s");
                foreach ($mensagens as $mensagem): ?>
                <br>
                <a href="#" class="list-group-item list-group-item-action list-group-item-info">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1"><strong><?php echo htmlspecialchars($mensagem['email']); ?></strong></h6>
                    <small><?php echo htmlspecialchars($dataAtual); ?></small>
                  </div>
                  <small class="mb-1">
                    Nome: <?php echo htmlspecialchars($mensagem['nome']); ?><br>
                    Telefone: <?php echo htmlspecialchars($mensagem['telefone']); ?><br>
                    Mensagem: <?php echo nl2br(htmlspecialchars($mensagem['mensagem'])); ?>
                  </small><br>
                  <small>clique aqui para envio do formulário triagem</small>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="footer">
          <button class="button" style="background-color: #fff; color: #000;" onclick="window.location.href='tela_admin.html';">Menu</button>
          <button class="button" style="background-color:black; color:white;" onclick="window.location.href='login.php';">Sair</button>
        </div>
    </div>
</body>
</html>
