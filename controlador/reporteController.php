<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tabla = "";
if(isset($_POST['tipoReport'])){

    switch ($_POST['tipoReport']) {
        case 'sueldosEmp':
            $i = 0;
            $sueldo = array();
            $nombreC = array();
            $reporte = $con-> reporteSueldoEmp();
                while($row = mysqli_fetch_array($reporte)){
                    $sueldo[$i] = $row['Sueldo'];
                    $nombreC[$i] = $row['Nombre']." ".$row['ApellidoP']." ".$row['ApellidoM'];
                    $i++;
                }
            $_SESSION['nombre'] = $nombreC;
            $_SESSION['sueldo'] = $sueldo;
            //echo "<script>window.location.replace('../administrador/reportEmpSueldo.php')</script>";       
            break;
        
        default:
            # code...
            break;
    }

}
