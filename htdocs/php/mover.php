<?php
//echo 'em breve';

session_start();
include 'conexao.php';

//ve qual pasta é
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sth = $pdo->prepare("SELECT *from compartilhados WHERE id_comp = $id");
$sth->execute();
foreach($sth as $res){
    extract($res);
    $arq =  $arq_comp;
    $caminho = $arq_caminho;
    $dono = $arq_dono;
}
if ($dono != $_SESSION['Login']['email']){
    $extensao = substr($arq, -4, -3);
    if ($extensao == '.'){
        $ext = strtolower(substr($arq, -4));
        $name = strtolower(substr($arq, 0, -18));    
    }
    else{
        $ext = strtolower(substr($arq, -5));
        $name = strtolower(substr($arq, 0, -19));    
    }
    $new_name = $name . '' . date("YmdHis") . $ext;
    $origem = $caminho.$arq;
    $destino = $_SESSION['Login']['caminho'].$new_name;
    if (copy($origem, $destino)){
        $Dados = array(
        	'arq_nome' =>$name,
        	'arq_arquivo' => $new_name,
            'arq_dono' => $_SESSION['Login']['email'],
        	'arq_caminho' => $_SESSION['Login']['caminho']
        );
        
        $Fields = implode(', ', array_Keys($Dados));
        $Places = ':' . implode(', :', array_keys($Dados));
        $Tabela = 'arquivos';
        $Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
        
        $sth = $pdo->prepare($Create);
        $sth->execute($Dados);
        
        //log
        $data = date('d-m-Y-h-i-s');
        $msg = $data . ' - ' . $_SESSION['Login']['email'] . ' moveu o arquivo '.  $arq . ' para o diretorio ' . $destino . '
';
        // Abre ou cria o arquivo bloco1.txt
        // "a" representa que o arquivo é aberto para ser escrito
        $fp = fopen("log.txt", "a");
        // Escreve a mensagem passada através da variável $msg
        $escreve = fwrite($fp, $msg);
        // Fecha o arquivo
        fclose($fp);
        
        header('Location: ../home.php');
    }
    else{
        echo 'erro';
    }
}
else{
    header('Location: ../home.php?msg=dono');
}


/*
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