<?php 
session_start();
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){

    if(isset($_POST['idComprar'])){
        //echo "Comprando a pedido el producto con codigo ".$_POST['idComprar'];
        echo "<script>window.location.replace('../cliente/home.php?action=comprado')</script>";
    }

    if(isset($_POST['idAgregar'])){
        echo "<script>window.location.replace('../cliente/home.php?action=agregado')</script>";  
    }

    if(isset($_POST['idInfo'])){

        echo "<script>window.location.replace('../cliente/home.php?action=mostrar')</script>";
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>