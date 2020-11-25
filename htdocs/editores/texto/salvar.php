<?php
session_start();

//define dados
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);
$texto = $post['texto'];
$dir = '../../php/'.$_SESSION['Login']['caminho'];
$arq = $post['nome'].date("YmdHis").'.dssr';

$texto = mudar($texto);

//cria arquivo
$arquivo = fopen($dir.$arq,'w');
//escrevemos no arquivo
fwrite($arquivo, $texto);
//Fechamos o arquivo após escrever nele
fclose($arquivo);

//inserir no banco
include '../../php/conexao.php';

$Dados = array(
	'arq_nome' =>$post['nome'].'.dssr',
	'arq_arquivo' => $arq,
    'arq_dono' => $_SESSION['Login']['email'],
	'arq_caminho' => $_SESSION['Login']['caminho']
);

$Fields = implode(', ', array_Keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'arquivos';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";

$sth = $pdo->prepare($Create);
$sth->execute($Dados);
//echo $pdo->lastInsertId();
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