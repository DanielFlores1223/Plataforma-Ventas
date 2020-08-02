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

function ordShell($arreglo){;
    $salto = count($arreglo) / 2;
    $tmp;
    $intercambio;
    
    while($salto > 0){
        do{
            $intercambio = false;
            
            for ($i = 0; ($i + $salto) < count($arreglo); $i++) {
                
                if($arreglo[$i]->getSueldo() > $arreglo[$i + $salto]->getSueldo()){
                    $tmp = $arreglo[$i];
                    $arreglo[$i] = $arreglo[$i + $salto];
                    $arreglo[$i + $salto] = $tmp;
                    
                    $intercambio = true;
                }                    
            }
            
        }while($intercambio);
        
        $salto = $salto/2;
    }

    return $arreglo;
}//cierra el metodo ordShell

$tabla = "";
if(isset($_POST['tipoReport'])){

    switch ($_POST['tipoReport']) {
        case 'sueldosEmp':
            $i=0;
            $empleado = array();
            $reporte = $con->reporteSueldoEmp();
            while($row = mysqli_fetch_array($reporte)){
                $empleado[$i] = new Empleado();
                $empleado[$i]->setNombre($row['Nombre']." ".$row['ApellidoP']." ".$row['ApellidoM']);
                $empleado[$i]->setSueldo($row['Sueldo']);
                $i++;
            }
            $empleado = ordShell($empleado);
            $_SESSION['emp'] = $empleado;
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

            case 'rmes':
                $objFecha = new DateTime($_POST['fecha'], new DateTimeZone('America/Mexico_City'));
                $mes = $objFecha->format('m');
                $year = $objFecha->format('Y');
                $i=0;
                $_SESSION['idVenta'] = array();
                $_SESSION['metodoPago'] = array();
                $_SESSION['tipo'] = array();
                $_SESSION['total'] = array();
                $_SESSION['fechaV'] = array();
                $_SESSION['nombre'] = array();
                $_SESSION['tel'] = array();
                $_SESSION['mes'] = $mes;
                $_SESSION['year'] = $year;
                $reporte = $con->reporteVentaMes($mes, $year);
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

            case 'ryear':
                $i=0;
                $_SESSION['idVenta'] = array();
                $_SESSION['metodoPago'] = array();
                $_SESSION['tipo'] = array();
                $_SESSION['total'] = array();
                $_SESSION['fechaV'] = array();
                $_SESSION['nombre'] = array();
                $_SESSION['tel'] = array();
                $_SESSION['year'] = $_POST['year'];
                $reporte = $con->reporteVentaYear($_POST['year']);
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
