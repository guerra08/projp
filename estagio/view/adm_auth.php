<?php

session_start();

if(!isset($_SESSION['auth'])){
	session_destroy();
	header('Location: index.php');
};

if(isset($_SESSION['auth'])){
	if(!isset($_SESSION['id_adm'])){
		session_destroy();
		header('Location: index.php');
	}
	elseif(isset($_SESSION['id_adm'])){
		if(!isset($_SESSION['admin_access']) || $_SESSION['admin_access'] !== true){
			session_destroy();
			header('Location: index.php');
		}
	}
}

if(isset($_GET['logout']) && $_GET['logout'] == 1){
	session_destroy();
	header('Location: index.php');
}

