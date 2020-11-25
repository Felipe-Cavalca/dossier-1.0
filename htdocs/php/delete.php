<?php
session_start();
include 'conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("SELECT * from arquivos WHERE arq_id =:id");
$sth->bindValue(":id", $id, PDO::PARAM_INT);
$sth->execute();
foreach ($sth as $res):
    extract($res);
    $caminho = $arq_caminho;
    $nome = $arq_arquivo;
endforeach;

$sth = $pdo->prepare("SELECT * from compartilhados WHERE arq_comp =:arq");
$sth->bindValue(":arq", $nome);
$sth->execute();
if ($sth->rowCount()>=1){
    header('LOCATION: ../home.php?msg=comp');
}
else{
    unlink($caminho.$nome);
    $sth = $pdo->prepare("DELETE from arquivos WHERE arq_id =:id");
    $sth->bindValue(":id", $id, PDO::PARAM_INT);
    if ($sth->execute() )
    {
        
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' deletou o arquivo ' . $nome .'
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);
        
        header('LOCATION: ../home.php');
    }
    else
    {
        echo "Por algum motivo nao foi possivel excluir esse arquivo.";
    }
}