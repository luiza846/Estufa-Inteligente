<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Gráfico de Temperatura</title>
    <!-- Inclua o Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="tela-principal" style="background-image: url(fundoLogin/monitora.png);">

<div class = "div-monitora"></div>
<div class = "div-monitora-sobre-planta">dados da planta aqui
  <form>
    
  </form>
</div>

<div class = "div-monitora-all">

<?php
// Caminho do arquivo TXT
$arquivo = 'teste.txt';

// Lê todas as linhas do arquivo em um array
$linhas = file($arquivo);

// Inicializa arrays para temperatura e horário
$temperaturaData = [];
$horarioData = [];

// Pega apenas as últimas 3 linhas do array (conforme seu exemplo)
$ultimas_linhas = array_slice($linhas, -5);

// Itera sobre as últimas linhas
foreach ($ultimas_linhas as $linha) {
    // Divide a linha em partes usando espaço como delimitador
    $dados = explode(' ', $linha);

    // Atribui os valores a variáveis
    $data = $dados[0];
    $hora = $dados[1];
    $temperatura = $dados[2];
    $umidade = $dados[3];

    // Adiciona os valores aos arrays
    $horarioData[] = $hora;
    $temperaturaData[] = $temperatura;
}

// Converte os arrays para JSON
$temperaturaDataJSON = json_encode($temperaturaData);
$horarioDataJSON = json_encode($horarioData);

$umidade = intval($umidade);
$umidadeJSON = json_encode($umidade);
?>

<div class="div-monitora-umidade">
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawChart);

        var umidade = <?php echo $umidadeJSON; ?>;

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Umidade', umidade],  // Usando o valor da última linha
            ]);

            var options = {
              width: 500, height: 350,
              greenFrom: 75, greenTo: 100,
              yellowFrom: 25, yellowTo: 75,
              redFrom: 0, redTo: 25,
              minorTicks: 5,
              max: 100,  // Valor máximo para 100%
              greenColor: {color: '#4B9CCA'}, 
              yellowColor: {color: "#8CC3E2"},
              redColor: {color: "#C5E3F4"}
            };

            
            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
    
    <!-- Div para renderizar o gráfico de medidor -->
    <div id="chart_div"></div>
</div>



<!-- Seu HTML e CSS -->

<div class="div-monitora-temp">
    <!-- O gráfico será renderizado aqui -->
    <canvas id="myChart"></canvas>

    <!-- Seu script para criar o gráfico -->
    <script>
        // Seus dados de temperatura e horário (vindos do PHP)
        var temperaturaData = <?php echo $temperaturaDataJSON; ?>;
        var horarioData = <?php echo $horarioDataJSON; ?>;

        // Obtendo o contexto do canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Criando o gráfico
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: horarioData,
                datasets: [{
                    label: 'Temperatura (°C)',
                    data: temperaturaData,
                    backgroundColor: 'rgba(77, 129, 36, 0.2)',
                    borderColor: 'rgba(77, 129, 36, 2.0)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>

</div></div>
</body>
</html>
