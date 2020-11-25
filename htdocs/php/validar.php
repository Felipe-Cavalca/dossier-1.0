<?php 
session_start();
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);
$chave = $post['chave']; 
$tot = strlen ($chave);
$x=0;
$val=0;
while ($x<$tot){
    $val=$val+ord($chave[$x]);
    $x++;
}

include "conexao.php";
$sth = $pdo->prepare("select *from Tbl_usuario where Chave_usuario = :chave");
$sth->bindValue(":chave" , $chave);
$sth->execute();
if ($sth->rowCount() == 0){
    if (($val>='1000')&&($val<='1050')){
        $_SESSION['chave']=$chave;
        
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - chave '. $chave . ' validada
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);
        
        header('LOCATION: ../cadastrar.php');
    }else{
        
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - tentatica de cadastro com chave invalida , chave: '. $chave . '
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);

        header('LOCATION: ../chave.php?msg=chave');
    }
}
else{
    
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - tentatica de cadastro com chave já utilizada , chave: '. $chave . '
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);

    header('LOCATION: ../chave.php?msg=usada');
}

?>