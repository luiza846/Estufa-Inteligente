<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $temperatura = $_POST['temperatura'];
    $umidade = $_POST['umidade'];
    $nivelAgua = $_POST['nivel_agua'];

    // Data e hora atual no formato desejado
    $data_hora = date('Y/m/d H:i:s');

    // Conteúdo a ser salvo no arquivo, seguindo o formato desejado
    $content = "$data_hora $temperatura $umidade $nivelAgua\n";

    // Nome do arquivo de dados
    $filename = "dados_sensor.txt";

    // Grava no arquivo
    file_put_contents($filename, $content, FILE_APPEND);

    echo "Dados gravados com sucesso";
} else {
    echo "Método de requisição inválido.";
}
?>
