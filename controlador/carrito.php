<?php 
session_start();
include('../cliente/barraCliente.php');
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();

    if(isset($_POST['removerP'])){
        $idProducto=$_POST['removerP'];
        $idVenta=$obj->getCarritoId($_SESSION['id']);

        if($obj->eliminarDeCarrito($idVenta,$idProducto)){
            echo "<script>window.location.replace('../cliente/carrito.php?action=removido')</script>";
         }else{
            echo "<script>window.location.replace('../cliente/carrito.php?action=fail')</script>";
        }
    }

    if(isset($_POST['masDetallesP'])){
        
        $idP = $_POST['masDetallesP'];
            $obj2=$obj->getProduct($obj2,$idP); ?>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="../cliente/carrito" class="btn btn-light">Regresar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Más detalles</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <img src="<?php echo  $obj2->getFoto() != "" ? '../'.$obj2->getFoto() : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
                            </div>
                            <div class="col-sm-12 col-md-9 col-lg-9">
                                <p class="h3 font-weight-light"><?php echo $obj2->getNombreProd(); ?> </p>
                                <p><b class="text-info">Categoria: </b> <?php echo $obj2->getCategoria(); ?> </p>
                                <p><b class="text-info">Sub Categoria: </b> <?php echo $obj2->getSubCat();?> </p>
                                <p><b class="text-info">Precio: </b> <b class="text-success"><?php echo $obj2->getPrecio(); ?></b> pesos.</p>
                                <p><b class="text-info">Descripcion: </b> <?php echo $obj2->getDescripcion(); ?> </p>
                            </div>
                        </div>
                        <hr  style="border-top: .3rem solid rgb(224, 191, 3);">
                    </div>
                </div>
            </div> <?php
    }

    if(isset($_POST['btnConfirm'])){
        //aqui esta el pedo
        $cantPro=$obj->cantidadProducto($_POST['btnConfirm']);
        if($_POST['cantidad']>$cantPro){
            echo "<script>window.location.replace('../cliente/home.php?action=fail&pagina=1')</script>"; 
        }else{
            $obj2 = new Producto();
            $obj2=$obj->getProduct($obj2,$_POST['btnConfirm']);
            $obj3->setMetodoPago("Caja");
            $obj3->setTipo("Online");
            $obj3->setTotal($obj2->getPrecio()*$_POST['cantidad']);
            $obj3->setFechaVenta(date("Y-m-d"));
            $obj3->setId_Cliente($_SESSION['id']);
            $existencia=$obj2->getExistencia();
        }
        

        if($obj->inserta("Venta",$obj3)==true){
            $existencia=$existencia-$_POST['cantidad'];
            if($obj->updateCantidadProducto($existencia,$_POST['btnConfirm'])==true){
                $objTiene=new Tiene();
                $idV=$obj->getLastIdVent();
                $objTiene->setId_Venta($idV);
                $objTiene->setId_Producto($_POST['btnConfirm']);
                $obj->inserta("Tiene",$objTiene);
                $obj3->setId_VentaOnline($idV);
                $obj3->setDirreccionEnvio("NULA");
                $obj3->setFechaEntrega("2020-07-29");
                $obj3->setEstatus("Pendiente");
                $obj->inserta("VentaOnline",$obj3);
                echo "<script>window.location.replace('../cliente/home.php?action=pedido&pagina=1')</script>";
            }else{
                echo "NO SE ACTUALIZO";
            }
        }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail&pagina=1')</script>"; 
        } 
        //aqui esta el pedo
    }

    if(isset($_POST['idInfo'])){

        echo "<script>window.location.replace('../cliente/home.php?action=mostrar')</script>";
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>