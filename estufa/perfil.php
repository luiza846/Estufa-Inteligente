<?php
include('protect.php');
# Fazer conexão com BD
try
{
    # Conexão com MySQL usando PDO
    $conectaBD = new PDO("mysql:host=127.0.0.1;port=3306;dbname=estufa", "root", "");
    $conectaBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Preparar a consulta SQL
    $sql = "SELECT * FROM usuario";

    # Preparar e executar a consulta
    $stmt = $conectaBD->query($sql);

}
catch(PDOException $erro)
{
    # Informar que houve erro ao fazer a conexão com BD
    echo "Houve erro ao fazer a conexão com o banco de dados!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Meu Perfil</title>
</head>
<body class = "body-perfil" style="background-image: url(/perfil.png);">

        <div class = "div-painel-perfil">
            <?php
                    $id_usuario = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

                    # Preparar e executar a consulta com a cláusula WHERE
                    $stmt = $conectaBD->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $foto_usuario = $dados["imagem"];
                    echo "<img src='usuario/$id_usuario/$foto_usuario'>","<br>";
                    }
            ?>
                        <?php
                    $id_usuario = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

                    # Preparar e executar a consulta com a cláusula WHERE
                    $stmt = $conectaBD->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<h1>",$dados["nome"],"</h1>"; 
                    echo "<h5>",$dados["email"],"</h5>"; 
                    }
            ?>

                <form action="editDadosUsuario.php" method="post">
                <br>Senha atual: <input type="password" name="campoSenhaAntiga" placeholder="Senha">
                <br>Nova senha: <input type="password" name="campoNovaSenha" placeholder="Nova senha">
                <div class="btn-senha">
                <br><input class = "btn-mudar-senha" type="submit" value="MUDAR SENHA">
                </div>
                </form>                    

                <a href="telaPrincipal.php"><button class = "voltar">Voltar</buttom></a>


    </div>
</body>
</html>