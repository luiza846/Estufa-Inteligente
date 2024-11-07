<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastrar Planta</title>

</head>
<body class="body-planta" style="background-image: url(fundoLogin/cadas-planta.png);">

<div class="div-cadas-planta">
        <form class="form-cadas-planta" action="logicaCadasPlanta.php" method="POST" enctype="multipart/form-data">
            <h1>CADASTRAR PLANTA</h1>
            <div class = "div-cadas-planta-aviso">
            
            </div>
            <div class="campos-planta">
            <!--ocupa metade do formulario (half-box)-->
            
            <label for="foto_planta">Adicionar foto da planta: </label>
            <input type="file" name="foto_planta" id="foto_planta" required>

            <div class="tooltip"> <!-- O ponto de interrogação -->
            <abbr><img src="fundoLogin/ajuda.png" alt="Ícone de ajuda"></abbr>
            <span class="tooltiptext">Selecione a planta desejada e, após a escolha, será automaticamente detectada a temperatura e umidade ideais para seu cultivo.</span>
            </div>

            <select name="categoria" class="categoria" required>
                <option value="">Selecione a planta</option>
                <option value="1">Morango</option>
                <option value="2">Cebolinha</option>
                <option value="3">Manjericão</option>
                <option value="4">Salsinha</option>
                <option value="5">Tomate</option>
                <option value="6">Pimenta</option>
                <option value="7">Alecrim</option>
                <option value="8">Lavanda</option>
                <option value="9">Camomila</option>
                <option value="10">Hortelã</option>
                <option value="11">Orégano</option>
                <option value="12">Coentro</option>
                <option value="13">Alface</option>
                <option value="14">Espinafre</option>
                <option value="15">Erva-cidreira</option>
                <option value="16">Cacto</option>
                <option value="17">Suculenta</option>
                <option value="18">Begônia</option>
                <option value="19">Violeta</option>
                <option value="20">Rosa</option>
            </select>

            <div class="half-box spacing">
              N° Série <input type="text" name="campoSerie" placeholder="N° Série" required>
            </div>

            <div class="half-box">
                Data que foi plantado: <input type="date" name="campoData" id="lastname" placeholder="Digite a data que foi plantado" required>
            </div>

    <!-- MIGUEL VERIFICAR ESSE CODIGO-->
    <script>
    function Enviar(){
    alert("Planta Atualizada com sucesso");
    }
    </script>
        <form class="form-atualiza-dados" method="POST" action="http://localhost:3000/EnviarDados" onsubmit="Enviar()">
              <div class="full-box">
                <input type="submit" id="btn_cadastrar" value="CADASTRAR">
              </div>
              <div class="div-voltar">
                <img class = "img-voltar" src="fundoLogin/voltar.png" alt="Ícone de saída">
                <a href="telaPrincipal.php">Voltar</a>
            </div>
        </form>



            </div>
        </form>
    </div></body>
</html>
