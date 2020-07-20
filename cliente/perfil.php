<?php session_start();
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){ 
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Cliente();
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cliente</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../estilos/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Cliente</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="../controlador/cerrarSesion.php" class="list-group-item list-group-item-action bg-light text-center">Cerrar Sesión</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menú</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php">INICIO <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Carrito</a>
            </li>
            <li class="nav-item dropdown">
            <a href="../controlador/cerrarSesion.php" class="list-group-item list-group-item-action bg-light text-center">Cerrar Sesión</a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container">
    <img src="../img/contactoAgenda.png">
    </div>

    <form action="../controlador/perfilCont.php" method="POST">    
    <div class="container">
        <div class="col-sm-8 col-md-8 col-lg-8 "><label><h3>Perfil</h3></label>
        <div class="card-body bg-info text-white">
            <table id='tablaPerfil'class='table table-striped'>
                <?php
                $obj2=$obj->getClienteInfo($_SESSION['usuario'],$obj2);
                echo "<tr><td><label>ID</label></td><td>".$obj2->getIdCli()."</td></tr>";
                echo "<tr><td><label>Nombre</label></td><td>".$obj2->getNombre()."</td></tr>";
                echo "<tr><td><label>Apellido Paterno</label></td><td>".$obj2->getApellidoP()."</td></tr>";
                echo "<tr><td><label>Apellido Materno</label></td><td>".$obj2->getApellidoM()."</td></tr>";
                echo "<tr><td><label>Telefono</label></td><td>".$obj2->getTel()."</td></tr>";
                echo "<tr><td><label>Fecha de Nacimiento</label></td><td>".$obj2->getFechaNac()."</td></tr>";
                echo "<tr><td><label>Correo</label></td><td>".$obj2->getCorreo()."</td></tr>";
                echo "<tr><td><label>Contraseña</label></td><td>".$obj2->getContra()."</td></tr>";
                ?>
            </table>
        </div>
    </div>    
    <div class='card-body'>
    <button class='btn btn-warning ' type="submit">Modificar</button>
        </div>
</form>

  <!-- Bootstrap core JavaScript -->
  <script src="../js/jquery/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>


<?php  
}else{
  echo "<script>window.location.replace('../index.php')</script>";
}
?>