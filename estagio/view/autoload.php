<?php
function autoload($classe)
{
    if(file_exists( "../model/vo/{$classe}.class.php" )) {
        include_once "../model/vo/{$classe}.class.php";
    }elseif(file_exists( "../model/dao/{$classe}.class.php" )) {
        include_once "../model/dao/{$classe}.class.php";
    }elseif(file_exists( "../controller/{$classe}.class.php" )) {
        include_once "../controller/{$classe}.class.php";
    }elseif(file_exists( "../util/{$classe}.class.php" )) {
        include_once "../util/{$classe}.class.php";
    }elseif(file_exists( "../{$classe}.class.php" )) {
        include_once "../{$classe}.class.php";
    }
    
}

spl_autoload_register("autoload");