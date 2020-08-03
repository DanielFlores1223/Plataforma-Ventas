<?php
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

if((isset($_SESSION['usuario']) && isset($_SESSION['contra']))){
    $obj= new ConexionMySQL("root","");
    if(isset($_POST['actualizar'])){
        if($obj->actualizaPedidoEstatus($_POST['actualizar'],$_POST['estatusP'])==true){
            echo "<script>window.location.replace('../administrador/pedido.php?pagina=1')</script>";
        }else{
            echo "<script>window.location.replace('../administrador/pedido.php?pagina=1')</script>";
        }
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}

