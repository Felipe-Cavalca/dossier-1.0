<?php
session_start();
$pode = true;
$x=0;
$y=0;
include 'conexao.php';

//ve qual pasta é
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sth = $pdo->prepare("SELECT *from Tbl_pastas WHERE id_pasta = $id");
$sth->execute();
foreach($sth as $res){
    extract($res);
    $apagar =  $local_pasta.$nome_pasta;
}

//verifica arquivos nas pastas
$sth = $pdo->prepare("SELECT * FROM `arquivos` WHERE `arq_caminho` LIKE '$apagar%'");
$sth->execute();
foreach($sth as $res){
    extract($res);
    $sth = $pdo->prepare("SELECT * from compartilhados WHERE arq_comp = '$arq_arquivo'");
    $sth->execute();    
    if ($sth->rowCount()>=1){
        $pode=false;
        header('LOCATION: ../home.php?msg=p_comp');
    }
    else{
        $arq[$x]=$arq_id;
        $x++;
    }
}

//apaga as permitidas
if ($pode==true){
    while($y<$x){
        $sth = $pdo->prepare("DELETE from arquivos WHERE arq_id = $arq[$y]");
        $sth->execute();       
        $y++;
    }
    
    //lista as subpastas e apaga
    $sth = $pdo->prepare("SELECT * FROM `Tbl_pastas` WHERE `local_pasta` LIKE '$apagar%'");
    $sth->execute();
    foreach($sth as $res){
        extract($res);
        $sth = $pdo->prepare("DELETE from Tbl_pastas WHERE id_pasta = $id_pasta");
        $sth->execute();
    }
    
    
    //deleta pasta selecionada
    $sth = $pdo->prepare("DELETE from Tbl_pastas WHERE id_pasta = :id");
    $sth->bindValue(":id", $id);
    if ($sth->execute()) {
        delTree($apagar);
        
        
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' apagou a pasta '.  $apagar . ' e todos os seus itens
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);
        
        
        
        header('Location: ../home.php#pastas');
    }
    else{
        echo 'por algum motivo não foi possivel excluir';
    }
    
}
else{
    header('LOCATION: ../home.php?msg=p_comp');   
}


//apaga as midias 
    function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

/*
*/