<?php
    session_start();

    #verificar se a variável de sessão chamada 'id_usuario' está definida
    if (isset($_SESSION['id_usuario'])) {

            #fazer conexao com BD
        try
        {
            echo "Dados gravados com sucesso!<br><br>";

            #atributos

            $id="";
            $id_usuario = $_SESSION['id_usuario'];
            $nome=$_POST['campoNome'];
            $dat=$_POST['campoData'];
            $umidade=$_POST['campoUmidade'];
            $temperatura=$_POST['campoTemperatura'];

            #imprimir os dados inseridos
            echo "Nome: {$nome}<br>";
            echo "Data que foi plantado: {$dat}<br>";
            echo "Umidade: {$umidade}%<br>";
            echo "Temperatura: {$temperatura}°C<br>";

            #conexao com mysql
            $conectaBD=new PDO("mysql:host=127.0.0.1;port=3306;dbname=estufa","root","");
            $conectaBD->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            #conexao com banco de dados operacoes_cartao
            $dados="INSERT INTO planta(id_planta,id_usuario,nome,data_criacao,umidade,temperatura) VALUE('".$id."','".$id_usuario."','".$nome."','".$dat."','".$umidade."','".$temperatura."')";

            #metodo para executar o sql
            $conectaBD->exec($dados);

            #gerando arquivo txt
            #$historico = "Nome: ".$_POST['campoNome']."\nData que foi plantado: ".$_POST['campoData']."\nUmidade: ".$_POST['campoUmidade']."\nTemperatura: ".$_POST['campoTemperatura'];
            #file_put_contents('HistoPlantas.txt', $historico . "\n", FILE_APPEND);
            #FILE_APPEND permite que você adicione dados a um arquivo existente sem sobrescrever seu conteúdo anterior.
        }
        catch(PDOException $erro)
        {
            #informar que houve erro ao fazer a conexao com BD
            echo "Houve erro ao fazer a conexao com banco de dados!";
            echo "<br><br>Error: " . $erro->getMessage();
        }
    }
    else {
        echo "ID de usuário não definido na sessão.";
    }
?>
<?php


?>