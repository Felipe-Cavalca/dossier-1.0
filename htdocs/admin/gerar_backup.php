<?php

session_start();
if ($_SESSION['Login']['tipo'] == 'admin') {
    
} else {
    header('Location: ../');
    die;
}

ob_start();
//Receber os dados do formulário
$servidor = 'sql110.unaux.com';
$usuario = 'unaux_26430904';
$senha = 'n5wd3zbj';
$dbname = 'unaux_26430904_dossier';

//Criar a conexao com BD
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

//Incluir o arquivo que gerar o backup

//Ler as tabelas
$result_tabela = "SHOW TABLES";
$resultado_tabela = mysqli_query($conn, $result_tabela);
while($row_tabela = mysqli_fetch_row($resultado_tabela)){
	$tabelas[] = $row_tabela[0];
}
//var_dump($tabelas);

$result = "";
foreach($tabelas as $tabela){
	//Pesquisar o nome das colunas
	$result_colunas = "SELECT * FROM " . $tabela;
	$resultado_colunas = mysqli_query($conn, $result_colunas);
	$num_colunas = mysqli_num_fields($resultado_colunas);
	//echo "Quantidade de colunas na tabela: ". $tabela. " - " . $num_colunas . "<br>";
	
	//Criar a intrução para apagar a tabela caso a mesma exista no BD
	$result .= 'DROP TABLE IF EXISTS '.$tabela.';';
	
	//Pesquisar como a coluna é criada
	$result_cr_col = "SHOW CREATE TABLE " . $tabela;
	$resultado_cr_col = mysqli_query($conn, $result_cr_col);
	$row_cr_col = mysqli_fetch_row($resultado_cr_col);
	//var_dump($row_cr_col);
	$result .= "\n\n" . $row_cr_col[1] . ";\n\n";
	//echo $result;
	
	//Percorrer o array de colunas
	for($i = 0; $i < $num_colunas; $i++){
		//Ler o valor de cada coluna no bando de dados
		while($row_tp_col = mysqli_fetch_row($resultado_colunas)){
			//var_dump($row_tp_col);
			//Criar a intrução da Query para inserir os dados
			$result .= 'INSERT INTO ' . $tabela . ' VALUES(';
			
			//Ler os dados da tabela
			for($j = 0; $j < $num_colunas; $j++){
				//addslashes — Adiciona barras invertidas a uma string
				$row_tp_col[$j] = addslashes($row_tp_col[$j]);
				//str_replace — Substitui todas as ocorrências da string \n pela \\n
				$row_tp_col[$j] = str_replace("\n", "\\n", $row_tp_col[$j]);
				
				if(isset($row_tp_col[$j])){
					if(!empty($row_tp_col[$j])){
						$result .= '"' . $row_tp_col[$j].'"';
					}else{
						$result .= 'NULL';
					}
				}else{
					$result .= 'NULL';
				}
				
				if($j < ($num_colunas - 1)){
					$result .=',';
				}				
			}
			$result .= ");\n";
		}
	}
	$result .= "\n\n";
	//echo $result;
}

//Criar o diretório de backup
$diretorio = 'backup/';
if(!is_dir($diretorio)){
	mkdir($diretorio, 0777, true);
	chmod($diretorio, 0777);
}

//Nome do arquivo de backup
//$data = date('Y-m-d-h-i-s');
$data = date('d-m-Y-h-i-s');
$nome_arquivo = $diretorio . "db_backup_".$data;
//echo $nome_arquivo;

$handle = fopen($nome_arquivo . '.sql', 'w+');
fwrite($handle, $result);
fclose($handle);

//Montagem do link do arquivo
$download = $nome_arquivo . ".sql";

//Adicionar o header para download
/*
if(file_exists($download)){
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=\"" . basename($download) . "\";");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($download));
	readfile($download);
}
*/


$arquivo = $diretorio . "arq_backup_".$data.'.zip';

if (file_exists($arquivo)) unlink(realpath($arquivo)); 

$diretorio = "../php/arquivos/";
$rootPath = realpath($diretorio);

$zip = new ZipArchive();
$zip->open($arquivo, ZipArchive::CREATE | ZipArchive::OVERWRITE);

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    if (!$file->isDir())
    {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        $zip->addFile($filePath, $relativePath);
    }
}

$zip->close();

   //$arquivo = 'backup.zip';
   /*
   if(isset($arquivo) && file_exists($arquivo)){
      switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){ 
         case "pdf": $tipo="application/pdf"; break;
         case "exe": $tipo="application/octet-stream"; break;
         case "zip": $tipo="application/zip"; break;
         case "doc": $tipo="application/msword"; break;
         case "xls": $tipo="application/vnd.ms-excel"; break;
         case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
         case "gif": $tipo="image/gif"; break;
         case "png": $tipo="image/png"; break;
         case "jpg": $tipo="image/jpg"; break;
         case "mp3": $tipo="audio/mpeg"; break;
         case "php": // deixar vazio por seurança
         case "htm": // deixar vazio por seurança
         case "html": // deixar vazio por seurança
      }
      header("Content-Type: ".$tipo);
      header("Content-Length: ".filesize($arquivo));
      header("Content-Disposition: attachment; filename=".basename($arquivo));
      readfile($arquivo);
      exit;
   }
   */
   
   header('LOCATION: index.php#backup');
?>