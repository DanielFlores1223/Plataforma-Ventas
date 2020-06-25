<?php include('bootstrap.php'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Cremeria Liz</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Nosotros</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Alimentos</a>
          <a class="dropdown-item" href="#">Limpieza</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Uso personal</a>
        </div>
    </li>
    </ul>
 
    <ul class="navbar-nav ">
    <div class="row align-items-center mr-3">
        <li class="nav-item">
            <img src="../img/usario_header.png" alt="">
        </li>
    
        <li class="nav-item">
            <a class="nav-link" href="#">Registrarse</a>
        </li>
    </div>
    <div class="row align-items-center">
        <li class="nav-item">
            <img src="../img/ingreso.png" alt="">
        </li>
    
        <li class="nav-item">
            <a class="nav-link" href="#">Iniciar Sesión</a>
        </li>
    </div>
    </ul>
  </div>
</nav>