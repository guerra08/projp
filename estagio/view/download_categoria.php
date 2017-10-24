<?php
include_once '../view/autoload.php';

// Instancia a Classe Zip
$zip = new ZipArchive();
// Cria o Arquivo Zip, caso não consiga exibe mensagem de erro e finaliza script
if (isset($_GET['id_categoria'])) {
	
    if ($zip->open('../categoria'.$_GET['id_categoria'].'.zip', ZIPARCHIVE::CREATE) == true) {
        // Insere os arquivos que devem conter no arquivo zip
        $controleImagem= new ControllerImagem();
        $params = new stdClass;
        $params->pesquisa = $_GET['id_categoria'];
        $imagens = $controleImagem->controleAcao('listarTodos', $params);
        foreach ($imagens as $id => $img) {
            $zip->addFile($img['imagem'], $img['imagem']);
		}
		$zip->close();
    } else {
		exit('O Arquivo não pode ser criado.');
		$zip->close();
    }

        
    if (file_exists('../categoria'.$_GET['id_categoria'].'.zip')) {

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="categoria'.$_GET['id_categoria'].'.zip"');
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize('../categoria'.$_GET['id_categoria'].'.zip'));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Expires: 0');

		readfile('../categoria'.$_GET['id_categoria'].'.zip');
		
		unlink('../categoria'.$_GET['id_categoria'].'.zip');
    }

}
