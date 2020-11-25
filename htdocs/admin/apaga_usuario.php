<?php
session_start();
if ($_SESSION['Login']['tipo'] == 'admin') {
    include '../php/conexao.php';
} else {
    header('Location: ../');
    die;
}

$pode = true;
$x=0;
$y=0;

//ve qual pasta é
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$sth = $pdo->prepare("SELECT *from Tbl_usuario WHERE Id_usuario = $id");
$sth->execute();
foreach($sth as $res){
    extract($res);
    $apagar =  '../php/'.$Pasta_usuario.'/';
    $caminho = $Pasta_usuario;
    $usuario = $Id_usuario;
    $email = $Email_usuario;
}

$sth = $pdo->prepare("DELETE from compartilhados WHERE arq_caminho like '$caminho%'");
$sth->execute();    

$sth = $pdo->prepare("DELETE from arquivos WHERE arq_caminho like '$caminho%'");
$sth->execute();

$sth = $pdo->prepare("DELETE from Tbl_pastas WHERE local_pasta like '$caminho%'");
$sth->execute();

$sth = $pdo->prepare("DELETE from Tbl_usuario WHERE Id_usuario = $usuario");
$sth->execute();

$sth=$pdo->prepare("UPDATE chaves SET dono_chave = NULL WHERE dono_chave = :dono  ");
$sth->bindValue(":dono", $email);
$sth->execute();

delTree($apagar);
header('LOCATION: index.php');

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
