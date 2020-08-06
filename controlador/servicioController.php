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
        $fecha = date('Y-m-d');
        $ventaRecarga = new Venta();
        $ventaRecarga = $con->setMetodoPago("Online");
        $ventaRecarga = $con->setTipo("Recarga");
        $ventaRecarga = $con->setTotal($_POST['recarga']);
        $ventaRecarga = $con->setFechaVenta($fecha);
        $ventaRecarga = $con->setId_Cliente("0");
        
        $con->inserta('Venta',$ventaRecarga);
        $ventaReg = $con->consultaWhereAND('Venta','Total',$_POST['recarga'], 'FechaVenta', $fecha);
        $ventaReg = mysqli_fetch_array($ventaReg);
        $idVenta = $ventaReg['Id_Venta'];

        $con->inserta('Brinda',$ventaRecarga);
    }


?>