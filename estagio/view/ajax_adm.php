<?php

include_once 'adm_auth.php';

//Include das classes via autoload
include_once 'autoload.php';

 
$usuarioController= new Controllerusuario();
$admController= new Controlleradministrador();  
    
$tabela='';
    
    $usuarios = $usuarioController->controleAcao('listarTodos');
    foreach($usuarios->usuarios as $id => $usuario){
		if(($usuario['status'] != 0) &&($usuario['id_usuario']==$_GET['id'])){

   $tabela.=' 
            <tr>
                <td><b>Id: </b>'.$usuario['id_usuario'].'</td><br>
                <td><b>Nome: </b>'.$usuario['nome'].'</td><br>
                <td><b>Email: </b>'.$usuario['email'].'</td><br>
                <td><b>CPF: </b>'.$usuario['cpf'].'</td><br>
            </tr>
   ' ;  
		}
}
$adms = $admController->controleAcao('listarTodos');

foreach($adms->administradores as $id =>  $adm){  
    if($adm['id_usuario']==$_GET['id']){
   $tabela.=' 
      <tr>
            <td><b>Id do Administrador: </b>'.$adm['id_adm'].'</td><br>
            <td><b>Área: </b>'.$adm['area'].'</td>         
      </tr>
   ' ;  
    }

    }
echo $tabela;
