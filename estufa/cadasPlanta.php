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
<body>
    
<div class="centered">
</div>

<div class="div1" id="main-container">
        <form id="register-form" method="POST" action="processCadasPlanta.php" enctype="multipart/form-data">
            <h1>CADASTRAR PLANTA</h1>
            <!-- CARREGAR IMAGEM -->
            <label for="foto_planta">Foto: </label>
            <input type="file" name="foto_planta" id="foto_planta" required><br><br>

            <!--ocupa metade do formulario (half-box)-->
            <div class="half-box spacing">
                Nome: <input type="text" name="campoNome" id="name" placeholder="Digite o apelido da planta">
            </div>
            <div class="half-box">
                Data que foi plantado: <input type="datetime-local" name="campoData" id="lastname" placeholder="Digite a data que foi plantado">
            </div>
            <div class="half-box spacing">
              N° Série <input type="text" name="campoSerie" placeholder="N° Série">
            </div>
            <div class="full-box">
                <input type="submit" id="btn-submit" value="Registrar">
              </div>

            <div class="full-box">
                <a href="telaPrincipal.php">Voltar</a>
            </div>

        </form>
    </div>

    <!--
      <p class="error-validation template"></p>
    <script src="js/cadasUsuario.js"></script>
  -->

</body>
</html>