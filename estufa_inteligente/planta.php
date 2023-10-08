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
    <link rel="stylesheet" href="css/planta.css">
    <title>Planta</title>
</head>
<body>
    <!--DPS APAGAR-->
    <?php echo "ID_USUARIO: ", $_SESSION['id_usuario']; ?>
    <div class="div1">
            <form action="editDadosPlanta.php" method="post">
                <h1>Planta</h1>
                <?php
                    $id_usuario = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM planta WHERE id_usuario = :id_usuario";

                    # Preparar e executar a consulta com a cláusula WHERE
                    $stmt = $conectaBD->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "ID da Planta: ",$dados["id_planta"],"<br>"; 
                    echo "ID do Usuário: ",$dados["id_usuario"],"<br>";
                    echo "Nome: ",$dados["nome"],"<br>"; 
                    echo "Data criação: ",$dados["data_criacao"],"<br>"; 
                    echo "Umidade: ",$dados["umidade"],"%<br>"; 
                    echo "Temperatura: ",$dados["temperatura"],"°C<br>"; 
                    }
                ?>
                    <input type="button" value="Histórico" onclick="mostrarHistorico()">
                    
                    <!--caso usuario queira ver o historico-->
                    <div id="histoPlantas" style="display: none;">
                        <?php
                            echo "teste";
                        ?>
                    </div>

                    <h4>EDITAR *TESTE*</h4>
                    Nome:<input type="text" name="campoNomePlanta"><br>
                    Umidade:<input type="text" name="campoUmidade"><br>
                    Temperatura:<input type="text" name="campoTemperatura"><br>
                    <input type="submit" value="EDITAR">
                    <div class="full-box">
                        <a href="telaPrincipal.php">Voltar</a>
                    </div>
            </form>

    </div>

        <!--mostrar historico de todas as plantas que foram cadastradas e excluidas-->
        <script>
            function mostrarHistorico(){
                document.getElementById("histoPlantas").style.display = "block";
            }
        </script>
</body>
</html>