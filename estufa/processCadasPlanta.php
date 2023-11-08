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

        echo "ID_USUARIO: ", $_SESSION['id_usuario'] . "<br>";

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
                if (isset($_POST['categoria'])) {
                    $opcaoSelecionada = $_POST['categoria'];

                    $stmt = $conn->prepare("SELECT * FROM planta WHERE id_planta = :opcaoSelecionada");
                    $stmt->bindParam(':opcaoSelecionada', $opcaoSelecionada);
                    $stmt->execute();
                    $dadosOpcao = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($dadosOpcao) {
                        $stmt = $conn->prepare("INSERT INTO estufa (id_usuario, data_criacao, imagem, nome, umidade, temperatura) VALUES (:id_usuario, :data_criacao, :imagem, :nome, :umidade, :temperatura)");
                        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                        $stmt->bindParam(':data_criacao', $dat, PDO::PARAM_STR);
                        $stmt->bindParam(':nome', $dadosOpcao['nome_planta']);
                        $stmt->bindParam(':umidade', $dadosOpcao['umidade_ideal']);
                        $stmt->bindParam(':temperatura', $dadosOpcao['temperatura_ideal']);
                        $stmt->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);
                        // Registro bem-sucedido
                        if ((isset($arquivo['name'])) && !empty($arquivo['name'])) {
                            $ultimo_id = $conn->lastInsertId();
                            $diretorio = "planta/$ultimo_id/";
                            mkdir($diretorio, 0755);
                            $nome_arquivo = $arquivo['name'];
                            move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo);
                            echo "Foto salva";
                        } else {
                            echo "Cadastro realizado com sucesso.";
                        }
            
        
                    
                    if ($stmt->execute()) {
                            echo "Dados da opção inseridos com sucesso na tabela 'estufa'.";
                        } else {
                            echo "Erro ao inserir dados da opção na tabela 'estufa'.";
                        }
                    } else {
                        echo "Opção não encontrada na tabela 'planta'.";
                    }
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
    echo "Erro: Usuário não está logado";
}
?>