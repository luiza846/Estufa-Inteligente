<?php
    session_start();

    #verificar se a variável de sessão chamada 'id_usuario' está definida
    if (isset($_SESSION['id_usuario'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            # fazer conexão com o BD
            try {
                # Criação da conexão PDO
                $conn = new PDO("mysql:host=localhost;dbname=estufa", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = "DELETE FROM planta";
                $conn->exec($sql);
                echo "Record deleted successfully";
                }        

            } catch (PDOException $erro) {
                # informar que houve erro ao fazer a conexão com o BD
                echo $sql . "<br>" . $e->getMessage();
            }
        }
        ?>
        