<?php
function organizarNomes($nomesBaguncados) {
    // explode() divide a string e transforma em um array
    $arrayNomes = explode(",", $nomesBaguncados);
    
    $nomesLimpos = [];
    
    foreach ($arrayNomes as $nome) {
        // trim() remove espaços sobrando no início e fim
        // strtolower() deixa tudo minúsculo
        // ucfirst() deixa apenas a primeira letra maiúscula
        $nomeFormatado = ucfirst(strtolower(trim($nome)));
        
        array_push($nomesLimpos, $nomeFormatado);
    }
    
    sort($nomesLimpos);
    
    $resultado = implode(" - ", $nomesLimpos);
    
    $total = count($nomesLimpos);
    
    return "Temos $total nomes na lista: $resultado";
}

$textoInicial = "  carlos, ana , BEATRIZ, daniel  ";
echo organizarNomes($textoInicial);
?>