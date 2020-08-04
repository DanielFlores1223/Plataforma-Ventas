<?php 
session_start();

if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj3 = new VentaOnline();

    if(isset($_POST['btnConfirm'])){
        $cantPro=$obj->cantidadProducto($_POST['btnConfirm']);
        if($_POST['cantidad']>$cantPro){
            echo "<script>window.location.replace('../cliente/home.php?action=fail')</script>"; 
        }else{
            $obj2 = new Producto();
            $obj2=$obj->getProduct($obj2,$_POST['btnConfirm']);
            $obj3->setMetodoPago("Caja");
            $obj3->setTipo("Online");
            $obj3->setTotal($obj2->getPrecio()*$_POST['cantidad']);
            $obj3->setFechaVenta("2020-07-29");
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
                echo "<script>window.location.replace('../cliente/home.php?action=pedido')</script>";
            }else{
                echo "NO SE ACTUALIZO";
            }
        }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail')</script>"; 
        } 
    }else{
        if(isset($_POST['masDetallesP'])){
            echo "<script>window.location.replace('../cliente/pedidoMasInfo.php')</script>";
        }else{
            echo "<script>window.location.replace('../cliente/home.php')</script>";
        }
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>