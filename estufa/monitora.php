<?php
include('protect.php');
# Fazer conexão com BD
try
{
    # Conexão com MySQL usando PDO
    $conectaBD = new PDO("mysql:host=127.0.0.1;port=3306;dbname=estufa", "root", "");
    $conectaBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Preparar a consulta SQL
    $sql = "SELECT * FROM estufa";

    # Preparar e executar a consulta
    $stmt = $conectaBD->query($sql);

}
catch(PDOException $erro)
{
    # Informar que houve erro ao fazer a conexão com BD
    echo "Houve erro ao fazer a conexão com o banco de dados!";
}

?>
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

<div class = "div-monitora-all">

<?php
// Caminho do arquivo TXT
$arquivo = 'API/dados.txt';

// Lê todas as linhas do arquivo em um array
$linhas = file($arquivo);

// Inicializa arrays para temperatura e horário
$temperaturaData = [];
$horarioData = [];

// Pega apenas as últimas 3 linhas do array (conforme seu exemplo)
$ultimas_linhas = array_slice($linhas, -10);

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
    $umidadeData[] = $umidade;
}

// Converte os arrays para JSON
$temperaturaDataJSON = json_encode($temperaturaData);
$horarioDataJSON = json_encode($horarioData);

$umidade = intval($umidade);
$umidadeDataJSON = json_encode($umidadeData);
?>

<div class="div-monitora-umidade">

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
<div class="div-monitora-umidade">
    <!-- O gráfico será renderizado aqui -->
    <canvas id="myChart"></canvas>

    <!-- Seu script para criar o gráfico -->
    <script>
        // Seus dados de temperatura e horário (vindos do PHP)
        var umidadeData = <?php echo $umidadeDataJSON; ?>;
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
</div>
</div>
<!-- BOTAO PARA RECEBER OS DADOS DO ARDUINO (TEM Q ESTAR DENTRO DO FORM DESSA FORMA) ALTERAR O ESTILO DO BOTAO SEM ALTERAR O TYPE DELE -->
<form method="GET" action="http://localhost:3000/ReceberDados">
        <input type="submit" value="Iniciar monitoramento">
    </form>
</body>
</html>
