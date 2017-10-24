<?php
include_once 'adm_auth.php';

//Include das classes via autoload
include_once 'autoload.php';

//Caso tenha sido feito um POST da página
if($_POST){
   
    //Cria o Controle desta View (página)
    $usuarioControle = new ControllerUsuario();

    //Passa o POST desta View para o Controle
   
    $usuarioControle->setVisao($_POST);
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id_usario"])){
        $retorno = $usuarioControle->controleAcao("inserir");
        echo  '<script> '
                . 'alert("Cadastro de usuário realizado com sucesso!");'
                . ' window.location.href="painel_adm.php";'
            . '</script>';
        exit; //encerra o processamento da página para o Ajax
    }else{
        $retorno = $usuarioControle->controleAcao("alterar");
        echo $retorno;
        exit; //encerra o processamento da página para o Ajax
    }
     
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $usuarioControle = new ControllerImagem();
    //Passa o GET desta View para o Controle
    $usuarioControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o imagem do banco de dados
                $retorno=$usuarioControle->controleAcao("excluir");
                echo $retorno;                
                exit; //encerra o processamento da página para o Ajax
            }elseif ($_GET["op"] == "alt") {
                // O $imagemAlteracao será utilizado no formulário para preencher os dados do imagem 
                // que foram pesquisados no banco de dados
                $imagemAlteracao = $imagemControle->controleAcao("listarUnico",$_GET["id"]);
                echo json_encode($imagemAlteracao);
                exit; //encerra o processamento da página para o Ajax
                
            }
        }    

    }  /*if(isset($_GET["pesquisa"])){
        
        
        $pesquisa = $_GET["pesquisa"];
        $pagina_atual= intval($_GET["pagina_atual"]);
        // Calcula a linha inicial da consulta  
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
        
        exit;  //encerra o processamento da página para o Ajax
    }  */
}

include_once '../view/head.php';
?>
<?php 
require_once '../view/menu.php';
?>
<body>
            <div class="container">
                <div class="row" style="padding-top: 70px">
		<div class="col-md-8 col-md-offset-2">
    		<div class="panel panel-default">
<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Cadastrar novo usuário </legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome">Nome</label>  
  <div class="col-md-4">
  <input id="nome" name="nome" type="text" placeholder="ex:Carlos do Amaral " class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cpf">CPF</label>  
  <div class="col-md-4">
  <input id="cpf" name="cpf" type="text" placeholder="ex:034.145.820-09" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="exemplo@exemplo.com" class="form-control input-md" required="">
    
  </div>
</div>
<!-- Multiple Checkboxes -->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipo">Qual o tipo de usuário </label>
  <div class="col-md-4">
  <div class="radio">
    <label for="tipo-0">
      <input type="radio" name="tipo" id="area-0" value="Servidor">
      Servidor
    </label>
	</div>
  <div class="radio">
    <label for="tipo-1">
      <input type="radio" name="tipo" id="area-1" value="Aluno">
      Aluno
    </label>
	</div>
  <div class="radio">
    <label for="tipo-2">
      <input type="radio" name="tipo" id="area-2" value="Comunidade externa">
      Comunidade externa
    </label>
	</div>
  <div class="radio">
    <label for="tipo-3">
      <input type="radio" name="tipo" id="area-3" value="  Outro">
      Outro
    </label>
	</div>
  </div>
</div>
<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="senha">Senha</label>
  <div class="col-md-4">
    <input id="senha" name="senha" type="password" placeholder="*************" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cornfirmasenha">Confirme sua senha</label>
  <div class="col-md-4">
    <input id="cornfirmasenha" name="cornfirmasenha" type="password" placeholder="***********" class="form-control input-md" required="">
    <span class="help-block">A senha deve ser exatamente igual a que foi digitada anteriormente.</span>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirmar"></label>
  <div class="col-md-8">
    <button id="confirmar" name="confirmar" class="btn btn-success">Cadastrar novo Usuário </button>
    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
  </div>
</div>

</fieldset>
</form>
                </div></div></div></div>
				<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>
</body>
