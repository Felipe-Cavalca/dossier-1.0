<?php
session_start(); 
include '../conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $sth = $pdo->prepare("SELECT *FROM Tbl_usuario where Email_usuario = :pessoa ");
    $sth->bindValue(":pessoa", $post['email']);
    $sth->execute();
    if ($sth->rowCount()!=1){
        echo'inexistente';
    }
    else{
        $sth = $pdo->prepare("SELECT *FROM id_usuario_lista where usuario_usu_lista = :pessoa and lista_usu_lista = :lista ");
        $sth->bindValue(":pessoa", $post['email']);
        $sth->bindValue(":lista", $post['lista']);
        $sth->execute();
        if ($sth->rowCount()!=0){
            echo'cadastrado';
        }
        else{
            $Dados = array(
                'usuario_usu_lista'=> $post['email'],
            	'lista_usu_lista' => $post['lista'],
            );
                        
            $Fields = implode(', ', array_Keys($Dados));
            $Places = ':' . implode(', :', array_keys($Dados));
            $Tabela = 'id_usuario_lista';
            $Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
            $sth = $pdo->prepare($Create);
            if ($sth->execute($Dados)){
                echo 'foi';
            }
            
            
            //log
            $data = date('d-m-Y-h-i-s');
            $msg = $data . ' - ' . $_SESSION['Login']['email'] . ' adcionou o usuario '. $post["email"] . 'em sua lista
';
            // Abre ou cria o arquivo bloco1.txt
            // "a" representa que o arquivo é aberto para ser escrito
            $fp = fopen("../log.txt", "a");
            // Escreve a mensagem passada através da variável $msg
            $escreve = fwrite($fp, $msg);
            // Fecha o arquivo
            fclose($fp);
        }
    }