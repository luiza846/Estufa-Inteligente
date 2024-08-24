<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ecommerce.css">
    <title>Contato</title>
</head>

<body>
    <div class="menu">
        <div class="btns-menu">
            <a href="index.html"><input type="button" value="Home" name="btnPerfil" id="btns"></a>
            <a href="sobreNos.html"><input type="button" value="Sobre Nós" name="btnPerfil" id="btns"></a>
            <a href="contato.html"><input type="button" value="Contato" name="btnPerfil" id="btns"></a>
            <a href="login.php"><input type="button" value="Entrar" name="btnPerfil" id="btns"></a>
        </div>
    </div>

    <a href="index.html">
        <div class="logo02"></div>
    </a>
    <div class="div-contato">
        <div class="div-email">
            <img class = "div-img" src="images/email01.png" alt="email">
           
            <form action="enviar.php" name="form_contato" method="POST" >
            
                <div class="div-contat-nome">
                    Nome: <input type="text" name="campoNome" id="name" placeholder="Digite o seu nome" data-max-length="16" data-only-letters>
                </div>
                <div class="div-contat-email">
                    E-mail: <input type="text" name="campoEmail" id="email" placeholder="Digite o seu e-mail" data-min-length="3" data-required data-email-validate>
                </div>
                <div class="div-contat-duvida">
                    <textarea id="duvida" class="div-duvida" placeholder="Digite o seu comentário ou dúvida..." name="campoDuvida" rows="10" cols="33"></textarea>        
                </div>

                <div class="div-contat-button">
                    <input type="submit" id="btn-submit" name="btnEnviarEmail" value="Enviar sua dúvida">
                </div>

            </form>

        </div>
    </div>
    <div id="contato_form">
    </div>

    <div class="rodape">
        <div class="rodape-marca">
            <img src="fundoLogin/logoxx.png" alt="logo">
        </div>
        <div class="rodape-links">
            <h3>Páginas</h3>
            <li><a href="">Inscreva-se</a></li>
            <li><a href="">Entrar</a></li>
            <li><a href="">Sobre nós</a></li>
            <li><a href="">Contato</a></li>
        </div>
    </div>
</body>

</html>