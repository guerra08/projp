<?php
include_once 'adm_auth.php';

include_once 'head.php';
include_once 'menu.php';
include_once 'autoload.php';
?>
<?php
$imagemController= new Controllerimagem();

$imagens = $imagemController->controleAcao("listarTodos", 'unconfirmed');

if($_GET){
  if(isset($_GET['op']) && $_GET['op'] == 'conf'){
    if(isset($_GET['id_imagem'])){
      $retorno = $imagemController->controleAcao('confirmarImagem', $_GET['id_imagem']);
    }
  }
}
if(!empty($imagens)){
	foreach($imagens as $img){
		foreach($img as $imagem){
		  if($imagem['status'] == 0){
			$tabela = '<tr>
				<td>'.$imagem['id_imagem'].'</td>
				<td>'.$imagem['nome'].'</td>
				<td><img src= '.$imagem['imagem'].' width="auto" height="100"></td>
				<td>'.$imagem['descricao'].'</td>
				<td>'.$imagem['data_insercao'].'</td>
				<td>'.$imagem['autoria'].'</td>
				<td>'.$imagem['data_imagem'].'</td>
					<th><a href = "confirmacaoImagens.php?op=conf&id_imagem='.$imagem['id_imagem'].'" id="vermais" name="vermais" class="btn btn-success">Confirmar Imagem</a></th>
			 </tr>
	   ' ;
		  }
		}
	}
}	


?>

 <div class="col-md-10">
     <h2>Tabela de Fotos não confirmadas</h2>
        <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Imagem</th>
        <th>Descrição</th>
        <th>Data de inserção</th>
        <th>Autoria</th>
        <th>Data da imagem</th>
        <th>Ação</th>
      </tr>
      </thead>
      <tbody>
          <?php
          if(isset($tabela)){
            echo $tabela;
            }
          ?>
      </tbody>
        </table>
 </div>
 </div>
<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

