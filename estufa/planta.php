<?php
include('protect.php');
# Fazer conexão com BD
try
{
    # Conexão com MySQL usando PDO
    $conectaBD = new PDO("mysql:host=127.0.0.1;port=3306;dbname=estufa", "root", "");
    $conectaBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Preparar a consulta SQL
    $sql = "SELECT * FROM planta";

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
    <link rel="stylesheet" href="css/generalInterface.css">
    <title>Planta</title>
</head>
<body class="body-planta">
    <div class="div-painel-planta">

    <form action="deletaPlanta.php" method="POST"></form>
    </div>
                <table>

                <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data de Criação</th>
                <th>Umidade</th>
                <th>Temperatura</th>
                </tr>
                
                <?php

                $id_usuario = $_SESSION['id_usuario'];
                $sql = "SELECT * FROM planta WHERE id_usuario = :id_usuario";
                
                $stmt = $conectaBD->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        echo '<tr>';
                        echo '<td>'. $dados['id_planta'] .'</td>';
                        echo '<td>'. $dados['nome'] .'</td>';
                        echo '<td>'. $dados['data_criacao'] .'</td>';
                        echo '<td>'. $dados['umidade'] .'%</td>';
                        echo '<td>'. $dados['temperatura'] .'°C</td>';
                        echo '<td><button class="btnExcluir" data-id_planta="' . $dados['id_planta'] . '">Excluir</button></td>';
                }
                
                ?>
</table>














            </form>

    


















        <!--mostrar historico de todas as plantas que foram cadastradas e excluidas-->
        <script>
            function mostrarHistorico(){
                document.getElementById("histoPlantas").style.display = "block";
            }
        </script>
</body>
</html>