<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/teste.css">
    <title>PRINCIPAL</title>
</head>
<body>
    <div class="painelPrincipal">
        <!--style="background-image: url('images/folhas.jpg'); background-repeat: no-repeat; background-size: cover;"-->
        <form>
            <a href="perfil.php"><input type="button" value="Meu perfil" name="btnPerfil" id="btns"></a>
            <a href="planta.php"><input type="button" value="Planta" name="btnPlanta" id="btns" onclick="condicaoPlanta()"></a>
            <a href="monitora.php"><input type="button" value="Monitoramento" name="btnMonitorar" id="btns"></a>
            <a href="registro.php"><input type="button" value="Registro" nome="btnregistro" id="btns"></a>
        </form>
    </div>
    <div class="div2">
        <input type="button" value="Sair" name="btnSair">
    </div>
    <div class="div3">
        <h4>contato</h4>
        <h4>redes sociais</h4>
        <h4>(00) 0000-0000</h4>
    </div>
        <!--comando se usuario possui a planta ou nao-->
        <script>
        function condicaoPlanta(){
            //escrever regra aqui
        }
    </script>

</body>
</html>