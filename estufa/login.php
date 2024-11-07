<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--icon-->
    <link rel="shortcut icon" type="imagex/png" href="./images/icon.ico">
    <!--referenciar o login.css-->
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body style="background-image: url(fundoLogin/login.png);">
    <div class="div-login">
    <form action="logicaLogin.php" method="POST">
        <h1>LOGIN</h1>
        <div class = "div-login-autentica">

        </div>
        <p>
            <input id="email" type="text" name="email" placeholder="Email">
        </p>
        <p>
            <input id="password"type="password" name="senha" placeholder="Senha">
        </p>
        <p>
            <div class="div-recSenha">
            <a href="recuperaSenha.php"> Esqueceu a senha?</a></h4>
            </div>
            <input type="submit" value="ENTRAR"></input>
            <h4>Não possui conta?<a href="cadasUsuario.php"> Cadastre-se</a></h4>
        </p>
    </form>

    </div>
    <script>
            var email = document.getElementById('email');
            var password= document.getElementById('password');


             /*borda verde ao clicar no campo email*/
            email.addEventListener('focus',()=>{
                email.style.borderColor= "#21572dcc";
            });
            /*voltar ao normal quando clica em outro campo email*/
            email.addEventListener('blur',()=>{
                email.style.borderColor= "#ccc";
            });

            /*borda verde ao clicar no campo SENHA*/
            password.addEventListener('focus',()=>{
                password.style.borderColor= "#21572dcc";
            });
            /*voltar ao normal quando clica em outro campo SENHA*/
            password.addEventListener('blur',()=>{
                password.style.borderColor= "#ccc";
            });
        </script>

</body>
</html>

