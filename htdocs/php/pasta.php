<?php
session_start(); 
include 'conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);

$Dados = array(
    'nome_pasta'=> $post['pasta_nome'],
	'dono_pasta' => $_SESSION['Login']['email'],
	'local_pasta' => $_SESSION['Login']['caminho'],
);
            
$Fields = implode(', ', array_Keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'Tbl_pastas';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
mkdir($_SESSION['Login']['caminho']. $post['pasta_nome'],0777);

$sth = $pdo->prepare($Create);
$sth->execute($Dados);

$dir = $_SESSION['Login']['caminho'].$post['pasta_nome'].'/';
$arq = 'index.php';

$arquivo = fopen($dir.$arq,'w');
fclose($arquivo);
$msg = "<?php 
header('Location: ../');";
$arquivo= $dir.$arq;
$fp = fopen($arquivo, "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);

//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' criou a pasta '. $post["pasta_nome"] . '
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);

header('Location: entrar.php?nome=' . $post['pasta_nome']);
	