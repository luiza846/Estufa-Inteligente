<?php
include('protect.php');
# Fazer conexão com BD
try
{
    # Conexão com MySQL usando PDO
    $conectaBD = new PDO("mysql:host=127.0.0.1;port=3306;dbname=estufa", "root", "");
    $conectaBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Preparar a consulta SQL
    $sql = "SELECT * FROM usuario";

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/interface.css">

    <title>Painel</title>
</head>

<body class="tela-principal" style="background-image: url(fundoLogin/telaPrinc.png);">    

    <!--menu secundario-->
    <div class="header-2">

    </div>
        <div class="menu">
            <ul>
                <li><a href="">HOME</a></li>
                <li><a href="sobre.php">SOBRE</a></li>
                <li><a href="">SERVIÇOS</a></li>
                <li><a href="">PAGINAS</a></li>
                <li><a href="contato.php">CONTATO</a></li>
                <?php
                    $id_usuario = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

                    # Preparar e executar a consulta com a cláusula WHERE
                    $stmt = $conectaBD->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $foto_usuario = $dados["imagem"];
                    echo "<img src='imagens/$id_usuario/$foto_usuario' width='75'>";
                    }
            ?>
            </ul>


        </div>

    <div class = "cadastrePlanta">

        <a href="cadasPlanta.php"><input type="button" value="Cadastrar Planta" name="btnMonitorar" id="btns"></a>
    
    </div>
    <div class="menu2">
    <?php
                    $id_usuario = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

                    # Preparar e executar a consulta com a cláusula WHERE
                    $stmt = $conectaBD->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $foto_usuario = $dados["imagem"];
                    echo "<br><img src='imagens/$id_usuario/$foto_usuario' width='150'>","<br>";
                    echo "<h2>",$dados["nome"],"<br></h2>"; 
                    }
            ?>
        <a href="perfil.php"><input type="button" value="Meu perfil" name="btnPerfil" id="btns"></a>
        <a href="monitora.php"><input type="button" value="Monitoramento" name="btnMonitorar" id="btns"></a>
        <a href="planta.php"><input type="button" value="Planta" name="btnPlanta" id="btns"></a>
        <a href="registro.php"><input type="button" value="Registro" nome="btnregistro" id="btns"></a>
        <p>
            <a href="logout.php">Sair</a>
        </p>
    </div>
    <div class="rodape"></div>
    
</body>
</html>