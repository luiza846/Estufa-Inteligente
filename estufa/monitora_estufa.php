<?php
// Verifica se os parâmetros esperados estão presentes
if (isset($_POST['temperatura']) && isset($_POST['umidade']) && isset($_POST['nivelAgua'])) {
    // Lê os valores enviados pelo ESP
    $temperatura = $_POST['temperatura'];
    $umidade = $_POST['umidade'];
    $nivelAgua = $_POST['nivelAgua'];

    // Cria uma string com os dados recebidos
    $dados = "Temperatura: " . $temperatura . "°C\n";
    $dados .= "Umidade: " . $umidade . "%\n";
    $dados .= "Nível de Água: " . $nivelAgua . "\n";
    $dados .= "Data/Hora: " . date('Y-m-d H:i:s') . "\n\n";

    // Caminho para o arquivo de texto onde os dados serão salvos
    $arquivo = '123d.txt';

    // Verifica se o arquivo existe e tem permissão de escrita
    if (is_writable($arquivo)) {
        if (file_put_contents($arquivo, $dados, FILE_APPEND)) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao salvar os dados.";
        }
    } else {
        echo "Arquivo não tem permissão de escrita.";
    }
} else {
    echo "Parâmetros inválidos ou ausentes.";
}
?>
