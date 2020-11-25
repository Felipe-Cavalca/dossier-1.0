<?php 
session_start();
include 'conexao.php';
$post= filter_input_array(INPUT_POST, FILTER_DEFAULT);

$sth=$pdo->prepare("UPDATE chaves SET dono_chave = :dono WHERE num_chave = :num");
$sth->bindValue(":dono", $post['email']);
$sth->bindValue(":num", $_SESSION['chave']);
$sth->execute();

$senha_criptografada = MD5($post['senha']);
$Dados = array(
    'Nome_usuario'=> $post['Nome_usuario'],
    'Sobrenome_usuario'=> $post['Sobrenome_usuario'],
    'Email_usuario'=> $post['email'],
    'Senha_usuario'=> $senha_criptografada,
    'Pasta_usuario'=> "arquivos/" . $post['email'],
    'Chave_usuario'=> $_SESSION['chave'],
    'Tipo_usuario' => 'padrão',
);
        
$Fields = implode(', ', array_Keys($Dados));
$Places = ':' . implode(', :', array_keys($Dados));
$Tabela = 'Tbl_usuario';
$Create = "INSERT INTO {$Tabela} ({$Fields}) VALUES ({$Places})";
$sth = $pdo->prepare($Create);
$sth->execute($Dados);

mkdir('arquivos/'.$post['email'] ,0777);

$dir = 'arquivos/'.$post['email'].'/';
$arq = 'ApEnAsPaRaNãOaPaGarApAsTa';

//cria arquivo
$arquivo = fopen($dir.$arq,'w');
fclose($arquivo);

$_SESSION['Login']['email'] = $post['email'];
$_SESSION['Login']['senha'] = $senha_criptografada;
$_SESSION['Login']['caminho'] = "arquivos/" . $post['email'] . "/";
$_SESSION['Login']['tipo'] = 'padão';

//echo 'sucesso ' . $senha_criptografada;

//log
$data = date('d-m-Y-h-i-s');
$msg = $data . ' - ' . $_SESSION['Login']['email'] . ' se cadastrou no sistema
';
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $msg);
// Fecha o arquivo
fclose($fp);

header('Location: ../home.php');

