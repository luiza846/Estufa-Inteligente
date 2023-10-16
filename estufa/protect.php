<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/protect.css">
    <!--icon-->
    <link rel="shortcut icon" type="imagex/png" href="./images/icon.ico">
    <title>PROTECT</title>
</head>
<body>
    <div class="protect">
        <?php
            if(!isset($_SESSION)) {
                session_start();
            }

            if(!isset($_SESSION['id_usuario'])) {

                echo "<img src='images/acesso.png' width='250'>","<br>";
                die("<h1>Você não pode acessar esta página porque não está logado!</h1><p><br><a href=\"index.php\">ENTRAR</a></p>");
            }
        ?>

    </div>
</body>
</html>

