<?php
include_once 'adm_auth.php';

include_once 'head.php';
include_once 'menu.php';
include_once 'autoload.php';

$comentarioController= new ControllerComentario();

if($_GET){
  if(isset($_GET['op']) && $_GET['op'] == 'conf'){
  	if(isset($_GET['id_comentario'])){
  		$_GET['status'] = 1;
  		$comentarioController->setVisao($_GET);
  		$retorno = $comentarioController->controleAcao("confirmar");
  	}
  }
}

$tabela='';
    $comentarios = $comentarioController->controleAcao('listarTodos');
    foreach($comentarios->comentarios as $id => $comentario){


    $tabela.=' 
      <tr>
            <td>'.$comentario['id_comentario'].'</td>
            <td>'.$comentario['id_imagem'].'</td>
            <td>'.$comentario['comentario'].'</td>
            <td>'.$comentario['autor'].'</td>
            <td>'.$comentario['data'].'</td>
            <td>'.$comentario['status'].'</td>
         </tr>
   ' ;  
}

$tabelaPendente='';

$comentarios = $comentarioController->controleAcao('listarTodos');
    foreach($comentarios->comentarios as $id => $comentario){
    if($comentario['status'] == 0){

    $tabelaPendente.=' 
      <tr>
            <td>'.$comentario['id_comentario'].'</td>
            <td>'.$comentario['id_imagem'].'</td>
            <td>'.$comentario['comentario'].'</td>
            <td>'.$comentario['autor'].'</td>
            <td>'.$comentario['data'].'</td>
            <td>'.$comentario['status'].'</td>
            <td><a href = "visualizar_comentarios?op=conf&&id_comentario='.$comentario["id_comentario"].'">Confirmar</a></td>
         </tr>
   ' ;  
  }
}
?>
<div class="col-sm-10">
     <h2>Tabela de Comentarios</h2>
        <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Imagem</th>
        <th>Comentario</th>
        <th>Autor</th>
        <th>Data</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
          <?php
          echo $tabela;
          ?>
      </tbody>
        </table>

     <h2>Tabela de Pendências</h2>
        <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Imagem</th>
        <th>Comentario</th>
        <th>Autor</th>
        <th>Data</th>
        <th>Status</th>
        <th>Ação</th>
      </tr>
      </thead>
      <tbody>
          <?php
          echo $tabelaPendente;
          ?>
      </tbody>
        </table>
</div>
</div>
 <footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>
