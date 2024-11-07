<?php
# Fazer conexão com BD
try
{
    # Conexão com MySQL usando PDO
    $conectaBD = new PDO("mysql:host=estufa.mysql.dbaas.com.br;port=3306;dbname=estufa", "estufa", "Hunter231020@#");
    $conectaBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Preparar a consulta SQL
    $sql = "SELECT * FROM usuario";

    # Preparar e executar a consulta
    $stmt = $conectaBD->query($sql);

}
catch(PDOException $erro)
{
    # Informar que houve erro ao fazer a conexão com BD
    echo "Houve erro ao fazer a conexão com o banco de dados!";
}

# para enviar o email

    include("config.php");
    include("vendor/autoload.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="shortcut icon" type="imagex/png" href="./images/icon.ico">
    <!--referenciar o login.css-->
    <link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<body class="body-rec">

<center>
        <div class = "div-rec-senha">
            <div class = "div-form-senha">
            <div class="img-logo">
                <img src="images/logo_folha.png">
            </div>
            <h1>REDEFINA SUA SENHA</h1>
            <h3>Insira o endereço de e-mail vinculado à sua conta do GreenCode para te enviarmos um e-mail.</h3>

        <form class= "form-redef" action="" method="POST">
            E-mail: <input type="email" name="campoEmail" placeholder="Digite seu e-mail" required>
            <div class="btn-redef-senha">
                <input class="btn-enviar-email" type="submit" value="Enviar link">
            </div>
        </form>         


    <div id="loadingModal" class="loading-modal" style="display: none;">
        <div class="loading-content">
            <div class="email-gif">
                <img src="images/gif-email.gif">
            </div>
            <p>Carregando...</p>
        </div>
    </div>
    <script>
        document.querySelector('.form-redef').addEventListener('submit', function() {
            document.getElementById('loadingModal').style.display = 'flex'; // Mostra o modal
        });
    </script>

                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $email = $_POST['campoEmail'];

                        $sql = "SELECT nome, email FROM usuario WHERE email = :email";
                        $stmt = $conectaBD->prepare($sql);
                        $stmt->bindParam(':email', $email,  PDO::PARAM_STR);
                        $stmt->execute();

                        #verificar se o email existe
                        if($stmt->rowCount() > 0){
                            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                            $nomeUsuario = $dados['nome'];
                            #COLOCAR CODIGO AQUI

                            $mail = new PHPMailer(true);

                            try {

                                $mail->isSMTP();                                   //Send using SMTP
                                $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                          //Enable SMTP authentication
                                $mail->Username   = SMTP_USER;                     //SMTP username
                                $mail->Password   = SMTP_PASS;                     //SMTP password
                                $mail->Port       = SMTP_PORT;   
                                $mail->CharSet = 'utf8';                                

                                //Recipients
                                $mail->setFrom(SMTP_USER, "GreenCode");
                                $mail->addAddress($email, 'user');
                                $mail->addReplyTo(SMTP_USER, "GreenCode1");
                                $mail->addEmbeddedImage('images/logoEmail.png', 'logo_banner');

                                $mail->Subject = 'Recuperação de senha';
                                //Content
                                $mail->isHTML(true);                          // Caminho para o arquivo de imagem
                                
                                // Corpo do e-mail com a imagem no topo
                            // Corpo do e-mail com a imagem ocupando 100% da largura
                            $mail->Body = "
                                <div style='text-align: center; width: 100%;'>
                                    <img src='cid:logo_banner' alt='GreenCode Logo' style='width: 100%; max-width: 100%; height: auto;'/>
                                </div>
                                
                                Olá, $nomeUsuario!
                                Recebemos uma solicitação de redefinição de senha da sua conta GreenCode.
                                Clique no botão abaixo para redefinir a senha: 
                                <a href='http://labtg1.com.br/Estufa-Inteligente/estufa/novaSenha.php'>
                                    <input type='button' value='Redefinir senha' name='btnPerfil' id='btns'>
                                </a>
                            ";
                                $mail->send();
                                echo '<div class="div-aviso-redef">O e-mail com a redefinição de senha foi enviado com sucesso!</div>';

                            } catch (Exception $e) {
                                echo "No success. Mailer Error: {$mail->ErrorInfo}";
                            }




                        }
                        else{
                            echo "E-mail ainda não cadastrado!";
                        }
                    }
                ?>

</div>
    </div>
</center>

</body>
</html>
