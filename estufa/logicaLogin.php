<?php

#------------------------------AUTENTICAÇÃO-----------------------------------------
include('conexao.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "*Preencha seu e-mail!";
    } else if(strlen($_POST['senha']) == 0) {
        echo "*Preencha sua senha!";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        #------------------------------SESSÕES--------------------------------------

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];

            #direciona para tela principal
            header("Location: telaPrincipal.php");

        } else {
            echo "*Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>
