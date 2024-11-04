<?php
header('Content-Type: text/plain');  // Define o conteúdo como texto simples

$servername = "177.153.63.45";
$username = "estufa";
$password = "Hunter231020@#";
$dbname = "estufa";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Cria a consulta SQL
$sql = "SELECT umidade, temperatura FROM estufa WHERE id_estufa = 19";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    while($row = $result->fetch_assoc()) {
        echo "umidade: " . $row["umidade"] . "\n";
        echo "temperatura: " . $row["temperatura"] . "\n";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?> 