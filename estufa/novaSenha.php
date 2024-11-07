<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <!--<link rel="stylesheet" href="css/style.css">-->
    <script src="js/cadasUsuario.js"></script>
    <!--icon-->
    <link rel="shortcut icon" type="imagex/png" href="./images/icon.ico">
</head>
<body>

    
    <form class="form-cadas-usuario" method="POST" action="">
        <!-- CARREGAR IMAGEM -->

        <h1>Redefinir senha</h1>

        <?php
include_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $senha = $_POST['campoSenha'];
    $confirmSenha = $_POST['campoConfirmSenha'];
    $email = $_POST['campoEmail'];

    try {
        if($senha == $confirmSenha){
        // Criar uma conexão PDO
        $conn = new PDO("mysql:host=estufa.mysql.dbaas.com.br;port=3306;dbname=estufa", "estufa", "Hunter231020@#");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // verificar se o email e n serie existem
        $checkQuery = $conn->prepare("SELECT email FROM usuario WHERE email = :email");
        $checkQuery->bindParam(':email', $email, PDO::PARAM_STR);
        $checkQuery->execute();
        $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // se o email e senha estao corretos inserir dados
            $query_usuario = "UPDATE usuario SET senha = :senha WHERE email = :email;";
            $cad_usuario = $conn->prepare($query_usuario);
            $cad_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
            $cad_usuario->bindParam(':email', $email, PDO::PARAM_STR);
            

            if ($cad_usuario->execute()) {
                // deu certo
                echo "OK!!!";
            } else {
                echo "Erro ao cadastrar o usuário.";
            }
        } else {
            echo "*Erro: E-mail não encontrado!";
        }}else{
            echo "*Erro: Senhas diferentes!";
        }
    } catch (PDOException $erro) {
        echo "Erro na conexão com o banco de dados: " . $erro->getMessage();
    }
} else {
    echo "";
}
?>
        
            E-mail: <input type="text" name="campoEmail" id="email" placeholder="Digite o seu e-mail" data-min-length="3" data-required data-email-validate>
            Senha: <input type="password" name="campoSenha" id="password" placeholder="Digite a sua senha" data-required data-password-validate>
            Confirmação senha: <input type="password" name="campoConfirmSenha" id="passconfirmation" placeholder="Confirme a sua senha" data-equal="password" data-required>
            <input type="submit" id="btn-submit" value="ALTERAR">
                <a href="http://labtg1.com.br/Estufa-Inteligente/estufa/index.html">Voltar</a>
  </form>


</body>
</html>
