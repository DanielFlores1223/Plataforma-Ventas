<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");
//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tablaBD = 'cliente';
$tabla = 'Cliente';
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

//consultas
if (isset($_POST['btnBuscarCli']) && $_POST['filtro'] != "") {
    //consulta con filtro
    $bus = $_POST['barraBusquedaCli'];
    $filtro = $_POST['filtro'];
    $res = $con->consultaBarraBusqueda($tablaBD, $filtro, $bus);

}elseif(isset($_POST['estatus']) && $_POST['estatus'] != "Todos"){ 
    //Consulta general dependiendo el estatus sin filtro
    $res = $con->consultaGeneralEstatus($tablaBD, $_POST['estatus']);
}else{
        //Consulta general para imprimir todos los registros
        $res = $con->consultaGeneral($tablaBD);        
        if($res != false){
            //Paginacion
            $total_rows = mysqli_num_rows($res);
            $paginas = $total_rows / $articulos_x_pag;
            $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2

            $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
            $res = $con->consultaGeneralPaginacion($tablaBD, $iniciar, $articulos_x_pag);
        }
}


//inserta cliente
if(isset($_POST['btnRegCliente'])){
    $clienteI = new Cliente();
    $clienteI->setNombre($_POST['nombre']);
    $clienteI->setApellidoP($_POST['a_pat']);
    $clienteI->setApellidoM($_POST['a_mat']);
    $clienteI->setTel($_POST['telefono']);
    $clienteI->setFechaNac($_POST['fechaNac']);
    $clienteI->setCorreo($_POST['correo']);
    $clienteI-> setContra($_POST['contra']);

    $correo = $clienteI->getCorreo();
    //validamos que el correo no exista
    $correoInexistenteC = $con->consultaWhereId($tabla,'correo', $correo);
    $correoInexistenteE = $con->consultaWhereId('empleado','correo', $correo);

    if($correoInexistenteC == false && $correoInexistenteE == false){
        $insertarCliente = $con->inserta($tabla,$clienteI);

        if($insertarCliente != false){
            echo "<script>window.location.replace('../administrador/clientes.php?action=Icorrect&pagina=1')</script>";
        }else{
            echo "<script>window.location.replace('../administrador/clientes.php?action=Ix&pagina=1')</script>";
        }

    }else{
        echo "<script>window.location.replace('../administrador/clientes.php?action=Ixcorreo&pagina=1')</script>";
    }
}
//termina insertar cliente

//Acciones del CRUD
if(isset($_GET['actionCRUD'])){

    if($_GET['actionCRUD'] == 'modificar' || $_GET['actionCRUD'] == 'masDetalles'){        
        $action = $_GET['actionCRUD'];
        $idM = desencriptar();
        $regCli = $con->consultaWhereId($tablaBD,"Id_Cliente",$idM);
        $regCli = mysqli_fetch_array($regCli);
        
        if($regCli != false){
                $clienteM = new Cliente();
                $clienteM->setIdCli($regCli[0]);
                $clienteM->setNombre($regCli[1]);
                $clienteM->setApellidoP($regCli[2]);
                $clienteM->setApellidoM($regCli[3]);                
                $clienteM->setTel($regCli[4]);
                $clienteM->setFechaNac($regCli[5]);
                $clienteM->setCorreo($regCli[7]);
            
                $arregloCli = array($clienteM->getIdCli(),
                                    $clienteM->getNombre(),
                                    $clienteM->getApellidoP(),
                                    $clienteM->getApellidoM(),
                                    $clienteM->getTel(),
                                    $clienteM->getFechaNac(),
                                    $clienteM->getCorreo());

                $_SESSION['cliente'] = $arregloCli;
    
                if($action == 'modificar'){
                    echo "<script>window.location.replace('../administrador/formModificarCli.php')</script>";
                
                }elseif ($action == 'masDetalles'){
                    echo "<script>window.location.replace('../administrador/masInfoCli.php')</script>"; 
                
                }    
        }       
    }

    if($_GET['actionCRUD'] == 'mComplete'){
        $idM = desencriptar();

        $clienteMC = new Cliente();
        $clienteMC->setIdCli($idM);
        $clienteMC->setNombre($_POST['nombre']);
        $clienteMC->setApellidoP($_POST['a_pat']);
        $clienteMC->setApellidoM($_POST['a_mat']);                
        $clienteMC->setTel($_POST['telefono']);
        $clienteMC->setFechaNac($_POST['fechaNac']);
        $clienteMC->setCorreo($_POST['correo']);

        $correo = $clienteMC->getCorreo();
        $correoSinCambios = $con->consultaWhereAND($tablaBD,'Id_Cliente',$idM, 'Correo', $correo);

        if($correoSinCambios != false){
            $modificacionCorrecta = $con->modifica($tabla, $clienteMC);

            if($modificacionCorrecta != false){
                echo "<script>window.location.replace('../administrador/clientes.php?action=Mcorrect&pagina=1')</script>";
            }else{
                echo "<script>window.location.replace('../administrador/clientes.php?action=Mx&pagina=1')</script>";
            }
            
        }else{
                //validamos que el correo no exista
                $correoInexistenteC = $con->consultaWhereId($tabla,'correo', $correo);
                $correoInexistenteE = $con->consultaWhereId('empleado','correo', $correo);
                
                if($correoInexistenteC == false && $correoInexistenteE == false){
                    $modificacionCorrecta = $con->modifica($tabla, $clienteMC);
                
                    if($modificacionCorrecta != false){
                        echo "<script>window.location.replace('../administrador/clientes.php?action=Mcorrect&pagina=1')</script>";
                    }else{
                        echo "<script>window.location.replace('../administrador/clientes.php?action=Mx&pagina=1')</script>";
                    }
                
                }else{
                    echo "<script>window.location.replace('../administrador/formModificarCli.php?action=Ixcorreo&pagina=1')</script>";
                 }
             }
    }

}
//cierra acciones del CRUD

//Cerramos la base de datos
$con->cerrarDB();

?>