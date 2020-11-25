<?php
session_start();

//$_SESSION['Login']['caminho'] = 'arquivos/' .$_SESSION['Login']['email'] . '/';
//$_SESSION['Login']['caminho'] = $_SESSION['Login']['anterior'];

$caminho =  $_SESSION['Login']['caminho'];
$x=-1;
$y=0;
$foi = false;
while ($foi!=true){
    $teste = substr($caminho, $x, $y);
    if ($teste=="/"){
        $num = strlen ($caminho);
        $foi = true;
        $caminho = substr($caminho, 0, $num+$y);
    }
    $x--;
    $y--;
}

if (($caminho == 'arquivos/')||($caminho == $_SESSION['Login']['email'])){
    header('LOCATION: ../home.php?msg=volta');
}else{
    $_SESSION['Login']['caminho']=$caminho;
    header('LOCATION: ../home.php');  
}

?>
