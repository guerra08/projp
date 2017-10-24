<?php
include_once 'adm_auth.php';
include_once 'autoload.php';
?>

<html lang="en">


        <?php 
        include_once 'head.php';
        ?>
	<body  oncontextmenu="return false;">
               <?php 
                   include_once 'menu.php';
               ?>

           
            <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> Painel de controle</strong></a>
            <hr>

            <div class="row">
                <!-- center left-->
                <div class="col-md-9">
                    <div class="well">Solicitações de usuário pendentes <span class="badge pull-right">
                    <?php 
                    $userController = new Controllerusuario(); 
                    $contagem1 = $userController->controleAcao("countSolicitacoes");
                    ECHO($contagem1);
                    ?>
                    </span></div>
                    <div class="well">Imagens pendentes <span class="badge pull-right">
                    <?php 
                    $imageController = new ControllerImagem(); 
                    $contagem2 = $imageController->controleAcao("countSolicitacoes");
                    ECHO($contagem2);
                    ?>
                    </span></div>

                    <hr>

                    <div class="btn-group btn-group-justified">
                        <a href="confirmacaoImagens.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon  glyphicon-check"></i>
                            <br> Confirmar Imagens
                        </a>
                        <a href="cadastrar_adm.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-plus"></i>
                            <br> Adicionar Administrador
                        </a>
                        <a href="criar_categoria.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-th-list"></i>
                            <br> Criar Categoria
                        </a>
                        
                        <a href="visualizar_usuarios.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-modal-window"></i>
                            <br> Visualizar Integrantes do Sistema
                        </a>
                        
                    </div>
                    <br>
                    <div class="btn-group btn-group-justified">
                        <a href="repositorio.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-eye-open"></i>
                            <br> Visualizar Repositório
                        </a>
                        <a href="cadastrar_usuario.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-user"></i>
                            <br> Cadastrar Usuário
                        </a>
                        <a href="visualizar_comentarios.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-pencil"></i>
                            <br> Visualizar Comentários
                        </a>
                        
                        <a href="visualizar_usuarios.php" class="btn btn-primary col-sm-3">
                            <i class="glyphicon glyphicon-question-sign"></i>
                            <br> Visualizar Solicitações
                        </a>
                    </div>
                    <br>
                     <div class="btn-group btn-group-justified">
                        <a href="adicionar_img.php" class="btn btn-success col-sm-3">
                            <i class="glyphicon glyphicon-picture"></i>
                            <br> Adicionar Fotografia
                        </a>
                    </div>


                    <hr>

                    <!--tabs-->
                    
                    
                    <!--/tabs-->

                    <hr>
                    
                </div>
                <!--/col-->

            </div>
            <!--/row-->

            <hr>

           

       

        
<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

<div class="modal" id="addWidgetModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Widget</h4>
            </div>
            <div class="modal-body">
                <p>Add a widget stuff here..</p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dalog -->
</div>
<!-- /.modal -->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>