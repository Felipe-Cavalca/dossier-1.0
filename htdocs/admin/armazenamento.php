<?php
/*
$path = "../php/arquivos/";
$diretorio = dir($path);
echo '<p>';
while ($arquivo = $diretorio->read()) {
    if (($arquivo == '.') || ($arquivo != '..')) {
      if (($arquivo != '.') || ($arquivo == '..')) {
        //<a href="' . $path . $arquivo . '">' . $arquivo . '</a>
        $bytestotal = GetDirectorySize($path.$arquivo);
        echo $arquivo . ' - ' . $bytestotal . ' bytes<br>';
      }
    }
}
echo '</p>';
$diretorio->close();

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
*/