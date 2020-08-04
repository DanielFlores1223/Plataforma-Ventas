<?php
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

if((isset($_SESSION['usuario']) && isset($_SESSION['contra']))){
    $obj= new ConexionMySQL("root","");
    if(isset($_POST['actualizar'])){
        if($obj->actualizaPedidoEstatus($_POST['actualizar'],$_POST['estatusP'])==true){
            if($obj->setEmpleadoID($_POST['actualizar'],$_SESSION['idE'])==true){
                if($_POST['estatusP']=='Completo'){
                    if($_SESSION['tipo']!='ADMIN'){
                        echo "<script>window.location.replace('../empleado/pedido.php?action=Completo&estatus=".$_SESSION['estatus']."&pagina=1')</script>";
                    }else{
                        echo "<script>window.location.replace('../administrador/pedido.php?action=Completo&estatus=".$_SESSION['estatus']."&pagina=1')</script>";
                    }
                }else if($_POST['estatusP']=='Cancelado'){
                    if($_SESSION['tipo']!='ADMIN'){
                        echo "<script>window.location.replace('../empleado/pedido.php?action=Cancelado&estatus=".$_SESSION['estatus']."&pagina=1')</script>";
                    }else{
                        echo "<script>window.location.replace('../administrador/pedido.php?action=Cancelado&estatus=".$_SESSION['estatus']."&pagina=1')</script>";
                    }
                }            }
        }else{
            echo "<script>window.location.replace('../administrador/pedido.php?action=fail&pagina=1')</script>";
        }
    }

    if(isset($_POST['masDetallesP'])){
        if($_SESSION['tipo']=='ADMIN'){
            include ("../administrador/barraAdmin.php");
        }else{
            include ("../empleado/barraEmpleado.php");
        }
        
        $idPedido = $_POST['masDetallesP'];
        $obj2= new VentaOnline();
        $objTiene= new Tiene();
        $objp= new Producto();
        $obj2=$obj->getPedido($obj2,$idPedido);
        $objTiene=$obj->getPedidoTiene($objTiene,$idPedido);
        $infoP=$obj->getProduct($objp,$objTiene->getId_Producto());?>
        <div class="container">
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
          <?php if($_SESSION['tipo']=='ADMIN'){ ?>
            <a href="../administrador/pedido.php?estatus=<?php echo $_SESSION['estatus'];?>&pagina=1" class="btn btn-light">Regresar</a>
            <?php
          }else{
              ?>
              <a href="../empleado/pedido.php?estatus=<?php echo $_SESSION['estatus'];?>&pagina=1" class="btn btn-light">Regresar</a>
         <?php } ?>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Más detalles</a>
      </li>
    </ul>
  </div>
  <div class="card-body" >
    <div class="row">
        <div class="col-3">
            <img src="<?php echo  $infoP->getFoto() != "" ? '../'.$infoP->getFoto() : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
        </div>
        <div class="col-4">
            <h5 class="font-weight-light">Información del Producto</h5>
            <p><b class="text-info">Producto: </b> <?php echo $infoP->getNombreProd(); ?> </p>
            <p><b class="text-info">Categoria: </b> <?php echo $infoP->getCategoria(); ?> </p>
            <p><b class="text-info">Sub Categoria: </b> <?php echo $infoP->getSubCat();?> </p>
            <p><b class="text-info">Precio: </b> <?php echo $infoP->getPrecio(); ?> </p>
            <p><b class="text-info">Descripcion: </b> <?php echo $infoP->getDescripcion(); ?> </p>
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
            <p class="table-warning" ><b class="text-info">Estatus: </b> <?php echo $obj2->getEstatus();?> </p>
        </div>
    </div>
    <hr  style="border-top: .3rem solid rgb(224, 191, 3);">
  </div>
</div>
</div> 
<?php
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
