<?php

include_once 'adm_auth.php';

//Include das classes via autoload
include_once 'autoload.php';
$usuarioController= new Controllerusuario();
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
echo $tabela;