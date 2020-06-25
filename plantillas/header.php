<?php include('bootstrap.php'); ?>

<div class="estilo-header">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand pb-4 pt-4" href="#">Cremeria Liz</a>
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
            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalRegistro">Registrarse</a>
        </li>
    </div>
    <div class="row align-items-center">
        <li class="nav-item">
            <img src="../img/ingreso.png" alt="">
        </li>
    
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalInicioSesion">Iniciar Sesión</a>
        </li>
    </div>
    </ul>
  </div>
</nav>
</div>

<!-- Modal registro -->

<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div class="mr-3">
      <img src="../img/usario_header.png" alt="">
      </div>
        <h5 class="modal-title" id="modalRegistro">  Registro cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Registrarse</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Inicio de sesion -->
<div class="modal fade" id="modalInicioSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div class="mr-3">
      <img src="../img/ingreso.png" alt="">
      </div>
        <h5 class="modal-title" id="modalInicioSesion">Inicio de sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- Formulario de login  -->
       <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Correo electrónico</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
          </div>
        </form>
       <!-- termina Formulario de login  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Iniciar Sesión</button>
      </div>
    </div>
  </div>
</div>