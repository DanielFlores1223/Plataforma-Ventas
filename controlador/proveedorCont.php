<?php
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

if(isset($_POST['btnBuscarProv']) && $_POST['filtro'] != ""){
    //consulta con filtro
    $bus = $_POST['barraBusqueda'];
    $filtro = $_POST['filtro'];
    $res = $con->consultaBarraBusqueda("proveedor",$filtro,$bus);

}else{
    //Consulta general para imprimir todos los registros
    $res = $con->consultaGeneral("proveedor");
}

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
    
}//cierra registro de proveedor

//Modificar Proveedor
if(isset($_GET['idMcomplete'])){
    $proveedor = new Proveedor();
    $proveedor->setIdProv($_GET['idMcomplete']);
    $proveedor->setNombreProv($_POST['nombreProv']);
    $proveedor->setNombreAgen($_POST['nombreAgente']);
    $proveedor->setTel($_POST['telefono']);
    $proveedor->setHorario($_POST['horario']);
    $proveedor->setCategoria($_POST['categoria']);
    $proveedor->setDireccion($_POST['direccion']);

    $result3 = $con->modifica("Proveedor", $proveedor);
    //$p = array($proveedor->getNombreProv(), $proveedor->getNombreAgen());
    //$_SESSION['p'] = $p;
   
    //Evaluamos si la modificacion se hizo correctamente
    if($result3 != false){
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Mcorrect')</script>";

    }else{
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Mx')</script>";
    }

}//cierra modificacion de proveedor

if(isset($_GET['actionCRUD'])){
    //mas informacion
    if($_GET['actionCRUD'] == "masDetalles"){
        $proveedorMD = new Proveedor();
        $consultaMasDetalles = $con->consultaWhereId("Proveedor","Id_Proveedor",$_GET['idMD']);
        
        if($consultaMasDetalles != false){
            while ($reg = mysqli_fetch_array($consultaMasDetalles)) {
                $proveedorMD->setIdProv($_GET['idMD']);
                $proveedorMD->setNombreProv($reg[1]);
                $proveedorMD->setNombreAgen($reg[2]);
                $proveedorMD->setTel($reg[3]);
                $proveedorMD->setHorario($reg[4]);
                $proveedorMD->setCategoria($reg[5]);
                $proveedorMD->setDireccion($reg[6]);
            }
                $arregloProv = array($proveedorMD->getIdProv(), 
                                $proveedorMD->getNombreProv(), 
                                $proveedorMD->getNombreAgen(), 
                                $proveedorMD->getTel(), 
                                $proveedorMD->getHorario(),
                                $proveedorMD->getCategoria(),
                                $proveedorMD->getDireccion());
            
            $_SESSION['arregloProv'] = $arregloProv;
            echo "<script>window.location.replace('../administrador/masInfoProv.php')</script>";   
        }else{
            echo "<script>window.location.replace('../administrador/proveedores.php')</script>"; 
        }
        
    //cierra actionCRUD = masDetalles     
    }elseif ($_GET['actionCRUD'] == "modificar") {
        //consulta de informacion para modificacion
        $proveedorM = new Proveedor();
        $consultaModificar = $con->consultaWhereId("Proveedor","Id_Proveedor",$_GET['idM']);
            
            if($consultaModificar != false){
                while ($reg = mysqli_fetch_array($consultaModificar)) {
                    $proveedorM->setIdProv($_GET['idM']);
                    $proveedorM->setNombreProv($reg[1]);
                    $proveedorM->setNombreAgen($reg[2]);
                    $proveedorM->setTel($reg[3]);
                    $proveedorM->setHorario($reg[4]);
                    $proveedorM->setCategoria($reg[5]);
                    $proveedorM->setDireccion($reg[6]);
                }
                    $arregloProvM = array($proveedorM->getIdProv(), 
                                    $proveedorM->getNombreProv(), 
                                    $proveedorM->getNombreAgen(), 
                                    $proveedorM->getTel(), 
                                    $proveedorM->getHorario(),
                                    $proveedorM->getCategoria(),
                                    $proveedorM->getDireccion());
                
                $_SESSION['arregloProvMod'] = $arregloProvM;
                echo "<script>window.location.replace('../administrador/formModificarProv.php')</script>";   
            }else{
                echo "<script>window.location.replace('../administrador/proveedores.php')</script>"; 
            }
           
    }//cierra actionCRUD = modificar

}//cierra if donde valida la actionCRUD

$con->cerrarDB();

?>