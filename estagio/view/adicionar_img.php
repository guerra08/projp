<?php

include_once 'user_auth.php';

//Include das classes via autoload
include_once 'autoload.php';

//print_r ($_SESSION);

//Caso tenha sido feito um POST da página
if($_POST){
    
    //Cria o Controle desta View (página)
    $imagemControle = new ControllerImagem();

    //Passa o POST desta View para o Controle
    if(isset($_SESSION['admin_access']) && $_SESSION['admin_access'] == 1){
    	$_POST['status'] = 1;
	}
	else{
		$_POST['status'] = 0;
	}
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id_imagem"])){
        $_POST['imagem'] = $_FILES['arquivo'];
        $imagemControle->setVisao($_POST);
        $retorno = $imagemControle->controleAcao("inserir");
       
        if($retorno === true){
         echo  '<script> '
                . 'alert("Sua imagem foi inserida com sucesso!'
              . 'Você será redirecionado para a página de repositório de imagem ao clicar em OK");'
                . ' window.location.href="repositorio.php";'
            . '</script>';
        }
        exit; //encerra o processamento da página para o Ajax
    }else{
        $imagemControle->setVisao($_POST);
        $retorno = $imagemControle->controleAcao("alterar");
         echo  '<script> '
        . 'alert("Sua imagem foi alterada com sucesso!'
      . 'Você será redirecionado para a página de repositório de imagem ao clicar em OK");'
        . ' window.location.href="repositorio.php";'
    . '</script>';
        exit; //encerra o processamento da página para o Ajax
    }
     
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $imagemControle = new ControllerImagem();
    //Passa o GET desta View para o Controle
    $imagemControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o imagem do banco de dados
                $retorno=$imagemControle->controleAcao("excluir");
                echo $retorno;                
                exit; //encerra o processamento da página para o Ajax
            }elseif ($_GET["op"] == "alt") {
                // O $imagemAlteracao será utilizado no formulário para preencher os dados do imagem 
                // que foram pesquisados no banco de dados
                $imagemAlteracao = $imagemControle->controleAcao("listarUnico",$_GET["id"]);
                print_r($imagemAlteracao);
                
                
            }
        }    

    }  if(isset($_GET["pesquisa"])){
        
        
        $pesquisa = $_GET["pesquisa"];
        $pagina_atual= intval($_GET["pagina_atual"]);
        /* Calcula a linha inicial da consulta */  
        $qtd_registros_pagina = 3;
        $linha_inicial = ($pagina_atual -1) * $qtd_registros_pagina; 
        
        
        $params = new stdClass();
        $params->linha_inicial = $linha_inicial;
        $params->qtd_registros_pagina = $qtd_registros_pagina;
        $params->pesquisa = $pesquisa;
         
         
        // O $imagens será utilizado para preencher a tabela com os imagens cadastrados  
        $imagens = array();
        $imagens = $imagemControle->controleAcao("listarTodos",$params);
        if(!empty($imagens)){
            echo json_encode($imagens);           
                
        }   
        
        exit; //encerra o processamento da página para o Ajax
    }  
}
include_once '../view/head.php';
?>
<?php 
if(isset($_SESSION['admin_access']) && $_SESSION['admin_access'] == 1){
	require_once '../view/menu.php';
}
?>
<body>
            <div class="container">
                <div class="row" style="padding-top: 70px">
		<div class="col-md-8 col-md-offset-2">
    		<div class="panel panel-default">
<form class="form-horizontal" id="formulario" name="formulario" action="adicionar_img.php" method="POST"  enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Adicionar fotografias</legend>
 <?php
    if(!empty($imagemAlteracao)){
        echo "<input type='hidden' name='id_imagem' value='".$imagemAlteracao['id_imagem']."'>";
    }
   ?>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-4">
  <input id="nome" name="nome" type="text" placeholder="Exemplo: Festa junina" class="form-control input-md" required=""
   <?php
    if(!empty($imagemAlteracao)){
        echo "value=".$imagemAlteracao['nome']."";
    }
   ?>
         >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="descricao">Descrição</label>  
  <div class="col-md-5">
  <textarea id="descricao" name="descricao" class="form-control input-md" required=""><?php
    if(!empty($imagemAlteracao)){
        echo $imagemAlteracao['descricao'];
    }?></textarea>
  <span class="help-block">Escreva características específicas da nova imagem</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="data">Data em que a imagem foi tirada</label>  
  <div class="col-md-4">
  <input id="data" name="data_imagem" type="date" placeholder="" class="form-control input-md"
         <?php
    if(!empty($imagemAlteracao)){
        echo "value=".$imagemAlteracao['data_imagem']."";
    }
   ?>
         >
  <span class="help-block">Escreva a data que o arquivo possui</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="autoria">Autoria da imagem</label>  
  <div class="col-md-4">
  <input id="autoria" name="autoria" type="text" placeholder="Exemplo: Marcos Dias" class="form-control input-md"
         <?php
    if(!empty($imagemAlteracao)){
        echo "value=".$imagemAlteracao['autoria']."";
    }
   ?>
         >
  <span class="help-block">Escreva quem tirou ou disponibilizou a fotografia</span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="categoria">Selecione uma categoria para inserir a imagem </label>
  <div class="col-md-4">
    <select id="sel_categoria" name="categoria" class="form-control">
<option disabled selected>Selecione uma categoria</option>
    <?php
    $categoriaController= new ControllerCategoria();
    $categorias = $categoriaController->controleAcao('listarTodos');
    foreach($categorias->categorias as $id => $categoria){
      $v = '';
      if(!empty($imagemAlteracao) && $imagemAlteracao['categoria']==$categoria['id_categoria']){
        $v = ' selected';
      }
        echo  '<option value="'.$categoria['id_categoria'].'"'.$v.'>'.$categoria['nome'].'</option>';
    }
                        
                         //   $categoriaControle = new ControllerCategoria();
                           // $categorias = $categoriaControle->controleAcao("listarTodos");
                          //  foreach ($categorias as $key => $categoria) {
                            //  echo '<option value="'.$categoria->getId_categoria[0].'" '.((isset($imagemAlteracao) && $imagemAlteracao->getId_categoria() == $categoria->getId_categoria[0]) ? 'selected' : "").'>'.$categoria->getId_categoria[1].'</option>';
      ?>                    
                        
    </select>
  </div>
</div>

<!-- File Button --> 
<?php
if(empty($imagemAlteracao)){
?>
<div class="form-group">
  <label class="col-md-4 control-label" for="arquivo"></label>
  <div class="col-md-4">
    <input id="arquivo" name="arquivo" class="input-file" type="file">
  </div>
</div>
<?php
}
else{
  ?>
<div class="form-group">
  <label class="col-md-4 control-label" for="autoria">Imagem atual</label>  
  <div class="col-md-4">
  <img src="<?php echo $imagemAlteracao['imagem']; ?>" width='100%'>  
  </div>
</div>
  <?php
}
?>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirmar"></label>
  <div class="col-md-8">
    <button id="confirmar" name="confirmar" class="btn btn-success">Inserir nova fotografia </button>
    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
  </div>
</div>

</fieldset>
</form>
                </div>
                </div>
                </div>
            </div>
   <footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

</body>
