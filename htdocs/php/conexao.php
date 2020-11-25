<?php
$espacototal=16000000000; //em byts
    try
    {
        $pdo = new PDO('mysql:host=sql210.unaux.com;dbname=unaux_27096342_dossier;charset=utf8', 'unaux_27096342', 'Fe&100902');
    } catch (Exception $e) 
    {
        echo $e->getMessage() . "</p>";
        die ("Não foi possivel estabelecer a conecxão com o banco de dados.");
    }
