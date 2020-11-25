<?php

session_start();

$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
$senha_codificada = MD5($senha);

include "conexao.php";
$sth = $pdo->prepare("select *from Tbl_usuario where Email_usuario = :email and Senha_usuario = :senha ");
$sth->bindValue(":email" , $email);
$sth->bindValue(":senha" , $senha_codificada);
$sth->execute();

if ($sth->rowCount() > 0):
    $linha = $sth->fetch(PDO::FETCH_ASSOC);
    extract($linha);
    $_SESSION['Login']['email'] = $email;
    $_SESSION['Login']['senha'] = $senha_codificada;
    $_SESSION['Login']['caminho'] = 'arquivos/' . $email . '/';
    $_SESSION['Login']['tipo'] = $Tipo_usuario;
    
    
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' logou no sistema
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);
    
    
    header('LOCATION: ../home.php');
    echo 'foi';
else:
    header('LOCATION: ../index.php?msg=invalido');
echo 'erro ' . $email . ' ' . $senha_codificada;
endif;
