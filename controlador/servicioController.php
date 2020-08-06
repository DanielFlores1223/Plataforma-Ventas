<?php 
//session_start();  
include("modelo/conexion.php");
include("modelo/clases.php");

    //Conexion a la base de datos
    $dbUser="root";
    $dbPass="";
    $con = new ConexionMySQL($dbUser,$dbPass);
    if(isset($_POST['compañia']) && isset($_POST['recarga'])){
       $res = $con->consultaServicio($_POST['compañia'], $_POST['recarga']);
       $res = mysqli_fetch_array($res);
       $id_servicio = $res['Id_Servicio'];
       $boton = $res['Boton']; 
       //echo $id_servicio;  
    }

    if(isset($_POST['btn-recarga'])){
        //insertamos la venta y la info de la tabla brinda
        //echo $id_servicio;
    }


?>