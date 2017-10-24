<?php
require_once '../view/head.php';
include_once '../view/autoload.php';

include_once('user_auth.php');
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  
<body>
	<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="repositorio.php">Voltar ao repositório</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
						<ul id="g-account-menu" class="dropdown-menu" role="menu">
							<li><a href="#">perfil</a></li>
						</ul>
					</li>
					<li><a href="painel_adm.php?logout=1"><i class="glyphicon glyphicon-lock"></i>Realizar Logout</a></li>
				</ul>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /Header -->
		<div class="container">			
			<div class="row">
				<div class='list-group gallery'>
					
					<!--FOREACH -->
					<?php
                                        if(isset($_POST['autor'], $_POST['id_imagem'], $_POST['comentario'])){
                                            $controleComentario = new ControllerComentario;
                                            $controleComentario->setVisao($_POST);
                                            $controleComentario->controleAcao('inserir');
                                        }
                                        
                                        
					$controleImagem= new ControllerImagem();
					$params = new stdClass;
					$params->pesquisa = $_GET['id'];
					$imagens = $controleImagem->controleAcao('listarTodos', $params);					
					foreach($imagens as $id => $img){
					?>
					<div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $img['imagem']; ?>">
							<img class="img-responsive" alt="sdasdasdasdasdas" src="<?php echo $img['imagem']; ?>" />
							<div class='text-right'>
								
							</div> <!-- text-right / end -->
						</a>
						<h3 class='text-muted'><?php echo $img['nome']; ?></h3>
						<p><?php echo $img['descricao']; ?></p>
						<p><b>Autoria: </b><?php echo $img['autoria']; ?></p>
					    <p><b>Data: </b><?php echo $img['data_imagem']; ?></p>
						<a href="#" class="btn btn-default col-sm-6" onClick="verComentarios(<?php echo $img['id_imagem']; ?>)">
									<i class="glyphicon  glyphicon-comment"></i>
									Comentários
						</a>
						<a href="#" class="btn btn-default col-sm-5" onClick="comentar(<?php echo $img['id_imagem']; ?>)">
									<i class="glyphicon  glyphicon-pushpin"></i>
									Comentar
						</a><br><br>
						<a href="<?php echo $img['imagem']; ?>" class="btn btn-default col-sm-7" download>
									<i class="glyphicon  glyphicon-download"></i>
									Fazer Download
						</a>
						<br><br><br>
                                                <form class="formulariospraesconder" id="comentario<?php echo $img['id_imagem']; ?>" method="post" action="ver_categoria.php?id=<?php echo $_GET['id']; ?>">
							<textarea class="form-control" rows="6" resize="none" name="comentario"></textarea>	<br>
							<input type="hidden" name="id_imagem" value="<?php echo $img['id_imagem']; ?>">
							<input type="hidden" name="autor" value="<?php echo $_SESSION['idUsuario']; ?>">
							<input type="hidden" name="status" value="0">
							<input type="submit" value="Enviar" class="btn btn-success">
						</form>
                                                <div class="comentarios" id="comentarios<?php echo $img['id_imagem']; ?>">
						<?php
                                                
                                                $controleComentario = new ControllerComentario;
                                                $params = new stdClass;
                                                $params->id_imagem = $img['id_imagem'];
                                                $comentarios = $controleComentario->controleAcao('listarTodos', $params);					
                                                $comentarios = $comentarios->comentarios;
                                                foreach($comentarios as $id => $comentario){
                                                	if($comentario['status'] == 1)
                                                    echo "<pre>";
                                                    print_r($comentario);
                                                    echo "</pre>";
                                                }
                                                
						?>
                                                </div>
					</div> <!-- col-6 / end -->
					<!--END FOREACH-->
					<?php
					}
					?>
					
				</div> <!-- list-group / end -->
			</div> <!-- row / end -->
		</div> <!-- /.container -->
<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

</body>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
	<script type="text/javascript">

 $(document).ready(function(){
	$('.formulariospraesconder').hide();	        
	$('.comentarios').hide();
    $('.link-gallery').click(function(){
		var galleryId = $(this).attr('data-target');
		var currentLinkIndex = $(this).index('a[data-target="'+ galleryId +'"]');

		createGallery(galleryId, currentLinkIndex);
		createPagination(galleryId, currentLinkIndex);

		$(galleryId).on('hidden.bs.modal', function (){
			destroyGallry(galleryId);
			destroyPagination(galleryId);
		});

		$(galleryId +' .carousel').on('slid.bs.carousel', function (){
			var currentSlide = $(galleryId +' .carousel .item.active');
			var currentSlideIndex = currentSlide.index(galleryId +' .carousel .item');

			setTitle(galleryId, currentSlideIndex);
			setPagination(++currentSlideIndex, true);
		})
	});

	function createGallery(galleryId, currentSlideIndex){
		var galleryBox = $(galleryId + ' .carousel-inner');

		$('a[data-target="'+ galleryId +'"]').each(function(){
			var img = $(this).html();
			var galleryItem = $('<div class="item">'+ img +'</div>');

			galleryItem.appendTo(galleryBox);
		});

		galleryBox.children('.item').eq(currentSlideIndex).addClass('active');
		setTitle(galleryId, currentSlideIndex);
	}

	function destroyGallry(galleryId){
		$(galleryId + ' .carousel-inner').html("");
	}

	function createPagination(galleryId, currentSlideIndex){
		var pagination = $(galleryId + ' .pagination');
		var carouselId = $(galleryId).find('.carousel').attr('id');
		var prevLink = $('<li><a href="#'+ carouselId +'" data-slide="prev">«</a></li>');
		var nextLink = $('<li><a href="#'+ carouselId +'" data-slide="next">»</a></li>');

		prevLink.appendTo(pagination);
		nextLink.appendTo(pagination);

		$('a[data-target="'+ galleryId +'"]').each(function(){
			var linkIndex = $(this).index('a[data-target="'+ galleryId +'"]');
			var paginationLink = $('<li><a data-target="#carouselGallery" data-slide-to="'+ linkIndex +'">'+ (linkIndex+1) +'</a></li>');

			paginationLink.insertBefore('.pagination li:last-child');
		});

		setPagination(++currentSlideIndex);
	}

	function setPagination(currentSlideIndex, reset = false){
		if (reset){
			$('.pagination li').removeClass('active');
		}

		$('.pagination li').eq(currentSlideIndex).addClass('active');
	}

	function destroyPagination(galleryId){
		$(galleryId + ' .pagination').html("");
	}

	function setTitle(galleryId, currentSlideIndex){
		var imgAlt = $(galleryId + ' .item').eq(currentSlideIndex).find('img').attr('alt');

		$('.modal-title').text(imgAlt);
	}
});

$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
function comentar(id){
	$('#comentario'+id).toggle();
}
function verComentarios(id){
	$('#comentarios'+id).toggle();
}
    </script>
	
	 <!-- jQuery -->
    <script src="js/jquery.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>