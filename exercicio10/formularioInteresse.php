<?php
session_start();
$erro = $_SESSION['erro'] ?? '';
$sucesso = $_SESSION['sucesso'] ?? '';
$dados_usuario = $_SESSION['dados_usuario'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['erro'], $_SESSION['sucesso'], $_SESSION['dados_usuario']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cerveja Maluca - Cadastro</title>
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
        
        <div class="w3-container w3-padding-32">        
            <div class="w3-content w3-card-4 w3-padding-24 w3-white" style="max-width: 700px; border-radius: 8px;">
                
                <div class="w3-display-container" style="height: 10vh;">
                    <div class="w3-display-middle" style="display: flex; align-items: center; justify-content: center; gap: 20px;">
                      <h2 class="w3-center" style="color:#1C1C1E">Formulário de Cadastro</h2>
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
                        <div class="w3-panel w3-green w3-round w3-padding">
                            <p><b><?= $sucesso ?></b></p>
                            <h3>Dados Registrados:</h3>
                            <ul style="text-align: left;">
                                <?php foreach ($dados_usuario as $chave => $valor): ?>
                                    <li><strong><?= $chave ?>:</strong> <?= $valor ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="w3-center w3-margin-top">
                            <a href="formularioInteresse.php" class="w3-button w3-black w3-round">Cadastrar Novo Usuário</a>
                        </div>
                    <?php else: ?>
                    
                    <form name="formCadastro" action="processa_formulario.php" method="POST" class="w3-container">

                        <h4 style="color:#1C1C1E">1. Dados Pessoais e Acesso</h4>
                        <p>
                            <label for="nome" style="color:#1C1C1E"><b>Nome Completo:</b></label>
                            <input class="w3-input w3-border w3-round" type="text" name="nome" placeholder="Seu nome completo" value="<?= htmlspecialchars($old['nome'] ?? '') ?>">
                        </p>

                        <p>
                            <label for="email" style="color:#1C1C1E"><b>E-mail (Login):</b></label>
                            <input class="w3-input w3-border w3-round" type="text" name="email" placeholder="nome@dominio.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                        </p>

                        <p>
                            <label for="senha" style="color:#1C1C1E"><b>Senha (mínimo 6 caracteres):</b></label>
                            <input class="w3-input w3-border w3-round" type="password" name="senha">
                        </p>

                        <p>
                            <label for="confirmar_senha" style="color:#1C1C1E"><b>Confirmar Senha:</b></label>
                            <input class="w3-input w3-border w3-round" type="password" name="confirmar_senha">
                        </p>
                        
                        <hr>
                        <h4 style="color:#1C1C1E">2. Preferências</h4>

                        <p>
                            <label for="interesse" style="color:#1C1C1E"><b>Motivo do Contato:</b></label>
                            <select class="w3-select w3-border w3-round" name="interesse[]" multiple style="height: 100px;">
                                <option value="comprar" <?= (in_array('comprar', $old['interesse'] ?? [])) ? 'selected' : '' ?>>Comprar e BEBER Cerveja</option>
                                <option value="informacoes" <?= (in_array('informacoes', $old['interesse'] ?? [])) ? 'selected' : '' ?>>Informações super úteis</option>
                                <option value="outro" <?= (in_array('outro', $old['interesse'] ?? [])) ? 'selected' : '' ?>>Outros</option>
                            </select>
                        </p>

                        <p>
                            <label style="color:#1C1C1E"><b>Embalagem Preferida:</b></label><br>
                            <input type="radio" class="w3-radio" name="embalagem" value="Garrafa" <?= (isset($old['embalagem']) && $old['embalagem'] == 'Garrafa') ? 'checked' : '' ?>> Garrafa
                            <input type="radio" class="w3-radio" name="embalagem" value="Lata" <?= (isset($old['embalagem']) && $old['embalagem'] == 'Lata') ? 'checked' : '' ?>> Lata
                            <input type="radio" class="w3-radio" name="embalagem" value="Barril" <?= (isset($old['embalagem']) && $old['embalagem'] == 'Barril') ? 'checked' : '' ?>> Barril Chopp
                        </p>

                        <p>
                            <input class="w3-check" type="checkbox" name="receberInformacoes" required <?= isset($old['receberInformacoes']) ? 'checked' : '' ?>>
                            <label for="receberInformacoes" style="color:#1C1C1E">Desejo receber informações sobre cervejas! (Obrigatório)</label>
                        </p>

                        <p class="w3-center w3-margin-top">
                            <input type="submit" value="Finalizar Cadastro" class="w3-button w3-black w3-round w3-hover-green">
                            <input type="reset" value="Limpar" class="w3-button w3-light-grey w3-round w3-hover-red">
                        </p>
                    
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>