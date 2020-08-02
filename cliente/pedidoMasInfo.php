<?php 
session_start();
include('barraCliente.php');
include ('../modelo/conexion.php');
include ('../modelo/clases.php');

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
  
  if(!isset($_POST['masDetallesP'])){
    echo "<script>window.location.replace('pedido.php')</script>";

  }else{

  $idPedido = $_POST['masDetallesP'];
  $obj= new ConexionMySQL("root",""); 
  $obj2= new VentaOnline();
  $objTiene= new Tiene();
  $objp= new Producto();
  $obj2=$obj->getPedido($obj2,$idPedido);
  $objTiene=$obj->getPedidoTiene($objTiene,$idPedido);
  $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());
?>

<div class="container">
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a href="../cliente/pedido.php" class="btn btn-light">Regresar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Más detalles</a>
      </li>
    </ul>
  </div>
  <div class="card-body" >
    <div class="row">
        <div class="col-3">
            <img src="<?php echo  $infoP->getFoto() != "" ? $infoP->getFoto() : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
        </div>
        <div class="col-4">
            <h5 class="font-weight-light">Información del Producto</h5>
            <p><b class="text-info">No° Pedido: </b> <?php echo $infoP->getNombreProd(); ?> </p>
            <p><b class="text-info">Metodo de Pago: </b> <?php echo $infoP->getCategoria(); ?> </p>
            <p><b class="text-info">Tipo: </b> <?php echo $infoP->getSubCat();?> </p>
            <p><b class="text-info">Total: </b> <?php echo $infoP->getPrecio(); ?> </p>
            <p><b class="text-info">Fecha: </b> <?php echo $infoP->getDescripcion(); ?> </p>
        </div>
        <div class="col-5">
            <h5 class="font-weight-light">Información del pedido</h5>
            <p><b class="text-info">No° Pedido: </b> <?php echo $obj2->getId_Venta(); ?> </p>
            <p><b class="text-info">Metodo de Pago: </b> <?php echo $obj2->getMetodoPago(); ?> </p>
            <p><b class="text-info">Total: </b> <?php echo $obj2->getTotal(); ?> </p>
            <p><b class="text-info">Fecha: </b> <?php echo $obj2->getFechaVenta(); ?> </p>
            <p><b class="text-info">Id Cliente: </b> <?php echo $obj2->getId_Cliente(); ?> </p>
            <p><b class="text-info">Direccion: </b> <?php echo $obj2->getDirreccionEnvio(); ?> </p>
            <p><b class="text-info">Fecha de Entrega: </b> <?php echo $obj2->getFechaEntrega(); ?> </p>
            <p><b class="text-info">Estatus: </b> <?php echo $obj2->getEstatus();?> </p>
        </div>
    </div>
    <hr  style="border-top: .3rem solid rgb(224, 191, 3);">
  </div>
</div>
</div>
<!-- -->
</div>
</div>
<?php 
}}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>