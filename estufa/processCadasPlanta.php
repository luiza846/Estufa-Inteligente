<?php
session_start();
include_once "conexao.php";

if (isset($_SESSION['id_usuario'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Receber dados do formulário
        $id_usuario = $_SESSION['id_usuario'];
        $dat = $_POST['campoData'];
        $nSerie = $_POST['campoSerie'];
        $arquivo = $_FILES['foto_planta'];

        try {
            // Criar uma conexão PDO
            $conn = new PDO("mysql:host=localhost;dbname=estufa", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consultar o banco de dados para verificar se o número de série fornecido existe
            $checkQuery = $conn->prepare("SELECT n_serie FROM usuario WHERE n_serie = :nSerie");
            $checkQuery->bindParam(':nSerie', $nSerie, PDO::PARAM_STR);
            $checkQuery->execute();
            $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Número de série correspondente foi encontrado, permita o registro
                $query_usuario = "INSERT INTO estufa (id_usuario, data_criacao, imagem) VALUES (:id_usuario, :data_criacao, :imagem)";
                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $cad_usuario->bindParam(':data_criacao', $dat, PDO::PARAM_STR);
                $cad_usuario->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);

                if ($cad_usuario->execute()) {
                    // Registro bem-sucedido
                    if ((isset($arquivo['name'])) && !empty($arquivo['name'])) {
                        $ultimo_id = $conn->lastInsertId();
                        $diretorio = "planta/$ultimo_id/";
                        
                        if (!file_exists($diretorio)) {
                            mkdir($diretorio, 0755, true);
                        }

                        $nome_arquivo = $arquivo['name'];
                        $destino = $diretorio . $nome_arquivo;

                        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
                            echo "Foto salva";
                        } else {
                            echo "Erro ao mover o arquivo para o diretório.";
                        }
                    } else {
                        echo "Cadastro realizado com sucesso.";
                    }
                } else {
                    echo "Erro ao cadastrar a estufa: " . $cad_usuario->errorInfo()[2];
                }
            } else {
                echo "Erro: Número de Série incorreto.";
            }
        } catch (PDOException $erro) {
            echo "Erro na conexão com o banco de dados: " . $erro->getMessage();
        }
    } else {
        echo "Erro: Método de requisição incorreto.";
    }
} else {
    echo "Erro: Usuário não está logado.";
}
?>