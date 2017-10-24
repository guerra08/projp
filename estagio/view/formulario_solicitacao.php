<?php 
include_once 'head.php';
include_once 'autoload.php';

if($_POST){
	if(!empty($_POST)){
		$controleUsuario = new ControllerUsuario();
		$_POST['status'] = 0;
		$controleUsuario->setVisao($_POST);
		$retorno = $controleUsuario->controleAcao('inserir');
		if($retorno === true){
       echo '<script> '
                . 'alert("Solicitação enviada com sucesso!");'
                . ' window.location.href="index.php";'
            . '</script>';
    }
		
	}
}
?>
	<body>
               <div class="container">
                <div class="row"style="padding-top: 70px">
		<div class="col-md-8 col-md-offset-2">
    		<div class="panel panel-default">
            <form class="form-horizontal" method="post" action="formulario_solicitacao.php">
<fieldset>

<!-- Form Name -->
<legend>Quero ser um usuário</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nome">Nome</label>  
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

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="interesse">Qual o seu interesse emse tornar um usuário do sistema ?</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="interesse-0">
      <input type="radio" name="interesse" id="interesse-0" value="1" checked="checked">
      visualizar por completo o repositório;
    </label>
	</div>
  <div class="radio">
    <label for="interesse-1">
      <input type="radio" name="interesse" id="interesse-1" value="2">
      contribuir com informações;
    </label>
	</div>
  <div class="radio">
    <label for="interesse-2">
      <input type="radio" name="interesse" id="interesse-2" value="3">
      sou da instituição;
    </label>
	</div>
  <div class="radio">
    <label for="interesse-3">
      <input type="radio" name="interesse" id="interesse-3" value="4">
      apenas curiosidade.
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
  <label class="col-md-4 control-label" for="enviar"></label>
  <div class="col-md-8">
    <button id="enviar" name="enviar" class="btn btn-success">Enviar</button>
    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
  </div>
</div>

</fieldset>
</form>
                </div></div></div></div>
				<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>
</body></html>