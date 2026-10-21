<?php
session_start();
$erro = $_SESSION['login_erro'] ?? '';
$sucesso = $_SESSION['login_sucesso'] ?? '';
$old_email = $_SESSION['old_login_email'] ?? '';

unset($_SESSION['login_erro'], $_SESSION['login_sucesso']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cerveja Maluca - Login</title>
        <link rel="icon" href="icone.ico">
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body, h1, h2, h3, h4, h5, h6 { font-family: "Lato", sans-serif }
            .w3-bar, h1, button { font-family: "Montserrat", sans-serif }
        </style>
    </head>
    <body style="background-color:#F4F1EA">
    <!-- Navbar -->
    <section class="w3-top">
        <div class="w3-bar w3-card w3-left-align w3-large cor-amarelo-ouro">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large cor-amarelo-ouro"
                href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
            <a href="./index.html" class="w3-bar-item w3-button w3-padding-large w3-black">Início</a>
            <a href="./opaBier.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Opa Bier</a>
            <a href="./formularioInteresse.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cadastro</a>
            <a href="./login.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Login</a>
        </div>

        <div id="navDemo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large w3-black">
            <a href="./opaBier.html" class="w3-bar-item w3-button w3-padding-large">Opa Bier</a>
            <a href="./formularioInteresse.php" class="w3-bar-item w3-button w3-padding-large">Cadastro</a>
            <a href="./login.php" class="w3-bar-item w3-button w3-padding-large">Login</a>
        </div>
    </section>
    
        <header class="w3-container w3-center cor-amarelo-ouro" style="padding:128px 16px">
            <h1 class="w3-margin w3-jumbo">Autenticação</h1>
            <p class="w3-xlarge">Exercício ODAW - Teste de Login</p>
        </header>
        
        <div class="w3-container w3-padding-32">        
            <div class="w3-content w3-card-4 w3-padding-24 w3-white" style="max-width: 500px; border-radius: 8px;">
                
                <div class="w3-display-container" style="height: 8vh;">
                    <div class="w3-display-middle" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                      <h2 class="w3-center" style="color:#1C1C1E">Entrar no Sistema</h2>
                    </div>
                </div>
                <hr>

                <div class="w3-container">
                    <?php if ($erro): ?>
                        <div class="w3-panel w3-red w3-round w3-padding">
                            <p><b><?= $erro ?></b></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($sucesso): ?>
                        <div class="w3-panel w3-green w3-round w3-padding w3-center">
                            <p><b><?= $sucesso ?></b></p>
                            <a href="login.php" class="w3-button w3-black w3-round w3-margin-top">Testar Outro Login</a>
                        </div>
                    <?php else: ?>
                    
                    <form action="processa_login.php" method="POST" class="w3-container">

                        <p>
                            <label for="email" style="color:#1C1C1E"><b>E-mail:</b></label>
                            <input class="w3-input w3-border w3-round" type="text" name="email" placeholder="nome@dominio.com" value="<?= htmlspecialchars($old_email) ?>">
                        </p>

                        <p>
                            <label for="senha" style="color:#1C1C1E"><b>Senha:</b></label>
                            <input class="w3-input w3-border w3-round" type="password" name="senha" placeholder="Sua senha">
                        </p>

                        <p class="w3-center w3-margin-top">
                            <input type="submit" value="Entrar" class="w3-button w3-black w3-round w3-hover-green" style="width: 100%;">
                        </p>
                    
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>