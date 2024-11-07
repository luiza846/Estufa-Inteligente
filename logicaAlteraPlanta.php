<?php

include('protect.php');
include('conexao.php');

if (isset($_SESSION['id_usuario'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // receber dados inseridos pelo usuário
        $id_usuario = $_SESSION['id_usuario'];
        $dat = $_POST['campoData'];
        $nSerie = $_POST['campoSerie'];
        $arquivo = $_FILES['foto_planta'];
        
        try {
            // conexao bd
            $conn = new PDO("mysql:host=estufa.mysql.dbaas.com.br;port=3306;dbname=estufa", "estufa", "Hunter231020@#");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // verificar se n serie existe
            $checkQuery = $conn->prepare("SELECT n_serie, email_produto FROM produto WHERE n_serie = :nSerie");
            $checkQuery->bindParam(':nSerie', $nSerie, PDO::PARAM_STR);
            $checkQuery->execute();
            $resultProduto = $checkQuery->fetch(PDO::FETCH_ASSOC);
            
            if (!$resultProduto) {
                die("Número de série não encontrado.");
            }
            
            // encontrar o email do usuario na tabela usuario
            $emailProduto = $resultProduto['email_produto'];
            
            $checkQuery = $conn->prepare("SELECT email FROM usuario WHERE id_usuario = :id_usuario");
            $checkQuery->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $checkQuery->execute();
            $resultUsuario = $checkQuery->fetch(PDO::FETCH_ASSOC);
            
            if (!$resultUsuario) {
                die("Usuário não encontrado na tabela de usuários.");
            }
            
            $emailUsuario = $resultUsuario['email'];
            
            // comparar email (tb usuario) com email_produto (tb produto)
            if ($emailProduto == $emailUsuario) {

                // verificar se a estufa já possui planta
                $checkQuery = $conn->prepare("SELECT * FROM estufa WHERE n_serie = :nSerie");
                $checkQuery->bindParam(':nSerie', $nSerie, PDO::PARAM_STR);
                $checkQuery->execute();
                $resultPlantaExistente = $checkQuery->fetch(PDO::FETCH_ASSOC);
                
                if ($resultPlantaExistente) {
                    // realizar atualização em vez de inserir um novo registro
                    $opcaoSelecionada = $_POST['categoria'];
                    
                    $stmt = $conn->prepare("SELECT * FROM planta WHERE id_planta = :opcaoSelecionada");
                    $stmt->bindParam(':opcaoSelecionada', $opcaoSelecionada, PDO::PARAM_INT);
                    $stmt->execute();
                    $dadosOpcao = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($dadosOpcao) {
                        // atualizar registro existente na tabela 'estufa'
                        $stmt = $conn->prepare("UPDATE estufa SET id_usuario = :id_usuario, data_criacao = :data_criacao, imagem = :imagem, nome = :nome, umidade = :umidade, temperatura = :temperatura WHERE n_serie = :n_serie");
                        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                        $stmt->bindParam(':n_serie', $nSerie, PDO::PARAM_STR);
                        $stmt->bindParam(':data_criacao', $dat, PDO::PARAM_STR);
                        $stmt->bindParam(':nome', $dadosOpcao['nome_planta']);
                        $stmt->bindParam(':umidade', $dadosOpcao['umidade_ideal']);
                        $stmt->bindParam(':temperatura', $dadosOpcao['temperatura_ideal']);
                        $stmt->bindParam(':imagem', $arquivo['name'], PDO::PARAM_STR);

                        if ($stmt->execute()) {
                            // salvar imagem
                            if ((isset($arquivo['name'])) && !empty($arquivo['name'])) {
                                $diretorio = "planta/$nSerie/";

                                // verificar se existe o arquivo
                                if (!file_exists($diretorio)) {
                                    mkdir($diretorio, 0755, true); // criar o arquivo
                                }

                                $nome_arquivo = $arquivo['name'];
                                move_uploaded_file($arquivo['tmp_name'], $diretorio . $nome_arquivo);

                                /* gerar arquivo txt */
                                $file_plant = fopen("dadosEstufas/estufa - $nSerie.txt", "a");
                                if ($file_plant) {
                                    fwrite($file_plant, $opcaoSelecionada . "\n");
                                    fclose($file_plant);
                                }
                            }                                
                            
                            echo "<dialog id='msgSucesso' open>
                                    <center><img src='fundoLogin/sucesso.png'></center>
                                    <p>Alteração realizada com sucesso!</p>
                                    <a href='telaPrincipal.php'><input type='button' value='VOLTAR' name='btnVoltar'></a>
                                </dialog>";
                        } else {
                            echo "Erro ao atualizar dados na tabela 'estufa'.";
                        }
                    } else {
                        echo "Opção não encontrada na tabela 'planta'.";
                    }
                } else {
                    echo "<dialog id='msgAlert' open>
                            <center><img src='fundoLogin/alert.png'></center>
                            <p>Nenhuma planta cadastrada para esta estufa!</p>
                            <a href='telaPrincipal.php'><input type='button' value='VOLTAR' name='btnVoltarAlert'></a>
                        </dialog>";
                }
            } else { 
                echo "*Erro: O email do usuário não corresponde ao email associado ao número de série.";
            }
        } catch (PDOException $erro) {
            echo "Erro na conexão com o banco de dados: " . $erro->getMessage();
        }
        
    }
} else {
    echo "Erro: Usuário não está logado.";
}


?>