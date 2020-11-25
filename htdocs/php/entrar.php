<?php
session_start();

include 'conexao.php';

$nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);

$_SESSION['Login']['anterior'] = $_SESSION['Login']['caminho'];
$_SESSION['Login']['caminho'] = $_SESSION['Login']['caminho']. $nome .'/';

   header('LOCATION: ../home.php');

echo $nome;

?>
