
<?php 
include('../modelo/conexion.php');
include('../modelo/clases.php');
$obj= new ConexionMySQL("root","");

$idPedido = $_GET['id'];
  $obj2= new VentaOnline();
  $objTiene= new Tiene();
  $objp= new Producto();
  $obj2=$obj->getPedido($obj2,$idPedido);
  
  $articulos=$obj->getNumArticulos($idPedido);
?> 
<img src="../img/logo_bN.png" alt="" align=right>
<h4>Cremieria liz</h4>
<?php          for($i=0;$i<$articulos;$i++){
            $objTiene=$obj->getCarritoTiene($objTiene,$i,$idPedido);
            $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());
            ?>
         
              <h5 >Información del Producto</h5>
              <hr>
              <p><b >Producto: </b> <?php echo $infoP->getNombreProd(); ?> </p>
              <p><b>Categoria: </b> <?php echo $infoP->getCategoria(); ?> </p>
              <p><b>Sub Categoria: </b> <?php echo $infoP->getSubCat();?> </p>
              <p><b>Precio: </b> <?php echo $infoP->getPrecio(); ?> </p>
              <p><b>Descripcion: </b> <?php echo $infoP->getDescripcion(); ?> </p>
            
            <?php
            if($i==0){
              ?>
              <h5 >Información del pedido</h5>
              <hr>
              <p><b >No° Pedido: </b> <?php echo $obj2->getId_Venta(); ?> </p>
              <p><b >Metodo de Pago: </b> <?php echo $obj2->getMetodoPago(); ?> </p>
              <p><b >Total: </b> <?php echo $obj2->getTotal(); ?> </p>
              <p><b >Fecha: </b> <?php echo $obj2->getFechaVenta(); ?> </p>
              <p><b >Id Cliente: </b> <?php echo $obj2->getId_Cliente(); ?> </p>
              <p><b >Direccion: </b> <?php echo $obj2->getDirreccionEnvio(); ?> </p>
              <p><b >Fecha de Entrega: </b> <?php echo $obj2->getFechaEntrega(); ?> </p>
              <p ><b >Estatus: </b> <?php echo $obj2->getEstatus();?> </p>
           
              <?php
            }else{
              ?>  <?php
            }//cierrr else 
            ?>  <?php
          }//cierre for
            ?>