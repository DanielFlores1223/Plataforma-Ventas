<?php 
//session_start();  
if(isset($_GET['p'])){
    include("../modelo/conexion.php");
    include("../modelo/clases.php");
}else{
    include("modelo/conexion.php");
    include("modelo/clases.php");
}

    //Conexion a la base de datos
    $dbUser="root";
    $dbPass="";

    /*Controla servicios de la pagina principal*/
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
                        Se ha guardado tu petición, Ahora solo presiona el botón de recargar para realizar el pago.
                        <br>
                       <b>Nota:</b> Una vez realizado el pago y procesada la recarga te llegara un mensaje de Whatsapp
                    </div>';
                }
            }
        }
    }

    /* Controla servicios en pagina admin */
    if(isset($_POST['estatus'])){
        switch ($_POST['estatus']) {
            case 'Pendiente':
                $servicios = $con->consultaServicioVentaEstatus('Pendiente');
                break;

            case 'Completo':
                $servicios = $con->consultaServicioVentaEstatus('Completo');
                break;

            case 'Cancelado':
                $servicios = $con->consultaServicioVentaEstatus('Cancelado');
                break;

            case 'Todos':
                $servicios = $con->consultaServicioVenta();
                break;
        }


    }else{
        $servicios = $con->consultaServicioVentaEstatus('Pendiente');
    }

    if (isset($_GET['action'])) {
        
        switch ($_GET['action']) {
            case 'completo':
                $phone = $_GET['phone'];
                $exito = $con->actualizaPedidoEstatus($_GET['id'],'Completo');
                if ($exito != false) {
                    echo "<script>window.location.replace('https://api.whatsapp.com/send?phone=52$phone&text=Hola,%20Tu%20recarga%20fue%20procesada%20correctamente!')</script>";
                }
                break;
            case 'cancel':
                $phone = $_GET['phone'];
                $exito = $con->actualizaPedidoEstatus($_GET['id'],'Cancelado');
                if ($exito != false) {
                    echo "<script>window.location.replace('https://api.whatsapp.com/send?phone=52$phone&text=Hola,%20Tu%20recarga%20fue%20cancelada%20por%20el%20siguiente%20motivo:%20(escribe%20el%20motivo)')</script>";
                }
                break;
            
        }

    }
    

?>