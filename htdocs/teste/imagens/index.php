<?php
// Abrindo uma imagem PNG
$img = imagecreatefromjpeg('convite.jpeg');
// Obtendo o tamanho do arquivo de imagem
$tamanho = getimagesize($img);
echo $tamanho;