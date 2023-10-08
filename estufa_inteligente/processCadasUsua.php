<?php

    #fazer conexao com BD
    try
    {
        echo "Dados gravados com sucesso!<br><br>";

        #atributos

        $id_usuario="";
        $nome=$_POST['campoNome'];
        $email=$_POST['campoEmail'];
        $senha=$_POST['campoSenha'];

        #imprimir os dados inseridos
        echo "Email: {$email}<br>";
        echo "Nome: {$nome}<br>";
        echo "Senha: {$senha}<br>";

        #conexao com mysql
        $conectaBD=new PDO("mysql:host=127.0.0.1;port=3306;dbname=estufa","root","");
        $conectaBD->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        #conexao com banco de dados operacoes_cartao
        $dados="INSERT INTO usuario(id_usuario,nome,email,senha) VALUE('".$id_usuario."','".$nome."','".$email."','".$senha."')";

        #metodo para executar o sql
        $conectaBD->exec($dados);
             

    }
    catch(PDOException $erro)
    {
        #informar que houve erro ao fazer a conexao com BD
        echo "Houve erro ao fazer a conexao com banco de dados!";
    }

?>