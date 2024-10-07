<?php
header('Content-Type: application/json');

$servername = "177.153.63.45";
$username = "estufa";
$password = "Hunter231020@#";
$dbname = "estufa";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die(json_encode(["error" => "Falha na conexão: " . $conn->connect_error]));
}

// Cria a consulta SQL
$sql = "SELECT umidade, temperatura FROM estufa WHERE id_estufa = 12";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    while($row = $result->fetch_assoc()) {
        $data = [
            "umidade" => $row["umidade"],
            "temperatura" => $row["temperatura"]
        ];
    }
} else {
    $data = ["message" => "0 resultados"];
}
$conn->close();

echo json_encode($data);
?>
