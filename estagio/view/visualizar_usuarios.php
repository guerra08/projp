<?php
include_once 'adm_auth.php';

include_once 'head.php';
include_once 'menu.php';
include_once 'autoload.php';
?>
<?php
$usuarioController= new Controllerusuario();

if($_GET){
  if(isset($_GET['op']) && $_GET['op'] == 'conf'){
    if(isset($_GET['id_usuario'])){
      $usuarioController->setVisao($_GET);
      $retorno = $usuarioController->controleAcao('confirmarCadastro');
      if($retorno === true){
        echo '<script> '
                . 'alert("Cadastro de usuário confirmado com sucesso!");'
                . ' window.location.href="visualizar_usuarios.php";'
            . '</script>';
      }
    }
  }
  elseif(isset($_GET['op']) && $_GET['op'] == 'del'){
    if(isset($_GET['id_usuario'])){
      $usuarioController->setVisao($_GET);
      $retorno = $usuarioController->controleAcao('excluir');
      if($retorno === true){
        echo '<script> '
                . 'alert("Solicitação de usuário deletada com sucesso!");'
                . ' window.location.href="visualizar_usuarios.php";'
            . '</script>';
      }
    }
  }
}

$tabela='';
    $usuarios = $usuarioController->controleAcao('listarTodos');
    foreach($usuarios->usuarios as $id => $usuario){
		if($usuario['status'] != 0){

   $tabela.=' 
      <tr>
            <td>'.$usuario['id_usuario'].'</td>
            <td>'.$usuario['nome'].'</td>
            <td>'.$usuario['email'].'</td>
            <td>'.$usuario['cpf'].'</td>
                <th><a href"#" onclick="vermaisusuario('.$usuario['id_usuario'].')" class="btn btn-success">Ver Mais </a></th>
         </tr>
   ' ;  
		}
}
?>
<script>
    function vermaisusuario(id){
        $.ajax({
            url: 'ajax.php?id='+id,
            success: function(data) {
                swal({
                 title: 'Dados do Usuário',
                 text: data,
                 html: true,
                 confirmButtonColor: '#987463',
  
                });
            }
        });
    
    }   
    function vermaisadm(id){
        $.ajax({
            url: 'ajax_adm.php?id='+id,
            success: function(data) {
                swal({
                 title: 'Dados do Usuário',
                 text: data,
                 html: true,
                 confirmButtonColor: '#987463',
  
                });
            }
        });
    
    }   

  </script>
<div class="col-md-9">
     <h2>Tabela de Usuários</h2>
        <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Mais informações</th>
      </tr>
      </thead>
      <tbody>
          <?php
          echo $tabela;
          ?>
      </tbody>
        </table>
<hr>
      <?php
 
    //Imprime uma String randônica com 20 caracteres

$tabeladm='';

    $admController= new Controlleradministrador();
    $adms = $admController->controleAcao('listarTodos');
    
    foreach($adms->administradores as $id =>  $adm){  
   $tabeladm.=' 
      <tr>
            <td>'.$adm['id_adm'].'</td>
            <td>'.$adm['nome'].'</td>
            <td>'.$adm['email'].'</td>
            <td>'.$adm['area'].'</td>
          <th><a href"#" onclick="vermaisadm('.$adm['id_usuario'].')" class="btn btn-success">Ver Mais </a></th>
          
         </tr>
   ' ;  
}
?>
          <h2>Tabela de Administradores</h2>

        <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Área</th>
        <th>Ação</th>
        
      </tr>
      </thead>
      <tbody>
          <?php
          echo $tabeladm;
          
          ?>
      </tbody>
        </table>
	  <hr>
	  <?php 
	  
	  $tablesolicitacoes = '';
	  
	  $usuarios = $usuarioController->controleAcao('listarSolicitacoes');
	  foreach($usuarios as $usuario){  
	  
		$tablesolicitacoes.=' 
		<tr>
            <td>'.$usuario['id_usuario'].'</td>
            <td>'.$usuario['nome'].'</td>
            <td>'.$usuario['email'].'</td>
            <td>'.$usuario['cpf'].'</td>
				
           <th><a href = "visualizar_usuarios.php?op=conf&id_usuario='.$usuario['id_usuario'].'" id="vermais" class="btn btn-success">Confirmar Solicitação</a></th>
           <th><a href = "visualizar_usuarios.php?op=del&id_usuario='.$usuario['id_usuario'].'" id="vermais" class="btn btn-danger">Excluir Solicitação</a></th>
          
         </tr>
		' ;  
		}
		?>
	  
	  
          <h2>Tabela de Solicitações</h2>

        <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Ação</th>
        
      </tr>
      </thead>
      <tbody>
          <?php
          echo $tablesolicitacoes;
          
          ?>
      </tbody>
        </table>
		<hr>
	  </div>
	  </div>
<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>
