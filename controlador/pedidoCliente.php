<?php 
session_start();

if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();

    echo $_POST['btnConfirm'];
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>