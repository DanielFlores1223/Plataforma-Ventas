<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrador</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../estilos/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading text-center">Administrador</div>
      
        <div class="text-center mb-3"><a href="../index.php"><img src="../img/logo_crem_adap.png" alt="logo cremeria liz"></a></div>    
      <div class="list-group list-group-flush">
        <a href="perfil.php" class="list-group-item list-group-item-action bg-light text-center">Inicio</a>
        <a href="#" class="list-group-item list-group-item-action bg-light text-center">Pedidos</a>
        <a href="#" class="list-group-item list-group-item-action bg-light text-center">Inventario</a>
        <a href="#" class="list-group-item list-group-item-action bg-light text-center">Empleados</a>
        <a href="proveedores.php" class="list-group-item list-group-item-action bg-light text-center">Provedores</a>
        <a href="#" class="list-group-item list-group-item-action bg-light text-center">Reportes</a>
      </div>
    </div>
    <!-- cierra sidebar -->

    <!-- Contenido pagina -->
    <!-- Comienza barra superior -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menú</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Bienvenido <?php echo $_SESSION['usuario'];?></a>
            </li>
          </ul>
        </div>
      </nav>
        <!-- Cierra barra superior -->
      
  <!-- cierra el contenido pagina-->

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