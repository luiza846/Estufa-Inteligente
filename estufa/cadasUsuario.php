<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="css/cadasUsuario.css">
    <p class="error-validation template"></p>
    <script src="js/cadasUsuario.js"></script>

</head>
<body>

<div id="main-container">
        <h1>CRIAR CONTA</h1>

        <form id="register-form" method="POST" action="processCadasUsua.php">
            <!--ocupa todo o formulario (full-box)-->

            <div class="lado"></div>

            <div class="full-box">

                E-mail: <input type="text" name="campoEmail" id="email" placeholder="Digite o seu e-mail" data-min-length="3" data-required data-email-validate>

            </div>
            <!--ocupa metade do formulario (half-box)-->
            <div class="full-box spacing">

                Nome: <input type="text" name="campoNome" id="name" placeholder="Digite o seu nome" data-max-length="16" data-only-letters>

            </div>
            <div class="full-box spacing">
              
                Senha: <input type="password" name="campoSenha" id="password" placeholder="Digite a sua senha" data-required data-password-validate>

            </div>
            <div class="full-box">
              
                Confirmação senha: <input type="password" name="campoConfirmSenha" id="passconfirmation" placeholder="Confirme a sua senha" data-equal="password" data-required>

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

</body>
</html>