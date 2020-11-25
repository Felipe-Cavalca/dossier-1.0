<?php
$texto = "Isso é um teste";
$alfabeto = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
$chave =    'MmKkSsDdTtIiPpJjYyWwOoXxVvGgLlFfHhRrBbZzCcUuQqEeAaNn1234567890';

$codificado = mudar($texto, $chave, $alfabeto);
echo $codificado; 


function mudar($texto, $chave, $alfabeto){
    $codificado=$texto;
    $tamanho = strlen($texto);
    $tamalfabeto = strlen($alfabeto);
    for ($x=0;$x != $tamanho;$x++){
        for($y=0;$y!=$tamalfabeto;$y++){
            if ($texto[$x] == $alfabeto[$y]){
                $codificado[$x] = str_replace($alfabeto[$y], $chave[$y], $codificado[$x]);    
                $y=$tamalfabeto-1;
            }
        }
    }
    return $codificado;
}