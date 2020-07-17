<?php  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);
$_SESSION['msj'] = "";

//Consulta general para imprimir todos los registros
$res = $con->consultaGeneral("proveedor");

$_SESSION['arreglo2'] = $res;

//Insertar Proveedor
if(isset($_POST['btnRegistrar']) ){
    $proveedor = new Proveedor();
    $proveedor->setNombreProv($_POST['nombreProv']);
    $proveedor->setNombreAgen($_POST['nombreAgente']);
    $proveedor->setTel($_POST['telefono']);
    $proveedor->setHorario($_POST['horario']);
    $proveedor->setCategoria($_POST['categoria']);
    $proveedor->setDireccion($_POST['direccion']);

    $result2 = $con->inserta("Proveedor",$proveedor);

    //Evaluamos si la incersion se hizo correctamente
    if($result2){
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Icorrect')</script>";
        
    }else{
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ix')</script>";
    }
    
}

//Modificar Proveedor
if(isset($_GET['id'])){
    $proveedor = new Proveedor();
    $proveedor->setIdProv($_GET['id']);
    $proveedor->setNombreProv($_POST['nombreProv']);
    $proveedor->setNombreAgen($_POST['nombreAgente']);
    $proveedor->setTel($_POST['telefono']);
    $proveedor->setHorario($_POST['horario']);
    $proveedor->setCategoria($_POST['categoria']);
    $proveedor->setDireccion($_POST['direccion']);

    $result3 = $con->modifica("Proveedor", $proveedor);

    //Evaluamos si la modificacion se hizo correctamente
    if($result3 != false){
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Mcorrect')</script>";

    }else{
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Mx')</script>";
    }

    
}


?>