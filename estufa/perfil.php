<?php
include('protect.php');
# Fazer conexão com BD
try
{
    # Conexão com MySQL usando PDO
    $conectaBD = new PDO("mysql:host=estufa.mysql.dbaas.com.br;port=3306;dbname=estufa", "estufa", "Hunter231020@#");
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
<body class="body-perfil" style="background-image: url(fundoLogin/perfil2.png);">

<center>
    <div class="div-painel-perfil">
        <?php
        $id_usuario = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $stmt = $conectaBD->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        if ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $foto_usuario = $dados["imagem"];
            echo "<img src='usuario/$id_usuario/$foto_usuario'><br>";
            echo "<h1>{$dados['nome']}</h1>";
            echo "<h5>{$dados['email']}</h5>";
        }
        ?>

        <form action="" method="post">
            <div class="senha">
                <br>EFETUAR ALTERAÇÃO DA SENHA:
            </div>

            <?php
            if (isset($_POST['campoSenhaAntiga']) && isset($_POST['campoNovaSenha'])) {
                $oldPassword = $_POST['campoSenhaAntiga'];
                $newPassword = $_POST['campoNovaSenha'];

                $sql = "SELECT senha FROM usuario WHERE id_usuario = :id_usuario";
                $stmt = $conectaBD->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $senhaAtual = $row['senha'];

                    if ($oldPassword === $senhaAtual) {
                        $sql_update = "UPDATE usuario SET senha = :newPassword WHERE id_usuario = :id_usuario";
                        $stmt_update = $conectaBD->prepare($sql_update);
                        $stmt_update->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
                        $stmt_update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                        $stmt_update->execute();

                        echo "<dialog id='msgSucessoPerfil' open>
                            <center><img src='fundoLogin/sucesso.png'></center>
                            <br>Senha alterada com sucesso!
                            <a href='telaPrincipal.php'><input type='button' value='VOLTAR' name='btnVoltar'></a>
                        </dialog>";
                    } else {
                        echo "<div class='div-senha'>Senha atual incorreta!</div>";
                    }
                } else {
                    echo "<div class='div-senha'>Erro ao buscar a senha atual do usuário.</div>";
                }
            }
            ?>

            <br>Senha atual: <input type="password" name="campoSenhaAntiga" placeholder="Senha">
            <br>Nova senha: <input type="password" name="campoNovaSenha" placeholder="Nova senha">
            <div class="btn-senha">
                <br><input class="btn-mudar-senha" type="submit" value="MUDAR SENHA">
            </div>
        </form>

        <a href="telaPrincipal.php"><button class="voltar">Voltar</button></a>
    </div>
</center>
</body>
</html>
