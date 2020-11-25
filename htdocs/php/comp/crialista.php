<?php
session_start(); 
include '../conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);

$Dados = array(
    'nome_lista'=> $post['nome'],
	'dono_lista' => $_SESSION['Login']['email'],
);
            
$Fields = implode(', ', array_Keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'lista';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
$sth = $pdo->prepare($Create);
$sth->execute($Dados);


//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' criou a lista '. $post["nome"] . '
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("../log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);
