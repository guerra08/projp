<?php

session_start();

if(!isset($_SESSION['auth'])){
	session_destroy();
	header('Location: index.php');
};

if(isset($_GET['logout']) && $_GET['logout'] == 1){
	session_destroy();
	header('Location: index.php');
}