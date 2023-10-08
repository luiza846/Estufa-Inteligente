<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--referenciar o css-->
    <link rel="stylesheet" type="text/css" href="./css/telaPrincipal.css">

    <title>Painel</title>
</head>

<body>
    <!--DPS APAGAR-->
    <?php echo "ID_USUARIO: ", $_SESSION['id_usuario']; ?>
    

    <!--menu secundario-->
    <div class="header-2">
        <div class="menu">
            <ul>
                <li><a href="">HOME</a></li>
                <li><a href="planta.php">SOBRE</a></li>
                <li><a href="">SERVIÇOS</a></li>
                <li><a href="">PAGINAS</a></li>
                <li><a href="">CONTATO</a></li>
                <input type="text" placeholder=" Pesquisar palavra-chave" />
            </ul>
        </div>
    </div>

    <div class = "logo">
        <!--escrever o conteúdo aqui-->
    </div>

    <div class="menu2">
        <a href="perfil.php"><input type="button" value="Meu perfil" name="btnPerfil" id="btns"></a>
        <a href="monitora.php"><input type="button" value="Monitoramento" name="btnMonitorar" id="btns"></a>
        <a href="planta.php"><input type="button" value="Planta" name="btnPlanta" id="btns" onclick="condicaoPlanta()"></a>
        <a href="cadasPlanta.php"><input type="button" value="Adicionar Planta" name="btnMonitorar" id="btns"></a>
        <a href="registro.php"><input type="button" value="Registro" nome="btnregistro" id="btns"></a>
        <p>
            <a href="logout.php">Sair</a>
        </p>
    </div>
    
</body>
</html>