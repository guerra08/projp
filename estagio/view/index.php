<?php 
require_once '../view/head.php';
include_once '../view/autoload.php';

session_start();

?>


<!DOCTYPE html>



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
    


    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Repositório Fotográfico</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
               <?php
			   if(isset($_SESSION['idUsuario']) && $_SESSION['idUsuario'] > 0 && isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
			   ?>
				<li class="dropdown">
                    <a href="repositorio.php?logout=1""><i class="glyphicon glyphicon-user"></i> Realizar logout</a>
				<?php
				}
				else{
				?>
                    
                <li><a href="login_usuario.php"><i class="glyphicon glyphicon-lock"></i> Realizar login</a></li>
				<li class="dropdown">
                    
                <li><a href="Formulario_solicitacao.php"><i class="glyphicon glyphicon-lock"></i> Solicitar acesso</a></li>
				<?php } ?>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
        <!-- /.container -->

     
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <h1 class="text-center">Seja bem vindo ao Repositório Fotográfio</h1>
        <img  src="../imagens/capa.jpg" class="capa" alt="">
         
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
        <div class="col-md-4">
            <!-- begin panel group -->
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                
                <!-- panel 1 -->
                <div class="panel panel-default">
                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                    <span class="side-tab" data-target="#tab1" data-toggle="tab" role="tab" aria-expanded="false">
                        <div class="panel-heading" role="tab" id="headingOne"data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="panel-title">TAB 1</h4>
                        </div>
                    </span>
                    
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        <!-- Tab content goes here -->
                        That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                        </div>
                    </div>
                </div> 
                <!-- / panel 1 -->
                
                <!-- panel 2 -->
                <div class="panel panel-default">
                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                    <span class="side-tab" data-target="#tab2" data-toggle="tab" role="tab" aria-expanded="false">
                        <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="panel-title collapsed">TAB 2</h4>
                        </div>
                    </span>

                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                        <!-- Tab content goes here -->
                      That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                        </div>
                    </div>
                </div>
                <!-- / panel 2 -->
                              <!--  panel 3 -->
                <div class="panel panel-default">
                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                    <span class="side-tab" data-target="#tab3" data-toggle="tab" role="tab" aria-expanded="false">
                        <div class="panel-heading" role="tab" id="headingThree"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h4 class="panel-title">TAB 3 </h4>
                        </div>
                    </span>

                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                          <!-- tab content goes here -->
                          That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                          </div>
                        </div>
                      </div>
            </div> <!-- / panel-group -->
             
        </div> <!-- /col-md-4 -->
          
        <div class="col-md-8">
            
            <!-- begin macbook pro mockup -->
            <div class="md-macbook-pro md-glare">
                <div class="md-lid">
                    <div class="md-camera"></div>
                    <div class="md-screen">
                    <!-- content goes here -->                
                        <div class="tab-featured-image">
                            <div class="tab-content">
                                <div class="tab-pane  in active" id="tab1">
                                    <img src="../imagens/tab_1.jpg" alt="tab1" class="img img-responsive">
                                </div>
                                <div class="tab-pane " id="tab2">
                                    
                                        <img src="../imagens/tab2.jpg">
                                    
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    
                                        <img src="../imagens/tab3.jpg" alt="tab1" class="img img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md-base"></div>
            </div> <!-- end macbook pro mockup -->

        </div>

        </div> <!-- / .col-md-8 -->
        <hr>
        <hr>
         <h3 class="text-center">Veja algumas fotografias do sistema</h3>
       <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
	<div class="row">
		<div class='list-group gallery'>
            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="http://placehold.it/300x320.png">
                    <img class="img-responsive" alt="sdasdasdasdasdas" src="http://placehold.it/320x320" />
                    <div class='text-right'>
                        
                    </div> <!-- text-right / end -->
                </a>
                <h3 class='text-muted'>Image Title</h3>
                <p>Descrição com função pra dar um br a cada X caracteres</p>
               
                <a href="#" class="btn btn-default col-sm-6">
                            <i class="glyphicon  glyphicon-comment"></i>
                            Comentários
                </a>
                <br>
                <br>
                <a href="#" class="btn btn-default col-sm-5">
                            <i class="glyphicon  glyphicon-pushpin"></i>
                            Comentar
                </a>
                <a href="#" class="btn btn-default col-sm-7">
                            <i class="glyphicon  glyphicon-download"></i>
                            Fazer Donwload
                </a>
               
               
             
            </div> <!-- col-6 / end -->
            
        </div> <!-- list-group / end -->
	</div> <!-- row / end -->
        <hr>
        <div class="row"  >
            <div class="columns medium-3">
                <h3 class="text-center">Seja um parceiro</h3>
                <img src="http://www.placehold.it/500x500/b5bbbd/e2e6e7/&text=printdorepositórioemuso" id="left" alt="" class="img-rounded" class="img-responsive">
                <hr>
                <p class="text-center">Modi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quodModi, sunt vero necessitatibus sint voluptatibus quod</p>
                
            </div>
            <hr>
            <a href="Formulario_solicitacao.php" class="btn btn-default col-sm-7">
                            <i class="glyphicon  glyphicon-info-sign"></i>
                            Solicitar acesso
                </a>
</div> 
</div><!-- container / end -->
 
        <!-- Footer -->
        
        <footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

    </div>
    
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

</body>

</html>

