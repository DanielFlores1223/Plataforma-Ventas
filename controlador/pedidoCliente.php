<?php 
session_start();

if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj3 = new VentaOnline();
    include ('../modelo/cola.php');

    if(isset($_POST['btnConfirm'])){

        $cantPro=$obj->cantidadProducto($_POST['btnConfirm']);
        if($_POST['cantidad']>$cantPro){
            echo "<script>window.location.replace('../cliente/home.php?action=fail&pagina=1')</script>"; 
        }else{
            $obj2 = new Producto();
            $obj2=$obj->getProduct($obj2,$_POST['btnConfirm']);
            $obj3->setMetodoPago("Caja");
            //$obj3->setMetodoPago("Caja");
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
                $obj3->setFechaEntrega("");
                $obj3->setEstatus("Pendiente");
                $obj->inserta("VentaOnline",$obj3);
                
                /**IMPLENTACION  DE COLA*/

                //$Cola = new Nodo($obj3->getId_Venta);
                //$Cola=null;
                //$objCola = new Cola();
                //$objCola->encolar($Cola,$obj3->getId_Venta());


                
                /**TERMINO */
                echo "<script>window.location.replace('../cliente/home.php?action=pedido&pagina=1')</script>";
            }else{
                echo "NO SE ACTUALIZO";
            }
        }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail&pagina=1')</script>"; 
        } 
    }else{
        if(isset($_POST['masDetallesP'])){
            echo "<script>window.location.replace('../cliente/pedidoMasInfo.php')</script>";
        }else{
            echo "<script>window.location.replace('../cliente/home.php?pagina=1')</script>";
        }
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>