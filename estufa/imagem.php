<?php
    include("conexao.php");
    #msg informando se deu certo ou nao o upload
    $msg = false;
    #isset = existir (se existir o arquivos)
    if(isset($_FILES['arquivo'])){
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        #hora
        $novo_nome = md5(time()). $extensao;
        $diretorio = "upload/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

        #armazenar arq no BD
        $sql_code = "INSERT INTO imagens (id_imagem, imagem,data_imagem) VALUES(null, '$novo_nome',NOW())";
        if($mysqli->query($sql_code)){
            $msg = "Imagem enviada com sucesso!";
        }else{
            $msg = "Erro!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>foto</h1> 
    <?php
        if($msg !=false){ 
            echo "<p> $msg </p>";
        }
    ?>
    <!--enctype um atributo que o arquivo está sendo enviado-->
    <form action="imagem.php" method="POST" enctype="multipart/form-data">
    <input type="file" required name="arquivo">
    <input type="submit" value="Salvar">
    </form>

</body>
</html>