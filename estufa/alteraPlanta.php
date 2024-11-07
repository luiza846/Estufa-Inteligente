<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastrar Planta</title>
</head>
<body class="body-planta" style="background-image: url(fundoLogin/cadas-planta.png);">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <div class="div-cadas-planta">
        <form id="formCadasPlanta" class="form-cadas-planta" method="POST" enctype="multipart/form-data">
            <h1>EDITAR PLANTA</h1>
            <div class="div-cadas-planta-aviso"></div> <!-- Aqui os dialogs aparecerão -->
            <div class="campos-planta">
                <label for="foto_planta">Adicionar foto da planta: </label>
                <input type="file" name="foto_planta" id="foto_planta" required>
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

                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const select = document.querySelector('.categoria');
                    const options = Array.from(select.options).slice(1); // Ignorar o primeiro (placeholder)

                    // Ordenar as opções com base no texto (alfabético)
                    options.sort((a, b) => a.text.localeCompare(b.text));

                    // Limpar o <select> e adicionar o placeholder novamente
                    select.innerHTML = '<option value="">Selecione a planta</option>';

                    // Re-adicionar as opções ordenadas
                    options.forEach(option => select.add(option));
                });
            </script>

                <div class="half-box spacing">
                    N° Série <input type="text" name="campoSerie" placeholder="N° Série" required>
                </div>
                <div class="half-box">
                    Data que foi plantado: <input type="date" name="campoData" required>
                </div>
                <div class="full-box">
                    <input type="submit" id="btn_cadastrar" value="EDITAR PLANTA">
                </div>
                <div class="div-voltar">
                    <img class="img-voltar" src="fundoLogin/voltar.png" alt="Ícone de saída">
                    <a href="telaPrincipal.php">Voltar</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('formCadasPlanta').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio normal do formulário
            var formData = new FormData(this);

            // Enviar os dados via Ajax
            fetch('logicaAlteraPlanta.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
              .then(data => {
                  // Insere o conteúdo retornado (diálogo) no div de alertas
                  document.querySelector('.div-cadas-planta-aviso').innerHTML = data;
              }).catch(error => console.error('Erro:', error));
        });
    </script>
</body>
</html>
