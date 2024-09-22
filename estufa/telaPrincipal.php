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
    <link rel="stylesheet" href="css/style.css">

    <title>Painel</title>
</head>

<body class="tela-principal" style="background-image: url(fundoLogin/telaPrinc.png);">    

    <!--menu secundario-->
    <div class="header-2">

    </div>
    <div class="conteiner">
        <div class="menu">
            <ul>
                <a href="perfil.php"><input type="button" value="MEU PERFIL" name="btnPerfil" id="btns"></a>                                          
            </ul>
        </div>
        <div class="div-logout">
    <a href="logout.php">
        <img src="fundoLogin/sair.png" alt="Ícone de saída">
    </a>
    <h5>SAIR</h5>
</div>
</div>
    <div class = "cadastrePlanta">

        <a href="cadasPlanta.php"><input type="button" value="Inserir Planta" name="btnMonitorar" id="btns"></a>
    
    </div>
<!-- Ícone de ajuda fora da .menu2 -->
<div class="tooltip2">
    <abbr><img src="fundoLogin/ajuda.png" alt="Ícone de ajuda"></abbr>
    <span class="tooltiptext2">Se você alterou a planta que vai cultivar, aperte este botão para fazer as configurações da estufa se ajustarem.</span>
</div>

<div class="menu2">
    <div class="div-btn-img">
        <img src="fundoLogin/sync.png" alt="Ícone de perfil">
        <form class="form-atualiza-dados" method="POST" action="http://localhost:3000/EnviarDados" onsubmit="Enviar()">
            <input type="submit" value="Atualizar Dispositivo" name="btnAtualiza" id="btns">
        </form>
    </div>

    <div class="div-btn-img">
        <img src="fundoLogin/icons8-análise-de-crescimento-financeiro-96.png" alt="Ícone de perfil">
        <a href="listarEstufas.php">
            <input type="button" value="Monitoramento" name="btnMonitorar" id="btn_monitorar">
        </a>
    </div>
<!--
    <div class="div-btn-img">
        <img src="fundoLogin/icons8-histórico-de-encomendas-96.png" alt="Ícone de perfil">
        <a href="conectaWifi.php">
            <input type="button" value="Wi-fi" name="btnregistro" id="btns">
        </a>
    </div>
</div>
        -->
<script>
    function Enviar(){
        alert("Planta Atualizada com sucesso");
    }
</script>

        </div>
    </div>

    
    <div class="rodape">
    <img src="fundoLogin/logoxx.png" alt="logo">
    <div class = "list-pag">
    <ul>
        <h3>Páginas</h3>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="cadasPlanta.php">Inserir Planta</a></li>
                <li><a href="listarEstufas.php">Monitoramento</a></li>
                <li><a href="registro.php">Registro</a></li>
            </ul>

    </div>
    </div>
    
    
</body>
</html>