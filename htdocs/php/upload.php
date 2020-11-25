<?php
session_start();
include 'conexao.php';
// $espacototal
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$bytestotal = GetDirectorySize('arquivos/'.$_SESSION['Login']['email']);
//echo $bytestotal.' bytes de uso<br>';
$arq = filesize($_FILES['fileUpload']['tmp_name']);

if ($bytestotal+$arq < $espacototal){
    $teste = strtolower(substr($_FILES['fileUpload']['name'], -4, -3));

    date_default_timezone_set("Brazil/East");
    if ($teste=='.'){
        $ext = strtolower(substr($_FILES['fileUpload']['name'], -4));
        $name = strtolower(substr($_FILES['fileUpload']['name'], 0, -4)); 
    }
    else{
        $ext = strtolower(substr($_FILES['fileUpload']['name'], -5));
        $name = strtolower(substr($_FILES['fileUpload']['name'], 0, -5));
    
    }
    $new_name = $name . '' . date("YmdHis") . $ext;
    
    $dir = $_SESSION['Login']['caminho'];
    
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir . $new_name);
    
    $Dados = array(
    	'arq_nome' =>$name.$ext,
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
    //echo $pdo->lastInsertId();
    
    
//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' fez o upload do arquivo ' . $new_name . ' no diretorio ' . $_SESSION['Login']['caminho'] . '
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
else {
    header('LOCATION: ../home.php?msg=espaco');
}



function GetDirectorySize($path){
    $bytestotal = 0;
    $path = realpath($path);
    if($path!==false){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytestotal += $object->getSize();
        }
    }
    return $bytestotal;
}

?>