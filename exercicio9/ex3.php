<?php
$arquivo = 'contador.txt';

if (file_exists($arquivo)) {
    $visitas = (int) file_get_contents($arquivo);
} else {
    $visitas = 0;
}

$visitas++;

file_put_contents($arquivo, $visitas);

echo "Esta página foi visitada $visitas vezes.";
?>