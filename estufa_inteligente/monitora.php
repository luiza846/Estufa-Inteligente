<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento</title>
</head>
<body>
    <!--DPS APAGAR-->
    <?php echo "ID_USUARIO: ", $_SESSION['id_usuario']; ?>
    <h1>Monitoramento</h1>

    <div>
        <form>
            <h4>Nome:</h4>
            <h4>Umidade</h4>
            <h4>Temperatura</h4>
        </form>
    </div>

</body>
</html>