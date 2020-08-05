<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?>

<!-- mensajes -->
<?php if(isset($_GET['action'])){
          if($_GET['action']=='Registrado'){ ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Se ha registrado <strong>Correctamente!</strong>, ya puede iniciar sesion
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('index.php');">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <?php }else if($_GET['action']=='fail'){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Debe <strong>Iniciar Sesion!</strong> para acceder a esta pagina
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('index.php');">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <?php }
        }?>
<!-- Empieza el carrusel -->
<div class="container">
<script src="../javascript/funcionesExtra.js"></script>
<div id="carouselExampleCaptions" class="carousel slide mt-4" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/carrusel1" style="max-widht: 100%" class="d-block w-100" alt="...">
    
    </div>
    <div class="carousel-item">
      <img src="img/carrusel2.jpg" class="d-block w-100" alt="...">
    
    </div>
    <div class="carousel-item">
      <img src="img/carrusel3.jpg" class="d-block w-100" alt="...">
      
    </div>
  </div>
  <a class="carousel-control-prev"  href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<!-- Termina el carrusel -->

<!-- Apartado donde muestra productos -->
<main class="my-4">
    <h3 class="text-center font-weight-light my-4">Categorias de productos</h3>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 my-2 " align=center>
                <div class="card" style="width: 18rem; border-top: .3rem solid rgb(224, 191, 3);  max-width:100%;">
                    <img src="img/alimentos.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-center">Alimentos</h5>
                      
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Quesos y Lacteos</li>
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Carnes frias y Embutidos</li>
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Bebidas y frituras</li>
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Reposteria</li>
                    </ul>
                    <div class="card-body">
                      <a href="alimentos.php?pagina=1&c=Al" class="card-link btn btn-warning btn-sm">Ir al catálogo</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 my-2 " align=center>
                <div class="card" style="width: 18rem; border-top: .3rem solid rgb(224, 191, 3);  max-width:100%;">
                    <img src="img/abarrotes.jpg" class="card-img-top" alt="imagen abarrotes">
                    <div class="card-body">
                      <h5 class="card-title text-center">Abarrotes</h5>
                      
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">
                       Hogar y Limpieza
                      </li>
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Salud y Cuidado Personal</li>
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Semillas y Cereales</li>
                      <li class="list-group-item" onmouseover="cambiarColor(this, 'rgb(224, 191, 3)')" onmouseout="cambiarColor(this, 'white')">Productos diversos</li>
                    </ul>
                    <div class="card-body">
                      <a href="abarrotes.php?pagina=1&c=Ab" class="card-link btn btn-warning btn-sm">Ir al catálogo</a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-4 col-lg-4 my-2" align=center>
                <div class="card" style="width: 18rem; border-top: .3rem solid rgb(224, 191, 3);  max-width:100%;">
                    <img src="img/servicios.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-center">Servicios</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">-</li>
                      <li class="list-group-item">-</li>
                      <li class="list-group-item">-</li>
                      <li class="list-group-item">-</li>
                    </ul>
                    <div class="card-body">
                      Proximamente
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</main>
<?php include('plantillas/chatFace.php'); ?> 
<?php include('plantillas/footer.php'); ?> 
