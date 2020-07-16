<?php  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

//Consulta general para imprimir todos los registros
$res = $con->consultaGeneral("proveedor");

$_SESSION['arreglo2'] = $res;

//Insertar Proveedor
if(isset($_POST['nombreProv'])){
    $proveedor = new Proveedor();
    $proveedor->setNombreProv($_POST['nombreProv']);
    $proveedor->setNombreAgen($_POST['nombreAgente']);
    $proveedor->setTel($_POST['telefono']);
    $proveedor->setHorario($_POST['horario']);
    $proveedor->setCategoria($_POST['categoria']);
    $proveedor->setDireccion($_POST['direccion']);

    echo "aqui".$proveedor->getNombreProv();
    $result = $con->inserta("Proveedor",$proveedor);

    $_SESSION['insertarMSJ'] = $result;

    echo "<script>window.location.replace('../administrador/proveedores.php')</script>";
}




?>