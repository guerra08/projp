<?php
include_once '../view/autoload.php';

// Instancia a Classe Zip
$zip = new ZipArchive();
// Cria o Arquivo Zip, caso não consiga exibe mensagem de erro e finaliza script
if(isset($_GET['id_categoria'])){

	if($zip->open('categoria'.$_GET['id_categoria'].'.zip', ZIPARCHIVE::CREATE) == TRUE){
		// Insere os arquivos que devem conter no arquivo zip
		$controleImagem= new ControllerImagem();
		$params = new stdClass;
		$params->pesquisa = $_GET['id_categoria'];
		$imagens = $controleImagem->controleAcao('listarTodos', $params);					
		foreach($imagens as $id => $img){
			$zip->addFile($img['imagem'], $img['imagem']);
		}
		echo 'Arquivo criado com sucesso.';
	}
	else{
		exit('O Arquivo não pode ser criado.');
	}

//UNLINK

	// Fecha arquivo Zip aberto
	$zip->close();
}
?>