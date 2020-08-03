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
                    echo "<script>window.location.replace('../administrador/pedido.php?action=Completo&pagina=1')</script>";
                }else if($_POST['estatusP']=='Cancelado'){
                    echo "<script>window.location.replace('../administrador/pedido.php?action=Cancelado&pagina=1')</script>";
                }            }
        }else{
            echo "<script>window.location.replace('../administrador/pedido.php?action=fail&pagina=1')</script>";
        }
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}

