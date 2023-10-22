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
                <a href="perfil.php"><input type="button" value="MEU PERFIL" name="btnPerfil" id="btns"></a>                                          
                <a href="logout.php">Sair</a>
            </ul>


        </div>

    <div class = "cadastrePlanta">

        <a href="cadasPlanta.php"><input type="button" value="Cadastrar Planta" name="btnMonitorar" id="btns"></a>
    
    </div>
    <div class="menu2">
        <div class="icons">
        <img src="fundoLogin/icons8-análise-de-crescimento-financeiro-96.png" alt="Ícone de perfil">
        <img src="fundoLogin/icons8-folha-de-louro-96.png" alt="Ícone de perfil">
        <img src="fundoLogin/icons8-histórico-de-encomendas-96.png" alt="Ícone de perfil">
        </div>
        <a href="monitora.php"><input type="button" value="Monitoramento" name="btnMonitorar" id="btns"></a>
        <a href="planta.php"><input type="button" value="Plantas" name="btnPlanta" id="btns"></a>
        <a href="registro.php"><input type="button" value="Registro" nome="btnregistro" id="btns"></a>

    </div>

    
    <div class="rodape">
    <img src="fundoLogin/logoxx.png" alt="logo">
    <div class = "list-pag">
    <ul>
        <h3>Páginas</h3>
                <li><a href="">Perfil</a></li>
                <li><a href="sobre.php">Cadastrar Planta</a></li>
                <li><a href="">Planta</a></li>
                <li><a href="">Monitoramento</a></li>
                <li><a href="contato.php">Registro</a></li>
            </ul>

    </div>
    </div>
    
    
</body>
</html>