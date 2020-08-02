<?php
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tabla = 'proveedor';
$articulos_x_pag = 3;
$paginas = 0;

//funciones
function desencriptar(){
    foreach ($_GET as $key => $data) {
        $data2 = $_GET[$key] = base64_decode(urldecode($data));
    }

    $desencrypt = (($data2 * 956783) /5678)/123456789;
    $id = round($desencrypt);

    return $id;
}

//Consultas de proveedores
if(isset($_POST['btnBuscarProv']) && $_POST['filtro'] != ""){
    //consulta con filtro
    $bus = $_POST['barraBusqueda'];
    $filtro = $_POST['filtro'];

    $res = $con->consultaBarraBusqueda("proveedor", $filtro, $bus);  

}elseif (isset($_POST['estatus']) && $_POST['estatus'] != "Todos") {
    //Consulta general dependiendo el estatus sin filtro
    $res = $con->consultaGeneralEstatus("proveedor", $_POST['estatus']);
    //echo "estoy en la segunda";

}else{
    //Consulta general para imprimir todos los registros
    $res = $con->consultaGeneral("proveedor");
    //Paginacion
    if($res != false){
        $total_rows = mysqli_num_rows($res);
        $paginas = $total_rows / $articulos_x_pag;
        $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2
 
    if(!$_GET['pagina']){
        header('Location: proveedores.php?pagina=1');
    }
/*
    if($_GET['pagina'] > $paginas || $_GET['pagina'] <= 0){
        header('Location: proveedores.php?pagina=1');
    }
*/

    $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
    $res = $con->consultaGeneralPaginacion('proveedor', $iniciar, $articulos_x_pag);
}        

}//cierra consultas de Proveedores

//Insertar Proveedor
if(isset($_POST['btnRegistrar']) ){
    $proveedor = new Proveedor();
    $proveedor->setNombreProv($_POST['nombreProv']);
    $proveedor->setNombreAgen($_POST['nombreAgente']);
    $proveedor->setTel($_POST['telefono']);
    $proveedor->setHorario($_POST['horario']);
    $proveedor->setCategoria($_POST['categoria']);
    $proveedor->setDireccion($_POST['direccion']);
    $proveedor->setEstatus("Activo");

    $result2 = $con->inserta("Proveedor",$proveedor);

    //Evaluamos si la incersion se hizo correctamente
    if($result2){
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Icorrect&pagina=1')</script>";
        
    }else{
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ix&pagina=1')</script>";
    }
    
}//cierra registro de proveedor

//Modificar Proveedor
if(isset($_GET['idMcomplete'])){
    $idM = desencriptar();

    $proveedor = new Proveedor();
    $proveedor->setIdProv($idM);
    $proveedor->setNombreProv($_POST['nombreProv']);
    $proveedor->setNombreAgen($_POST['nombreAgente']);
    $proveedor->setTel($_POST['telefono']);
    $proveedor->setHorario($_POST['horario']);
    $proveedor->setCategoria($_POST['categoria']);
    $proveedor->setDireccion($_POST['direccion']);

    $result3 = $con->modifica("Proveedor", $proveedor);
    //Evaluamos si la modificacion se hizo correctamente
    if($result3 != false){
        echo "lo hice";
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Mcorrect&pagina=1')</script>";

    }else{
        echo "no lo hice";
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Mx&pagina=1')</script>";
    }

}//cierra modificacion de proveedor

