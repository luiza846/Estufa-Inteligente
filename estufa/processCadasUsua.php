<?php
include_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $id_usuario = "";
    $nome = $_POST['campoNome'];
    $senha = $_POST['campoSenha'];
    $confirmSenha = $_POST['campoConfirmSenha'];
    $arquivo = $_FILES['foto_usuario'];
    $nSerie = $_POST['campoSerie'];
    $email = $_POST['campoEmail'];

    try {
        if($senha == $confirmSenha){
            echo "Deu certo";
        // Criar uma conexão PDO
        $conn = new PDO("mysql:host=localhost;dbname=estufa", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar o banco de dados para verificar se o email e número de série fornecidos existem
        $checkQuery = $conn->prepare("SELECT n_serie, email_produto FROM produto WHERE n_serie = :nSerie AND email_produto = :email");
        $checkQuery->bindParam(':nSerie', $nSerie, PDO::PARAM_STR);
        $checkQuery->bindParam(':email', $email, PDO::PARAM_STR);
        $checkQuery->execute();
        $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Email e número de série correspondentes foram encontrados, permita o registro
            $query_usuario = "INSERT INTO usuario (nome, n_serie, email, senha, imagem) VALUES (:nome, :n_serie, :email, :senha, :imagem)";
            $cad_usuario = $conn->prepare($query_usuario);
            $cad_usuario->bindParam(':nome', $nome, PDO::PARAM_STR);
            $cad_usuario->bindParam(':n_serie', $nSerie, PDO::PARAM_STR);
            $cad_usuario->bindParam(':email', $email, PDO::PARAM_STR);
            $cad_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
            $cad_usuario->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);

            if ($cad_usuario->execute()) {
                // Registro bem-sucedido
                if ((isset($arquivo['name'])) && !empty($arquivo['name'])) {
                    $ultimo_id = $conn->lastInsertId();
                    $diretorio = "imagens/$ultimo_id/";
                    mkdir($diretorio, 0755);
                    $nome_arquivo = $arquivo['name'];
                    move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo);
                    echo "Foto salva";
                } else {
                    echo "Cadastro realizado com sucesso.";
                }
            } else {
                echo "Erro ao cadastrar o usuário.";
            }
        } else {
            echo "Erro: Email e Número de Série incorretos.";
        }}else{
            echo "Senhas diferentes";
        }
    } catch (PDOException $erro) {
        echo "Erro na conexão com o banco de dados: " . $erro->getMessage();
    }
} else {
    echo "Erro!";
}
?>