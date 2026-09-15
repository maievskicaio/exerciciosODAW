<?php
session_start();

echo "<h3>Trabalhando com Sessions</h3>";

if (isset($_SESSION['acessos_sessao'])) {
    $_SESSION['acessos_sessao']++;
} else {
    $_SESSION['acessos_sessao'] = 1;
}
echo "Você recarregou a página " . $_SESSION['acessos_sessao'] . " vezes enquanto o navegador esteve aberto.<br>";


echo "<h3>Trabalhando com Cookies</h3>";

$nomeCookie = "usuario_recorrente";
$valorCookie = "Sim";

setcookie($nomeCookie, $valorCookie, time() + (86400 * 30), "/");

if(isset($_COOKIE[$nomeCookie])) {
    echo "O cookie '{$nomeCookie}' existe! O valor dele é: " . $_COOKIE[$nomeCookie];
} else {
    echo "O cookie acabou de ser criado e será reconhecido na próxima vez que você atualizar a página.";
}
?>