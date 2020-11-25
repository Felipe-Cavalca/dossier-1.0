<?php
session_start();
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);

include '../conexao.php';

$sth = $pdo->prepare("DELETE from id_usuario_lista WHERE id_usu_lista =:id");
$sth->bindValue(":id", $post['usuario']);
$sth->execute();

//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' deletou um usuario da lista
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("../log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);