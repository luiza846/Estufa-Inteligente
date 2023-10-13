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
    <link rel="stylesheet" href="css/perfil.css">
    <title>Meu Perfil</title>
</head>
<body>
    <!--DPS APAGAR-->
    <?php echo "ID_USUARIO: ", $_SESSION['id_usuario']; ?>
    <div class="div1">
        <form action="editDadosUsuario.php" method="post">
        <h1>Meu perfil</h1>

            <?php
                    $id_usuario = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

                    # Preparar e executar a consulta com a cláusula WHERE
                    $stmt = $conectaBD->prepare($sql);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "ID do Usuário: ",$dados["id_usuario"],"<br>";
                    echo "Nome: ",$dados["nome"],"<br>"; 
                    echo "Email: ",$dados["email"],"<br>"; 
                    }
            ?>

                <br>Senha atual: <input type="text" name="campoSenhaAtual" placeholder="Senha">
                <br>Nova senha: <input type="text" name="campoSenha" placeholder="Nova senha">
                <br><input type="submit" value="MUDAR SENHA">
                <div class="full-box">
                    <a href="telaPrincipal.php">Voltar</a>
                </div>
        </form>
    </div>
</body>
</html>