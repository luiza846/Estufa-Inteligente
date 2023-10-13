<?php
include_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # receber dados do formulário
    $id_usuario = "";
    $nome = $_POST['campoNome'];
    $email = $_POST['campoEmail'];
    $senha = $_POST['campoSenha'];
    $arquivo = $_FILES['foto_usuario'];

    # fazer conexão com o BD
    try {
        # Criação da conexão PDO
        $conn = new PDO("mysql:host=localhost;dbname=estufa", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        # Query do BD
        $query_usuario = "INSERT INTO usuario (nome, email, senha, imagem) VALUES (:nome, :email, :senha, :imagem)";

        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nome', $nome, PDO::PARAM_STR);
        $cad_usuario->bindParam(':email', $email, PDO::PARAM_STR);
        $cad_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
        $cad_usuario->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);

        if ($cad_usuario->execute()) {
            # verificar se o usuário está enviando a foto
            if ((isset($arquivo['name'])) && !empty($arquivo['name'])) {
                # recuperar o último ID inserido no BD
                $ultimo_id = $conn->lastInsertId();

                # diretório onde o arquivo será salvo
                $diretorio = "imagens/$ultimo_id/";

                # criar o diretório
                mkdir($diretorio, 0755);

                # fazer o upload do arquivo
                $nome_arquivo = $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo);

                echo "Foto salva";
            } else {
                echo "Cadastro realizado com sucesso.";
            }
        } else {
            echo "Erro ao cadastrar o usuário.";
        }
    } catch (PDOException $erro) {
        # informar que houve erro ao fazer a conexão com o BD
        echo "Erro na conexão com o banco de dados: " . $erro->getMessage();
    }
} else {
    echo "Erro!";
}
?>
