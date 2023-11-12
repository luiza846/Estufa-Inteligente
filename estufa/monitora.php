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

<div class = "div-monitora-umidade">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Umidade', 50],  // Valor inicial, pode ser alterado conforme necessário
          ]);

          var options = {
            width: 400, height: 250,
            greenFrom: 50, greenTo: 100,
            yellowFrom: 25, yellowTo: 50,
            redFrom: 0, redTo: 25,
            minorTicks: 5,
            max: 100  // Valor máximo para 100%
          };

          var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

          chart.draw(data, options);

          // Atualizar os dados do medidor periodicamente
          setInterval(function() {
            // Substitua o valor 50 pelo valor de umidade desejado (de 0 a 100)
            data.setValue(0, 1, Math.round(Math.random() * 100));
            chart.draw(data, options);
          }, 5000);  // Intervalo de atualização em milissegundos
        }
      </script>

    <body>
      <!-- Div para renderizar o gráfico de medidor -->
      <div id="chart_div"></div>
    </body>
</div>
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
?>

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
