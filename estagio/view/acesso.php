<?php
session_start();
include_once('autoload.php');

if(isset($_SESSION['idUsuario']) && isset($_SESSION['auth'])){
	if($_SESSION['auth'] === true){
		$userControle = new Controllerusuario();
		$adminControle = new Controlleradministrador();
		$searchAdmin = $adminControle->controleAcao("listarUnicoPorUser", $_SESSION['idUsuario']);
		if(!empty($searchAdmin)){
			$_SESSION['id_adm'] = $searchAdmin['id_adm'];
			$_SESSION['admin_access'] = true;
			header('Location: painel_adm.php');
		}
		else{
			header('Location: repositorio.php');
		}
		
	}
}