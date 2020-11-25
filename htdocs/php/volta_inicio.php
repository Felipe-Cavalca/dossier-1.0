<?php
session_start();

$_SESSION['Login']['caminho'] = 'arquivos/' .$_SESSION['Login']['email'] . '/';
//$_SESSION['Login']['caminho'] = $_SESSION['Login']['anterior'];

   header('LOCATION: ../home.php');

?>
