<?php 
session_start();

if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj3 = new Venta();

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
        }
        

        if($obj->inserta("Venta",$obj3)==true){
            echo "<script>window.location.replace('../cliente/home.php?action=pedido')</script>"; 
        }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail')</script>"; 
        } 
    }else{
        echo "<script>window.location.replace('../cliente/home.php')</script>";
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>