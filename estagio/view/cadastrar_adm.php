<?php

include_once 'adm_auth.php';

//Include das classes via autoload
include_once 'autoload.php';

//Caso tenha sido feito um POST da página
if($_POST){
   
    //Cria o Controle desta View (página)
    $admControle = new ControllerAdministrador();

    //Passa o POST desta View para o Controle
   
    $admControle->setVisao($_POST);
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id_usario"])){
        $retorno = $admControle->controleAcao("inserir");
		if($retorno === true){
			echo  '<script> '
					. 'alert("Cadastro realizado com sucesso!'
				  . 'Você será redirecionado para a página principal ao clicar em OK");'
					. ' window.location.href="index.php";'
				. '</script>';
			exit; //encerra o processamento da página para o Ajax
		}
		else{
			'<script> '
					. 'alert("Erro no cadastro.'
				  . 'Você será redirecionado para a página de cadastro de administrador");'
					. ' window.location.href="index.php";'
				. '</script>';
		}
    }else{
        $retorno = $admControle->controleAcao("alterar");
        echo $retorno;
        exit; //encerra o processamento da página para o Ajax
    }
     
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $admControle = new ControllerAdministrador();
    //Passa o GET desta View para o Controle
    $admControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o imagem do banco de dados
                $retorno=$admControle->controleAcao("excluir");
                echo $retorno;                
                exit; //encerra o processamento da página para o Ajax
            }elseif ($_GET["op"] == "alt") {
                // O $imagemAlteracao será utilizado no formulário para preencher os dados do imagem 
                // que foram pesquisados no banco de dados
                $admAlteração = $admControle->controleAcao("listarUnico",$_GET["id"]);
                echo json_encode($imagemAlteracao);
                exit; //encerra o processamento da página para o Ajax
                
            }
        }    

    }
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
                    <form  id="cadastroadm"class="form-horizontal" method="post" >
<fieldset>

<!-- Form Name -->
<legend>Cadastrar novo administrador </legend>

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
<div class="form-group">
  <label class="col-md-4 control-label" for="Area">Area de atuação</label>  
  <div class="col-md-4">
  <input id="cpf" name="area" type="text" placeholder="ex:professor" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="exemplo@exemplo.com" class="form-control input-md" required="">
    
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
    <button id="confirmar" name="confirmar" class="btn btn-success" >Cadastrar novo Administrador </button>
    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
  </div>
</div>

</fieldset>
</form>
                </div></div></div></div>
				<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>
<script>
    function init(){
          $('#cpf').mask('999.999.999-99');
          $('#cadastroadm').validate({
               rules: {
                   cpf:{required:true,verificaCPF: true}
               },
               messages:{
                   cpf:{
                      required: 'Campo de CPF obrigatório!'
                   }
               },
               submitHandler:function(form){
                   form.submit();
               }
           });
      }
      jQuery.validator.addMethod("verificaCPF", function(value, element) {
           value = value.replace('.','');
           value = value.replace('.','');
           cpf = value.replace('-','');
           while(cpf.length < 11) cpf = "0"+ cpf;
           var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
           var a = [];
           var b = new Number;
           var c = 11;
           for (i=0; i<11; i++){
               a[i] = cpf.charAt(i);
               if (i < 9) b += (a[i] * --c);
           }
           if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
           b = 0;
           c = 11;
           for (y=0; y<10; y++) b += (a[y] * c--);
           if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
           if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;
           return true;
           }, "Informe um CPF válido.");
     $(document).ready(init);
</script></body>