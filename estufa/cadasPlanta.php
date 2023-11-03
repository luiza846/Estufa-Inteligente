<?php

include('protect.php');
include('connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/generalInterface.css">
    <title>Cadastrar Planta</title>

</head>
<body class="body-planta" style="background-image: url(fundoLogin/cadas-planta.png);">

<div class="div-cadas-planta">
        <form class="form-cadas-planta" method="POST" action="processCadasPlanta.php">
            <h1>CADASTRAR PLANTA</h1>
            <div class="campos-planta">
            <!--ocupa metade do formulario (half-box)-->
            <label for="foto_planta">Adicionar foto da planta: </label>
            <input type="file" name="foto_planta" id="foto_planta" required><br><br>

            <select name="categoria" required>
        <option value="">Selecione a planta</option>
        <?php
            $query = $conn->query("SELECT * FROM planta ORDER BY nome_planta ASC");
            $registros = $query->fetchAll(PDO::FETCH_ASSOC);
            print_r($registros);
        
            foreach($registros as $options){
        ?>
        <option value="<?php echo $options['id_planta']?>">
        <?php echo $options['nome_planta']?>
        </option>
        <?php }?>

            <div class="half-box spacing">
              N° Série <input type="text" name="campoSerie" placeholder="N° Série">
            </div>

            <div class="half-box">
                Data que foi plantado: <input type="date" name="campoData" id="lastname" placeholder="Digite a data que foi plantado">
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