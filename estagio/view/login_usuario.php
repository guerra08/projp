<?php 
include_once '../view/head.php';

include_once 'autoload.php';

if($_POST){
	
	$userControle = new Controllerusuario();
	$userControle->setVisao($_POST);
	$retorno = $userControle->controleAcao("logar");
	
	if($retorno === false){
		echo "<script>
		window.alert('Acesso negado!')
    	window.location.href='login_usuario.php';
		</script>";
	}
	else{
		session_start();
		$_SESSION['idUsuario'] = $retorno;
		$_SESSION['auth'] = true;
		header ("Location: acesso.php");
	}
	
}
    ?>
	<body>
            <div class="container">
                <div class="row"style="padding-top: 70px">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Realizar login</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method="post" action = "login_usuario.php">
                    <fieldset>
			    	  	<div class="form-group">
                                            <p> Digite seu E-mail:</p><input class="form-control" placeholder="E-mail" name="email" type="text">
			    		</div>
			    		<div class="form-group">
                                            <p>Digite sua senha:</p><input class="form-control" placeholder="Senha" name="senha" type="password" value="">
			    		</div>
			    		
			    		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
        </body>

       	</html>