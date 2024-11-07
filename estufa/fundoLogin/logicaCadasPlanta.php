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
                    # nothing to do
                }
                
                // encontrar o email do usuario na tb usuario
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

                    // verificar se usuario ja cadastrou a planta
                    $checkQuery = $conn->prepare("SELECT * FROM estufa WHERE n_serie = :nSerie");
                    $checkQuery->bindParam(':nSerie', $nSerie, PDO::PARAM_STR);
                    $checkQuery->execute();
                    $resultPlantaExistente = $checkQuery->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$resultPlantaExistente) {
                        // cadastrar se ainda nao tem planta na estufa
                        $opcaoSelecionada = $_POST['categoria'];
                        
                        $stmt = $conn->prepare("SELECT * FROM planta WHERE id_planta = :opcaoSelecionada");
                        $stmt->bindParam(':opcaoSelecionada', $opcaoSelecionada, PDO::PARAM_INT);
                        $stmt->execute();
                        $dadosOpcao = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($dadosOpcao) {
                            $stmt = $conn->prepare("INSERT INTO estufa (id_usuario, n_serie, data_criacao, imagem, nome, umidade, temperatura) VALUES (:id_usuario, :n_serie, :data_criacao, :imagem, :nome, :umidade, :temperatura)");
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
                                    $ultimo_id = $conn->lastInsertId();
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
                                    }}                                
                                
                                    echo "<dialog id='msgSucesso' open>
                                    <center><img src='fundoLogin/sucesso.png'></center>
                                    <p>Cadastro realizado com sucesso!</p>
                                    <a href='telaPrincipal.php'><input type='button' value='VOLTAR' name='btnVoltar'></a>
                                 </dialog>";
                            } else {
                                echo "Erro ao inserir dados da opção na tabela 'estufa'.";
                            }
                        } else {
                            echo "Opção não encontrada na tabela 'planta'.";
                        }
                    } else {
                        echo "<dialog id='msgAlert' open>
                            <center><img src='fundoLogin/alert.png'></center>
                            <p>Estufa já possui planta!</p>
                            <a href='telaPrincipal.php'><input type='button' value='VOLTAR' name='btnVoltarAlert'></a>
                            <a href='alteraPlanta.php'><input type='button' value='EDITAR PLANTA' name='btnEditPlantaAlert'></a>
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