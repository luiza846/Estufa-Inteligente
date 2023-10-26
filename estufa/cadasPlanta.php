<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadasPlanta.css">
    <title>Cadastrar Planta</title>

</head>
<body class="body-planta">
    
<div class="centered">
</div>

<div class="div-planta">
        <form id="register-form" method="POST" action="processCadasPlanta.php">
            <h1>CADASTRAR PLANTA</h1>
            <div class="campos-planta">
            <!--ocupa metade do formulario (half-box)-->
            <label for="foto_planta">Foto: </label>
            <input type="file" name="foto_planta" id="foto_planta" required><br><br>

            <div class="half-box spacing">
                Nome: <input type="text" name="campoNome" id="name" placeholder="Digite o apelido da planta">
            </div>
            <div class="half-box spacing">
              N° Série <input type="text" name="campoSerie" placeholder="N° Série">
            </div>
            <div class="half-box">
                Data que foi plantado: <input type="date" name="campoData" id="lastname" placeholder="Digite a data que foi plantado">
            </div>
            <div class="half-box">
                Umidade: <input type="text" name="campoUmidade" id="password" placeholder="Digite a umidade ideal para a planta">
            </div>
            <div class="full-box">
                Temperatura: <input type="text" name="campoTemperatura" id="passconfirmation" placeholder="Digite a temperatura ideal para a planta">
            </div>
              <div class="full-box">
                <input type="submit" id="btn-submit" value="Registrar">
              </div>
            <div class="full-box">
                <a href="telaPrincipal.php">Voltar</a>
            </div>
            </div>
        </form>
    </div></body>
</html>