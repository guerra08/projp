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
                    <form  id="cadastroadm"class="form-horizontal" method="post">
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
    <button id="confirmar" name="confirmar" class="btn btn-success">Cadastrar novo Administrador </button>
    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
  </div>
</div>

</fieldset>
</form>
                </div></div></div></div>
				<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

<script type="text/javascript">
		$.validator.setDefaults( {
			submitHandler: function () {
				alert( "submitted!" );
			}
		} );

		$( document ).ready( function () {
			$( "#cadastroadm" ).validate( {
				rules: {
					nome: "required",
					cpf: "required",
					nome: {
						required: true,
						minlength: 2
					},
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
					agree: "required"
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					username: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address",
					agree: "Please accept our policy"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			} );

			$( "#signupForm1" ).validate( {
				rules: {
					firstname1: "required",
					lastname1: "required",
					username1: {
						required: true,
						minlength: 2
					},
					password1: {
						required: true,
						minlength: 5
					},
					confirm_password1: {
						required: true,
						minlength: 5,
						equalTo: "#password1"
					},
					email1: {
						required: true,
						email: true
					},
					agree1: "required"
				},
				messages: {
					firstname1: "Please enter your firstname",
					lastname1: "Please enter your lastname",
					username1: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password1: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password1: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email1: "Please enter a valid email address",
					agree1: "Please accept our policy"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
		} );
	</script></body>