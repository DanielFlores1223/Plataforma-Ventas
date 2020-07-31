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
            break;
        case 'prodSurt':
            $i = 0;
            $id_Prod = array();
            $NombreProd = array();
            $existencia = array();
            $precio = array();
            $nombre_prov = array();
            $nombre_agen = array();
            $tel = array();
            $horario = array();
            $reporte = $con->reporteProdSurt();
                while($row = mysqli_fetch_array($reporte)){
                    $id_Prod[$i] = $row['Id_Producto'];
                    $NombreProd[$i] = $row['NombreProd'];
                    $existencia[$i] = $row['Existencia'];
                    $precio[$i] = $row['Precio'];
                    $nombre_prov[$i] = $row['Nombre_Proveedor'];
                    $nombre_agen[$i] = $row['Nombre_Agente'];
                    $tel[$i] = $row['Telefono'];
                    $horario[$i] = $row['Horario'];
                    $i++;
                }
             $_SESSION['idProd'] = $id_Prod;
             $_SESSION['NombreProd'] = $NombreProd;
             $_SESSION['existencia'] = $existencia;
             $_SESSION['precio'] = $precio;
             $_SESSION['n_prov'] = $nombre_prov;
             $_SESSION['n_agen'] = $nombre_agen;
             $_SESSION['tel'] = $tel;
             $_SESSION['horario'] = $horario;

            break;
        
        case 'rdia':
            $i=0;
            $_SESSION['idVenta'] = array();
            $_SESSION['metodoPago'] = array();
            $_SESSION['tipo'] = array();
            $_SESSION['total'] = array();
            $_SESSION['fechaV'] = array();
            $_SESSION['nombre'] = array();
            $_SESSION['tel'] = array();
            $ganacia = 0;
            $reporte = $con->reporteVentaDia($_POST['fecha']);
                while($row = mysqli_fetch_array($reporte)){
                    $ganacia += $row['Total'];
                    $_SESSION['idVenta'][$i] = $row['Id_Venta']; 
                    $_SESSION['metodoPago'][$i] = $row['MetodoPAgo'];
                    $_SESSION['tipo'][$i] = $row['Tipo'];
                    $_SESSION['total'][$i] = $row['Total'];
                    $_SESSION['fechaV'][$i] = $row['FechaVenta'];
                    $_SESSION['nombre'][$i] = $row['Nombre'];
                    $_SESSION['tel'][$i] = $row['Telefono'];
                    $i++;
                }
            $_SESSION['ganancia'] = $ganacia;

            break;
            
    }

}
