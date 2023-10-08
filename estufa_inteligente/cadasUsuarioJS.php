<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadasUsuario.css">
</head>
<body>
    <!--container do formulario-->
    <div id="main-container">
        <h1>CRIAR CONTA</h1>
        <form id="register-form" method="POST" action="processCadasUsuario.php">
            <!--ocupa todo o formulario (full-box)-->
            <div class="full-box">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite o seu e-mail" data-min-length="3" data-required data-email-validate>
            </div>
            <!--ocupa metade do formulario (half-box)-->
            <div class="half-box spacing">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Digite o seu nome" data-max-length="16" data-only-letters>
            </div>
            <div class="half-box">
                <label for="lastname">Sobrenome</label>
                <input type="text" name="lastname" id="lastname" placeholder="Digite o seu sobrenome">
            </div>
            <div class="half-box spacing">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite a sua senha" data-required data-password-validate>
            </div>
            <div class="half-box">
                <label for="passconfirmation">Confirmação senha</label>
                <input type="password" name="password" id="passconfirmation" placeholder="Confirme a sua senha" data-equal="password" data-required>
            </div>
            <div class="full-box">
                <input type="checkbox" name="agreement" id="agreement" placeholder="Digite o seu e-mail">
                <label for="agreement" id="agreement-label">Eu li e aceito os <a href="#">termos de uso</a></label>
            </div>
            <div class="full-box">
                <input type="submit" id="btn-submit" value="Registrar">
            </div>
            <div class="full-box">
                <a href="index.php">Voltar</a>
            </div>
        </form>
    </div>
    
    <p class="error-validation template"></p>
    <script src="js/cadasUsuario.js"></script>
</body>
</html>