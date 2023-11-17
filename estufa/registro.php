<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro</title>
</head>
<body class = "body-registro" style="background-image: url(fundoLogin/registro.png);">

<div class = "div-registro">
    <table>

        <tr>
        <th>Data</th>
        <th>Hora</th>
        <th>Temperatura</th>
        <th>Umidade</th>
        </tr>

        <?php 

            // Caminho do arquivo TXT
            $arquivo = 'API/dados.txt';

            // Lê todas as linhas do arquivo em um array
            $linhas = file($arquivo);


            // Itera sobre as últimas linhas
            foreach ($linhas as $linha) {
                // Divide a linha em partes usando espaço como delimitador
                $dados = explode(' ', $linha);

                // Atribui os valores a variáveis
                $data = $dados[0];
                $hora = $dados[1];
                $temperatura = $dados[2];
                $umidade = $dados[3];
            


                echo '<tr>';
                echo '<td>'. $data .'</td>';
                echo '<td>'. $hora .'</td>';
                echo '<td>'. $temperatura .'</td>';
                echo '<td>'. $umidade .'</td>';
                echo '</tr>';
            
            }
        ?>
    </table>

    </div>
</body>
</html>