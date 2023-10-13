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
    <link rel="stylesheet" type="text/css" href="./css/bah.css">

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
        <a href="planta.php"><input type="button" value="Planta" name="btnPlanta" id="btns"></a>
        <a href="cadasPlanta.php"><input type="button" value="Adicionar Planta" name="btnMonitorar" id="btns"></a>
        <a href="registro.php"><input type="button" value="Registro" nome="btnregistro" id="btns"></a>
        <p>
        <!----------------------TESTE------------------>
        <div class="telas">
            <div id="camposCarro" style="display: none;">
                    Marca:<input type="text" name="txtMarcaCarro">
                    Modelo:<input type="text" name="txtModeloCarro">
                    Ano de fabricação:<input type="datetime-local" name="txtAnoCarro">
                    Quantidade de portas:<input type="text" name="txtNumPortas">
                </div>

                <div id="camposMoto" style="display: none;">
                    Marca:<input type="text" name="txtMarcaMoto">
                    Modelo:<input type="text" name="txtModeloMoto">
                    Ano de fabricação:<input type="datetime-local" name="txtAnoMoto">
                    <br>Cilindrada:<input type="text" name="txtCilindrada">
                </div>
        </div>
        <div class="half-box">
                <input type="button" value="Profile" onclick="mostrarPerfil()">
        </div>
        <div class="half-box spacing">
                <input type="button" value="Plant" onclick="mostrarPlanta()">
        </div>
            <input type="hidden" id="options" name="options" value="">


            <a href="logout.php">Sair</a>
        </p>
    </div>
    
    <script>
        function mostrarPerfil(){
            document.getElementById("camposCarro").style.display = "block";
            //caso usuario queira mudar de opcao para moto
            document.getElementById("camposMoto").style.display = "none";
            document.getElementById("tipoVeiculo").value = "carro";
        }
        function mostrarPlanta(){
            document.getElementById("camposMoto").style.display = "block";
            //caso usuario queira mudar de opcao para carro
            document.getElementById("camposCarro").style.display = "none";
            document.getElementById("tipoVeiculo").value = "moto";
        }
    </script>


</body>
</html>