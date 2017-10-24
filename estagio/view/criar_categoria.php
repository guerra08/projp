<?php
include_once 'adm_auth.php';

//Include das classes via autoload
include_once 'autoload.php';
include_once '../view/head.php';
//Caso tenha sido feito um POST da página
if($_POST){
   
    //Cria o Controle desta View (página)
    $categoriaControle = new ControllerCategoria();

    //Passa o POST desta View para o Controle
   
    $categoriaControle->setVisao($_POST);
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id_categoria"])){
        $retorno = $categoriaControle->controleAcao("inserir");
      echo  '<script> '
                . 'alert("Sua categoria foi criada com sucesso.'
              . 'Você será redirecionado para o painel de administrador ao clicar em OK");'
                . ' window.location.href="painel_adm.php";'
            . '</script>';
            
        exit; //encerra o processamento da página para o Ajax
    }else{
        $retorno = $categoriaControle->controleAcao("alterar");
        echo $retorno;
        exit; //encerra o processamento da página para o Ajax
    }
     
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $categoriaControle = new Controllercategoria();
    //Passa o GET desta View para o Controle
    $categoriaControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o categoria do banco de dados
                $retorno=$categoriaControle->controleAcao("excluir");
                echo $retorno;                
                exit; //encerra o processamento da página para o Ajax
            }elseif ($_GET["op"] == "alt") {
                // O $categoriaAlteracao será utilizado no formulário para preencher os dados do categoria 
                // que foram pesquisados no banco de dados
                $categoriaAlteracao = $categoriaControle->controleAcao("listarUnico",$_GET["id"]);
                echo json_encode($categoriaAlteracao);
                exit; //encerra o processamento da página para o Ajax
                
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
        $categorias = array();
        $categorias = $categoriaControle->controleAcao("listarTodos",$params);
        if(!empty($categorias)){
            echo json_encode($categorias);           
                
        }   
        
        
    } 
    
}

?>
<?php 
require_once '../view/menu.php';
?>
<body>
            <div class="container">
                <div class="row" style="padding-top: 70px">
		<div class="col-md-8 col-md-offset-2">
    		<div class="panel panel-default">
<form class="form-horizontal" id="formulario" name="formulario" action="" method="POST"  enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Nova Categoria</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-4">
  <input id="nome" name="nome" type="text" placeholder="Exemplo: Festa junina" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="descricao">Descrição</label>  
  <div class="col-md-5">
  <textarea name = "descricao" placeholder="Digite a descrição da categoria" class="form-control input-md" required=""></textarea>
  <span class="help-block">Escreva características específicas da nova categoria</span>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="confirmar"></label>
  <div class="col-md-8">
    <button id="confirmar" name="confirmar" class="btn btn-success">Criar nova categoria </button>
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


