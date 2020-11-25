<?php 
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);
$x=0;
$qtd = 0;
$cont = 0;
$pode = true;
unlink("chaves.chv");

$msg = "INSERT INTO `chaves` (`num_chave`) VALUES";
$fp = fopen("chaves.chv", "a");
$escreve = fwrite($fp, $msg);
fclose($fp);


while($x != $post['qtd']){
    $chave = gerar_chave(10, true, true, true, true);
    
    $tot = strlen ($chave);
    $y=0;
    $val=0;
    while ($y<$tot){
        $val=$val+ord($chave[$y]);
        $y++;
    }
    if (($val>='1000')&&($val<='1050')){
        $teste[$qtd] = $chave;
        $w =0;
        $pode = true;
        while ($w != $qtd){
            if ($teste[$qtd] == $teste[$w]){
                echo 'repetiu<br>';
                $pode = false;
            }
            $w++;
        }
        if ($pode == true){
            $x++;
            //INSERT INTO `chaves` (`Id_chave`, `num_chave`) VALUES ('a'), ('b');
            //echo 'chave: ' . $chave . '<br>';
            $msg = " ('".$teste[$qtd]."'),";
            $fp = fopen("chaves.chv", "a");
            $escreve = fwrite($fp, $msg);
            fclose($fp);
            $qtd++;
        }
    }
} 

echo 'arquivo pronto para download <a href="chaves.chv" download>Download</a>';


function gerar_chave($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
    $senha = '';
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";
    $mi = "abcdefghijklmnopqrstuvyxwz";
    $nu = "0123456789";
    $si = "!@#$%&*()_+-=";
    
    if ($maiusculas){
        $senha .= str_shuffle($ma);
    }
    if ($minusculas){
        $senha .= str_shuffle($mi);
    }
    if ($numeros){
        $senha .= str_shuffle($nu);
    }
    if ($simbolos){
        $senha .= str_shuffle($si);
    }
    return substr(str_shuffle($senha),0,$tamanho);
}
?>