<?php 
session_start();
include('barraEmpleado.php');


//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $prod = $_SESSION['producto'];
    $prov = $_SESSION['prove'];
?>

<div class="container">
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a href="inventario.php?pagina=1" class="btn btn-light">Regresar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Más detalles</a>
      </li>
    </ul>
  </div>
  <div class="card-body" >
    <div class="row">
        <div class="col-3">
            <img src="<?php echo  $prod[8] != "" ? '../'.$prod[8] : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
        </div>
        <div class="col-9">
            <h5 class="font-weight-light">Información del Producto</h5>
            <p><b class="text-info">Código: </b> <?php echo $prod[0]; ?> </p>
            <p><b class="text-info">Nombre: </b> <?php echo $prod[1]; ?> </p>
            <p><b class="text-info">Categoria: </b> <?php echo $prod[2]; ?> </p>
            <p><b class="text-info">Subcategoria: </b> <?php echo $prod[3]; ?> </p>
            <p><b class="text-info">Existencia: </b> <?php echo $prod[4]; ?> </p>
            <p><b class="text-info">Precio: </b> <?php echo $prod[5]; ?> </p>
            <p><b class="text-info">Descripción: </b> <?php echo $prod[6]; ?> </p>
        </div>
    </div>
    <hr  style="border-top: .3rem solid rgb(224, 191, 3);">
    <div class="row">
        <div class="col-3 text-center">
        <img src="../img/contactoAgenda.png" alt="" style="max-width:100%;">
        </div>
        <div class="col-4">
        <h5 class="font-weight-light">Información del Proveedor</h5>
            <p><b class="text-info">Id: </b> <?php echo $prov[0]; ?> </p>
            <p><b class="text-info">Nombre: </b> <?php echo $prov[1]; ?> </p>
            <p><b class="text-info">Nombre del agente: </b> <?php echo $prov[2]; ?> </p>
            <p><b class="text-info">Teléfono: </b> <?php echo $prov[3]; ?> </p>
           
        </div>
        <div class="col-4 mt-5">
        <p><b class="text-info">Horario: </b> <?php echo $prov[4]; ?> </p>
            <p><b class="text-info">Categoria: </b> <?php echo $prov[5]; ?> </p>
            <p><b class="text-info">Dirección: </b> <?php echo $prov[6]; ?> </p>
        </div>
    </div>
  </div>
</div>


</div>
<!-- -->
</div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>