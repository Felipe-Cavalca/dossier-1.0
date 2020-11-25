<?php
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$arq = filesize($_FILES['fileUpload']['tmp_name']);
$ext = strtolower(substr($_FILES['fileUpload']['name'], -4));
$name = strtolower(substr($_FILES['fileUpload']['name'], 0, -4)); 

if ($ext == '.chv'){
    $new_name = $name . '' . date("YmdHis") . $ext;
    $dir = 'executar/';
    mkdir($dir,0777);
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir . $new_name);
    
    $arquivo = fopen($dir . $new_name, 'r');
    // Lê o conteúdo do arquivo 
    $texto = "";
    while(!feof($arquivo))
    {
        //Mostra uma linha do arquivo
        $linha = fgets($arquivo, 1024);
        $texto .= $linha;
    }
    // Fecha arquivo aberto
    fclose($arquivo);
    //echo $texto;
    
    $substituir = ";";
    $texto = substr($texto, 0, -1) . $substituir;
    //echo $texto; 
    
    include'../php/conexao.php';
    $sth = $pdo->prepare($texto);
    delTree($dir);
    if($sth->execute()){
        header('location: index.php?msg=cadastrado');
    }
    else {
        echo 'erro';
    }
    
}
else {
    echo 'arquivo invalido';
}

function delTree($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

?>