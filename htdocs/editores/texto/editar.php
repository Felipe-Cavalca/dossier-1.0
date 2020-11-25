<?php
session_start();
include '../../php/conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("SELECT *from compartilhados WHERE arq_comp =:id");
$sth->bindValue(":id", $id);
$sth->execute();
if ($sth->rowCount()>=1){
    foreach ($sth as $res):
        extract($res);
        $dir = '../../php/'.$arq_caminho;
    endforeach;    
}
else {
  $dir = '../../php/'.$_SESSION['Login']['caminho'];  
}



//
//echo $dir.$id;
$arquivo = $dir.$id;
$texto = $post['texto'];
$extensao = substr($arquivo, -4);
if ($extensao=='dssr'){
 $texto = mudar($texto);   
}

//cria arquivo
$arquivo = fopen($arquivo,'w');
//escrevemos no arquivo
fwrite($arquivo, $texto);
//Fechamos o arquivo após escrever nele
fclose($arquivo);

header('LOCATION: ../../home.php');

function mudar($texto){
    $alfabeto = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
    $chave =    'MmKkSsDdTtIiPpJjYyWwOoXxVvGgLlFfHhRrBbZzCcUuQqEeAaNn1234567890';
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
?>