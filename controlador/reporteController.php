<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tabla = "";
if(isset($_POST['tipoReport'])){

    switch ($_POST['tipoReport']) {
        case 'sueldosEmp':
            $reporte = $con-> reporteSueldoEmp();
            $tabla = "<table class='table table-striped'>
                        <tr> 
                            <td>Nombre Completo</td>
                            <td>Sueldo</td>
                        </tr>";
                      
            break;
        
        default:
            # code...
            break;
    }

}

?>