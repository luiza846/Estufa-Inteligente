<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--icon-->
    <link rel="shortcut icon" type="imagex/png" href="./images/icon.ico">
    <link rel="stylesheet" href="css/style.css">
    <title>GreenCode</title>
</head>
<body class="body-protect" style="background-image: url(fundoLogin/protect.png);">
    <div class="div-protect">
        <?php
            if(!isset($_SESSION)) {
                session_start();
            }

            if(!isset($_SESSION['id_usuario'])) {

                echo "<img src='fundoLogin/erro.png' width='100'>","<br>";
                die("<h1>Não foi possível carregar esta página!</h1> <h3> Para acessá-la, faça o <a href=\"index.php\">login.</a> <br><br>Caso não tenha uma conta, por favor, <a href=\"cadasUsuario.php\">cadastre-se.</a></h3>");
            }
        ?>

    </div>
</body>
</html>

