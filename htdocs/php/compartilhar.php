<?php
session_start();
include 'conexao.php';
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if ( isset( $post['editavel'] ) )
{
    $editavel='s';
}else{
    $editavel='n';
}
if ($post['lista']=="vazio"){
    $sth = $pdo->prepare("SELECT *FROM Tbl_usuario where Email_usuario = :pessoa ");
    $sth->bindValue(":pessoa", $post['e-mail']);
    $sth->execute();
    $sth->rowCount();
    if ($sth->rowCount()!=1){
        header('LOCATION: ../home.php?msg=errocomp');
    }
    else{
            
        $sth = $pdo->prepare("INSERT INTO compartilhados (arq_comp, usu_comp, arq_caminho, arq_dono, editavel) VALUES (:arquivo, :pessoa, :caminho, :arq_dono, :editavel);");
        
        $sth->bindValue(":arquivo", $_SESSION['Login']['compartilhamento']);
        $sth->bindValue(":pessoa", $post['e-mail']);
        $sth->bindValue(":caminho", $_SESSION['Login']['caminho']);
        $sth->bindValue(":arq_dono", $_SESSION['Login']['email']);
        $sth->bindValue(":editavel", $editavel);
        
        //$sth->execute();
        
        if ($sth->execute() )
        {
            
    //log
    $data = date('d-m-Y-h-i-s');
    $msg = $data . ' - ' . $_SESSION['Login']['email'] . ' compartilhou o arquivo ' . $_SESSION['Login']['compartilhamento'] . ' com '.$post['e-mail'] . '
';
    // Abre ou cria o arquivo bloco1.txt
    // "a" representa que o arquivo é aberto para ser escrito
    $fp = fopen("log.txt", "a");
    // Escreve a mensagem passada através da variável $msg
    $escreve = fwrite($fp, $msg);
    // Fecha o arquivo
    fclose($fp);
            
            //echo "foi.";
            header('LOCATION: ../home.php');
        }
        else
        {
            echo "Por algum motivo nao foi possivel criar esse compartilhamento.";
        }
        
    }
}
else{
    $sth = $pdo->prepare("SELECT *FROM id_usuario_lista where lista_usu_lista = :lista ");
    $sth->bindValue(":lista", $post['lista']);
    $sth->execute();
    foreach ($sth as $res) :
    extract($res);
        $sth = $pdo->prepare("INSERT INTO compartilhados (arq_comp, usu_comp, arq_caminho, arq_dono, editavel) VALUES (:arquivo, :pessoa, :caminho, :arq_dono, :editavel);");
        
        $sth->bindValue(":arquivo", $_SESSION['Login']['compartilhamento']);
        $sth->bindValue(":pessoa", $usuario_usu_lista);
        $sth->bindValue(":caminho", $_SESSION['Login']['caminho']);
        $sth->bindValue(":arq_dono", $_SESSION['Login']['email']);
        $sth->bindValue(":editavel", $editavel);
        $sth->execute();
        
        //log
        $data = date('d-m-Y-h-i-s');
        $msg = $data . ' - ' . $_SESSION['Login']['email'] . ' compartilhou o arquivo ' . $_SESSION['Login']['compartilhamento'] . ' com '.$usuario_usu_lista . '
';
        // Abre ou cria o arquivo bloco1.txt
        // "a" representa que o arquivo é aberto para ser escrito
        $fp = fopen("log.txt", "a");
        // Escreve a mensagem passada através da variável $msg
        $escreve = fwrite($fp, $msg);
        // Fecha o arquivo
        fclose($fp);
    endforeach;
    header('LOCATION: ../home.php');
}