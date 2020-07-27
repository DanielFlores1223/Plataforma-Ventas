<?php 
session_start();
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){

    echo "AGREGANDO AL CARRITO";
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>