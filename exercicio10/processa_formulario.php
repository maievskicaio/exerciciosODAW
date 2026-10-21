<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    $interesse = $_POST['interesse'] ?? [];
    $embalagem = $_POST['embalagem'] ?? '';
    $termos = isset($_POST['receberInformacoes']) ? 'Sim' : 'Não';

    // Salva o estado para não perder os dados em caso de erro
    $_SESSION['old'] = $_POST;
    $erro = "";

    // Requisito 1a: Validação de preenchimento de todos os campos
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha) || empty($interesse) || empty($embalagem) || !isset($_POST['receberInformacoes'])) {
        $erro = "Erro: Todos os campos são obrigatórios para realizar o cadastro.";
    } 
    // Requisito 1b: Validação de 2 campos (Formato do E-mail e Validação de Senha)
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Erro: O e-mail informado não possui um formato válido.";
    } elseif (strlen($senha) < 6) {
        $erro = "Erro: A senha precisa ter no mínimo 6 caracteres.";
    } elseif ($senha !== $confirmar_senha) {
        $erro = "Erro: As senhas digitadas não coincidem.";
    } else {
        // Requisito 2 e 3: Verificar e-mail duplicado e gravar com senha cifrada no autenticacao.txt
        $arquivo = 'autenticacao.txt';
        $ja_cadastrado = false;

        if (file_exists($arquivo)) {
            $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($linhas as $linha) {
                $partes = explode(':', $linha, 2);
                if (count($partes) == 2 && trim($partes[0]) === $email) {
                    $ja_cadastrado = true;
                    break;
                }
            }
        }

        if ($ja_cadastrado) {
            $erro = "Erro: Este e-mail já está cadastrado em nosso sistema.";
        } else {
            // Cifra a senha usando password_hash (BCRYPT)
            $hash_senha = password_hash($senha, PASSWORD_DEFAULT);
            $linha_registro = $email . ":" . $hash_senha . PHP_EOL;

            // Salva o registro no arquivo txt
            file_put_contents($arquivo, $linha_registro, FILE_APPEND | LOCK_EX);

            // Requisito 1c: Confirmação com as informações cadastradas
            $_SESSION['sucesso'] = "Cadastro realizado com sucesso! Sua conta foi criada.";
            $_SESSION['dados_usuario'] = [
                'Nome Completo' => htmlspecialchars($nome),
                'E-mail (Login)' => htmlspecialchars($email),
                'Interesses' => htmlspecialchars(implode(", ", $interesse)),
                'Embalagem Preferida' => htmlspecialchars($embalagem),
                'Receberá Notificações?' => $termos
            ];

            unset($_SESSION['old']);
            header("Location: formularioInteresse.php");
            exit;
        }
    }

    if (!empty($erro)) {
        $_SESSION['erro'] = $erro;
        header("Location: formularioInteresse.php");
        exit;
    }
}

header("Location: formularioInteresse.php");
exit;