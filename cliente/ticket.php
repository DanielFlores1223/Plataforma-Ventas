<?php
include('../modelo/conexion.php');
include('../modelo/clases.php');
$obj= new ConexionMySQL("root",""); 
$obj2= new VentaOnline();
    $objTiene= new Tiene();
    $objp= new Producto();
    $idPedido = $_GET['id'];
  $obj2=$obj->getPedido($obj2,$idPedido);
  $objTiene=$obj->getPedidoTiene($objTiene,$idPedido);
  $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());
?>  
<img src="../img/logo_bN.png" alt="" align=right>
<h4>Cremieria liz</h4>

    <p><b>Información del Producto</b></p>
    <p><b >Producto: </b> <?php echo $infoP->getNombreProd(); ?> </p>
    <p><b >Categoria: </b> <?php echo $infoP->getCategoria(); ?> </p>
    <p><b >Sub Categoria: </b> <?php echo $infoP->getSubCat();?> </p>
    <p><b >Precio: </b> $<?php echo $infoP->getPrecio(); ?> </p>
    <p><b >Descripcion: </b> <?php echo $infoP->getDescripcion(); ?> </p>
    <hr>
    <p><b>Información del pedido</b></p>
    
    <p><b >No° Pedido: </b> <?php echo $obj2->getId_Venta(); ?> </p>
    <p><b >Metodo de Pago: </b> <?php echo $obj2->getMetodoPago(); ?> </p>
    <p><b >Total: </b> $<?php echo $obj2->getTotal(); ?> </p>
    <p><b >Fecha: </b> <?php echo $obj2->getFechaVenta(); ?> </p>
    <p><b >Id Cliente: </b> <?php echo $obj2->getId_Cliente(); ?> </p>
    <p><b >Direccion: </b> <?php echo $obj2->getDirreccionEnvio(); ?> </p>
    <p><b >Fecha de Entrega: </b> <?php echo $obj2->getFechaEntrega(); ?> </p>
    <p  ><b >Estatus: </b> <?php echo $obj2->getEstatus();?> </p>
