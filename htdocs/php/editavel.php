<?php
session_start();
include 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$valor = '';
$sth = $pdo->prepare("SELECT *from compartilhados WHERE id_comp =:id");
$sth->bindValue(":id", $id);
$sth->execute();
foreach ($sth as $res):
    extract($res);
    if ($editavel == 'n'){
        $valor = 's';
    }
    else{
        $valor = 'n';
    }
endforeach;
$sth = $pdo->prepare("UPDATE `compartilhados` SET `editavel` = :valor WHERE `compartilhados`.`id_comp` = :id;");
$sth->bindValue(":valor", $valor);
$sth->bindValue(":id", $id);
$sth->execute();
if ($sth->execute())
{
    
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' alterou a propriedade do compartilhamento
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);
    
    //echo "Contado excluido com sucesso.";
    header('LOCATION: ../home.php#compf');
}
else
{
    echo "Por algum motivo nao foi possivel alterar esse contato.";
}