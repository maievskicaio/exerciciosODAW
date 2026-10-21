<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $_SESSION['old_login_email'] = $email;

    // Validação de campos vazios
    if (empty($email) || empty($senha)) {
        $_SESSION['login_erro'] = "Erro: Preencha o e-mail e a senha para realizar o login.";
        header("Location: login.php");
        exit;
    }

    $arquivo = 'autenticacao.txt';
    $autenticado = false;

    if (file_exists($arquivo)) {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($linhas as $linha) {
            $partes = explode(':', $linha, 2);
            if (count($partes) === 2) {
                $user_txt = trim($partes[0]);
                $hash_txt = trim($partes[1]);

                // Compara o e-mail e verifica a hash cifrada da senha
                if ($email === $user_txt && password_verify($senha, $hash_txt)) {
                    $autenticado = true;
                    break;
                }
            }
        }
    } else {
        $_SESSION['login_erro'] = "Erro: Arquivo autenticacao.txt não encontrado no servidor.";
        header("Location: login.php");
        exit;
    }

    if ($autenticado) {
        $_SESSION['login_sucesso'] = "Login realizado com sucesso! Usuário autenticado.";
        unset($_SESSION['old_login_email']);
    } else {
        $_SESSION['login_erro'] = "Erro: E-mail ou senha incorretos. Acesso negado.";
    }

    header("Location: login.php");
    exit;
}

header("Location: login.php");
exit;