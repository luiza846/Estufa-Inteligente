<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/generalInterface.css">
    <title>Registro</title>
</head>
<body>
    <!--DPS APAGAR-->
    <?php echo "ID_USUARIO: ", $_SESSION['id_usuario']; ?>
    <h1>Registro</h1>

    <table class="tb-registro">
        <tr>
            <th>ID</th>
            <th>NOME DA AÇÃO</th>
            <th>DATA</th>
            <th>HORA</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Irrigação</td>
            <td>23/04/2023</td>
            <td>05:00</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Refrigeração</td>
            <td>23/04/2023</td>
            <td>06:00</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Luz UV</td>
            <td>23/04/2023</td>
            <td>07:00</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Irrigação</td>
            <td>23/04/2023</td>
            <td>16:40</td>
        </tr>
    </table>
</body>
</html>