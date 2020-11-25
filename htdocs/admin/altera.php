<?php
session_start();
if ($_SESSION['Login']['tipo'] == 'admin') {
    include '../php/conexao.php';
} else {
    header('Location: ../');
    die;
}

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("SELECT * from Tbl_usuario WHERE Id_usuario =:id");
$sth->bindValue(":id", $id);
$sth->execute();
foreach ($sth as $res):
    extract($res);
    $tipo = $Tipo_usuario;
endforeach;

if ($tipo == 'padrão'){
    $sth = $pdo->prepare("UPDATE `Tbl_usuario` SET `Tipo_usuario` = 'admin' WHERE `Tbl_usuario`.`Id_usuario` = :id");
    $sth->bindValue(":id", $id);
    $sth->execute();
}
else if ($tipo == 'admin'){
    $sth = $pdo->prepare("UPDATE `Tbl_usuario` SET `Tipo_usuario` = 'padrão' WHERE `Tbl_usuario`.`Id_usuario` = :id");
    $sth->bindValue(":id", $id);
    $sth->execute();
}
header('LOCATION: index.php');