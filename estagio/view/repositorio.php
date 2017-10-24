<?php 
require_once '../view/head.php';
include_once '../view/autoload.php';
include_once 'user_auth.php';
?>

<body>
    <style type="text/css">
              .resize {
    max-width: 300px;
    max-height: 200px;
    
    
    
}
#left{
    width:70%;
    height:300px;
    margin-left: 200px;
    
   
}
.capa {
    width:100%;
    height:300px;
   
   
}

.panel-heading:hover {
    cursor:pointer;
}
.panel-heading {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;    
}

.side-tab:hover {
        cursor: pointer;
    }
    .panel.panel-default {
        border: none;
        box-shadow: none !important;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
        
    }
    .panel-heading {
        border: none;
        background-color: #eee;
    
    }
    .panel-body {
        background-color: #f5f5f5;
    }
    .panel-title {
        font-weight: 400;
        color: green ;
    }

/*----------------------------------
    Macbook pro mockup from:
    http://jaredhardy.com/minimal-devices/
    
----------------------------------*/

.md-macbook-pro {
  display: block;
  width: 55.3125em;
  height: 31.875em;
  font-size: 13px;
  margin: 0 auto;

 
  }
  @media (max-width:1024px){
    font-size: 10px;
  }

  @media (max-width:767px){
    font-size: 7px;
  }

  @media (max-width:320px){
    font-size: 5px;
  }


.md-macbook-pro .md-lid {
  width: 45em;
  height: 30.625em;
  overflow: hidden;
  margin: 0 auto;
  position: relative;
  border-radius: 1.875em;
  border: solid 0.1875em #cdced1;
  background: #131313;
}
.md-macbook-pro .md-camera {
  width: 0.375em;
  height: 0.375em;
  margin: 0 auto;
  position: relative;
  top: 1.0625em;
  background: #000;
  border-radius: 100%;
  box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.25);
}
.md-macbook-pro .md-camera:after {
  content: "";
  display: block;
  width: 0.125em;
  height: 0.125em;
  position: absolute;
  left: 0.125em;
  top: 0.0625em;
  background: #353542;
  border-radius: 100%;
}
.md-macbook-pro .md-screen {
  width: 42.25em;
  height: 26.375em;
  margin: 0 auto;
  position: relative;
  top: 2.0625em;
 
  background: #fff;
  overflow: hidden;
}
.md-macbook-pro .md-screen img {
  width: 100%;
}
.md-macbook-pro .md-base {
  width: 100%;
  height: 0.9375em;
  position: relative;
  top: -0.75em;
  background: #c6c7ca;
}
.md-macbook-pro .md-base:after {
  content: "";
  display: block;
  width: 100%;
  height: 0.5em;
  margin: 0 auto;
  position: relative;
  bottom: -0.1875em;
  background: #b9babe;
  border-radius: 0 0 1.25em 1.25em;
}
.md-macbook-pro .md-base:before {
  content: "";
  display: block;
  width: 7.6875em;
  height: 0.625em;
  margin: 0 auto;
  position: relative;
  background: #a6a8ad;
  border-radius: 0 0 0.625em 0.625em;
}
.md-macbook-pro.md-glare .md-lid:after {
  content: "";
  display: block;
  width: 50%;
  height: 100%;
  position: absolute;
  top: 0;
  right: 0;
  border-radius: 0 1.25em 0 0;
  background: -webkit-linear-gradient(37deg, rgba(255, 255, 255, 0) 50%, rgba(247, 248, 240, 0.025) 50%, rgba(250, 245, 252, 0.08));
  background: -moz-linear-gradient(37deg, rgba(255, 255, 255, 0) 50%, rgba(247, 248, 240, 0.025) 50%, rgba(250, 245, 252, 0.08));
  background: -o-linear-gradient(37deg, rgba(255, 255, 255, 0) 50%, rgba(247, 248, 240, 0.025) 50%, rgba(250, 245, 252, 0.08));
  background: linear-gradient(53deg, rgba(255, 255, 255, 0) 50%, rgba(247, 248, 240, 0.025) 50%, rgba(250, 245, 252, 0.08));
}
    </style>
    <!-- Navigation -->
 
  <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<?php
			if(isset($_SESSION['admin_access']) &&  $_SESSION['admin_access'] == 1){
				echo '<a class="navbar-brand" href="painel_adm.php">Voltar ao Painel</a>';
			}
			else{
				echo '<a class="navbar-brand" href="index.php">Voltar ao Início</a>';
			}
			?>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    
                <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] === true){?><li><a href="repositorio.php?logout=1"><i class="glyphicon glyphicon-lock"></i>Realizar logout</a></li><?php } ?>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
        <!-- /.container -->

     
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
   
          
            <div class="container">

        <!-- Jumbotron Header -->
        <h1 class="text-center">Seja bem vindo ao Repositório Fotográfio</h1>
       <img  src="http://placehold.it/170x100&text=imagemaqui" class="capa" alt="">
         
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">Conheça um pouco mais do IFRS campus Bento </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non 
                    incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.Lorem ipsum dolor sit amet, 
                    consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non 
                    incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat</p>
            </div>
            
        </div>

   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


<div class="container">
    <div class="row">
        <!-- /col-md-4 -->
        <div class="row text-center">
            <div class="col-lg-12">
                <h3>Veja as categorias do Sistema</h3>
            </div>
            
        </div>
        <!-- /.row -->
        <div class="row text-center">
  <?php
 
    $categoriaController= new ControllerCategoria();
    $categorias = $categoriaController->controleAcao('listarTodos');

 
    foreach($categorias->categorias as $id => $categoria){
         
        
        echo ' 
          
            <div class="col-md-4 col-md-8 ">
                <div class="thumbnail" >
                
                    <div class="caption">
                        <h3> '.$categoria['nome'].'</h3>
                        <p> '.mb_strimwidth($categoria['descricao'], 0, 30, "...").'</p>
                        <p>
                            <a href="adicionar_img.php" class="btn btn-primary">Adicionar imagem</a> <a href="ver_categoria.php?id='.$categoria['id_categoria'].'" class="btn btn-default">Mais informações</a> <a href="download_categoria.php?id_categoria='.$categoria['id_categoria'].'" class="btn btn-default" target="_blank">Fazer Download de todas Imagens</a>
                        </p> 
                        
                    </div>
                </div>
            </div>
            ';
            
  }         
                         //   $categoriaControle = new ControllerCategoria();
                           // $categorias = $categoriaControle->controleAcao("listarTodos");
                          //  foreach ($categorias as $key => $categoria) {
                            //  echo '<option value="'.$categoria->getId_categoria[0].'" '.((isset($imagemAlteracao) && $imagemAlteracao->getId_categoria() == $categoria->getId_categoria[0]) ? 'selected' : "").'>'.$categoria->getId_categoria[1].'</option>';
      ?>                    
        <!-- Page Features -->
        </div>
        
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>


    </div>
    <!-- /.container -->
            <script type="text/javascript">
   

$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
    </script>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
