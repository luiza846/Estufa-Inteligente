<?php
include("conexao.php");

// Verifica se a imagem foi solicitada por meio de um ID na URL
if (isset($_GET['id_imagem'])) {
    $id_imagem = $_GET['id_imagem'];

    // Consulta o banco de dados para recuperar os dados da imagem
    $sql = "SELECT * FROM imagens WHERE id_imagem = :id_imagem";
    $stmt = $conectaBD->prepare($sql);
    $stmt->bindParam(':id_imagem', $id_imagem, PDO::PARAM_INT);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Configura o cabeçalho HTTP para indicar que você está enviando uma imagem
        header('Content-Type: image/jpeg'); // Mude o tipo de imagem conforme necessário

        // Exibe os dados binários da imagem diretamente
        echo $row['imagem'];
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Imagem</title>
</head>
<body>
    <h1>Exibir Imagem</h1> 
    <?php
    // Lista de imagens armazenadas no banco de dados
    $sql = "SELECT * FROM imagens";
    $result = $conectaBD->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<a href="exibir_imagem.php?id_imagem=' . $row['id_imagem'] . '">Imagem ' . $row['id_imagem'] . '</a><br>';
    }
    ?>
</body>
</html>
