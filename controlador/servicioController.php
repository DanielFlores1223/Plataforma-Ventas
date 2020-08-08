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
        $ventaRecarga->setMetodoPago("Online");
        $ventaRecarga->setTipo("Recarga");
        $ventaRecarga->setTotal($_POST['recarga']);
        $ventaRecarga->setFechaVenta($fecha);
        $ventaRecarga->setId_Cliente("0");
        
        $insertaVenta = $con->inserta('Venta',$ventaRecarga);

        if($insertaVenta != false){
            $ventaReg = $con->consultaWhereAND3('Venta','Total',$_POST['recarga'], 'FechaVenta', $fecha, 'Tipo','Recarga');
            
            //en este while agarramos la ultima id de la venta
            while ($row =  mysqli_fetch_array($ventaReg)) {
                $idVenta = $row['Id_Venta'];
            }
            
            //insertamos en la tabla ventaOnline
            $recargaVO = new VentaOnline();
            $recargaVO->setId_VentaOnline($idVenta);
            $recargaVO->setDirreccionEnvio("No hay");
            $recargaVO->setFechaEntrega($fecha);
            $recargaVO->setEstatus("Pendiente");

            $insertaVO = $con->inserta('VentaOnline',$recargaVO);

            if($insertaVO != false){
                $brinda = new Brinda();
                $brinda->setId_Venta($idVenta);
                $brinda->setId_Servicio($id_servicio);
                $brinda->setNumCel($_POST['tel']);

                $insertaBrinda = $con->inserta('Brinda',$brinda);
                if ($insertaBrinda != false) {
                    echo '<div class="alert alert-success text-center mt-1 mx-5" role="alert">
                        Se ha guardado tu peticion, Ahora solo presiona el boton de recargar para realizar el pago.
                    </div>';
                }
            }
        }
    }


?>