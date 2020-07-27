<?php 
session_start();
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){

    echo "Opciones para ver el producto";
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>