if(isset($_GET['actionCRUD'])){
    //mas informacion
    if($_GET['actionCRUD'] == "masDetalles"){
        $p = $_GET['p'];
        $idM = desencriptar();

        $proveedorMD = new Proveedor();
        $consultaMasDetalles = $con->consultaWhereId("Proveedor","Id_Proveedor",$idM);
        
        if($consultaMasDetalles != false){
            while ($reg = mysqli_fetch_array($consultaMasDetalles)) {
                $proveedorMD->setIdProv($idM);
                $proveedorMD->setNombreProv($reg[1]);
                $proveedorMD->setNombreAgen($reg[2]);
                $proveedorMD->setTel($reg[3]);
                $proveedorMD->setHorario($reg[4]);
                $proveedorMD->setCategoria($reg[5]);
                $proveedorMD->setDireccion($reg[6]);
                $proveedorMD->setEstatus($reg[7]);
            }
                $arregloProv = array($proveedorMD->getIdProv(), 
                                $proveedorMD->getNombreProv(), 
                                $proveedorMD->getNombreAgen(), 
                                $proveedorMD->getTel(), 
                                $proveedorMD->getHorario(),
                                $proveedorMD->getCategoria(),
                                $proveedorMD->getDireccion(),
                                $proveedorMD->getEstatus());
            
            $_SESSION['arregloProv'] = $arregloProv;
            echo "<script>window.location.replace('../$p/masInfoProv.php')</script>";   
        }else{
            echo "<script>window.location.replace('../administrador/proveedores.php&pagina=1')</script>"; 
        }
        
    //cierra actionCRUD = masDetalles     
    }elseif ($_GET['actionCRUD'] == "modificar") {
        $idM = desencriptar();
        //consulta de informacion para modificacion
        $proveedorM = new Proveedor();
        $consultaModificar = $con->consultaWhereId("Proveedor","Id_Proveedor",$idM);
            
            if($consultaModificar != false){
                while ($reg = mysqli_fetch_array($consultaModificar)) {
                    $proveedorM->setIdProv($idM);
                    $proveedorM->setNombreProv($reg[1]);
                    $proveedorM->setNombreAgen($reg[2]);
                    $proveedorM->setTel($reg[3]);
                    $proveedorM->setHorario($reg[4]);
                    $proveedorM->setCategoria($reg[5]);
                    $proveedorM->setDireccion($reg[6]);
                    $proveedorM->setEstatus($reg[7]);
                }
                    $arregloProvM = array($proveedorM->getIdProv(), 
                                    $proveedorM->getNombreProv(), 
                                    $proveedorM->getNombreAgen(), 
                                    $proveedorM->getTel(), 
                                    $proveedorM->getHorario(),
                                    $proveedorM->getCategoria(),
                                    $proveedorM->getDireccion(),
                                    $proveedorM->getEstatus());
            
                
                $_SESSION['arregloProvMod'] = $arregloProvM;
                echo "<script>window.location.replace('../administrador/formModificarProv.php')</script>";   
            }else{
                //echo "<script>window.location.replace('../administrador/proveedores.php&pagina=1')</script>"; 
            }
           
        //cierra actionCRUD = modificar
        }elseif ($_GET['actionCRUD'] == "eliminar") {
        
            if( isset($_GET['eliComplete'])){
                $id = desencriptar();
                
                $proveedorProducto = $con->consultaWhereId('producto','Id_Proveedor', $id);
                if($proveedorProducto != false){
                    //esta relacionado con un producto, sustituimos el estatus
                    $sustitucionEliminacion = $con->sustituirEliminar("Proveedor",$id);

                    //verificamos que se ejecute correctamente
                    if($sustitucionEliminacion){
                        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ecorrect&pagina=1')</script>"; 
                    }else{
                        
                        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ex&pagina=1')</script>"; 
                    }
                }else{
                    //no esta relacionado con ningun producto, se puede eliminar
                  $eliminacionCorrecta = $con->eliminar('Proveedor', $id);
                    //verificamos que se ejecute correctamente
                    if($eliminacionCorrecta){
                        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ecorrect&pagina=1')</script>"; 
                    }else{
                        
                        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ex&pagina=1')</script>"; 
                    }
                }

            }else{
                $idE = $_GET['idE'];
                echo "<script>window.location.replace('../administrador/confirmarELiminacion.php?pagina=1&tabla=proveedor&id=$idE')</script>";
            }
            
        }
        //cierra actionCRUD = eliminar

}//cierra if donde valida la actionCRUD

//reactivar proveedor
if(isset($_GET['idAct'])){
    $id = desencriptar();
    $exito = $con->reactivaEstatus('Proveedor', $id);

    if($exito != false){
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ecorrect&pagina=1')</script>"; 
    }else{
        echo "<script>window.location.replace('../administrador/proveedores.php?action=Ex&pagina=1')</script>"; 
    }
}

$con->cerrarDB();

?>