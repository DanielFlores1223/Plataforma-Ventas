<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?>

<!-- Empieza el carrusel -->
<div class="container">
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
    <h3 class="text-center font-weight-light">Categorias de productos</h3>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="img/alimentos.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Alimentos</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Lacteos</li>
                      <li class="list-group-item">Frutas</li>
                      <li class="list-group-item">Verduras</li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="img/alimentos.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Alimentos</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Lacteos</li>
                      <li class="list-group-item">Frutas</li>
                      <li class="list-group-item">Verduras</li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="img/alimentos.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Alimentos</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Lacteos</li>
                      <li class="list-group-item">Frutas</li>
                      <li class="list-group-item">Verduras</li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</main>

<?php include('plantillas/footer.php'); ?> 
