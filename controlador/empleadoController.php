<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

//variables generales
$tabla = 'Empleado';
$articulos_x_pag = 5;
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
if (isset($_POST['btnBuscarEmp']) && $_POST['filtro'] != "") {
    //consulta con filtro
    $bus = $_POST['barraBusquedaEmp'];
    $filtro = $_POST['filtro'];
    $res = $con->consultaBarraBusqueda("empleado", $filtro, $bus);
    //Paginacion
    /*$total_rows = mysqli_num_rows($res);
    $paginas = $total_rows / $articulos_x_pag;
    $paginas = ceil($paginas);

    $iniciar = ($_GET['paginaConsulta'] - 1) * $articulos_x_pag;
    $res = $con->consultaBarraBusquedaPag('empleado', $filtro, $bus, $iniciar, $articulos_x_pag);
        */
  
    //if($res == false)
       // echo "NO se hizo";
}elseif(isset($_POST['estatus']) && $_POST['estatus'] != "Todos"){ //isset($_POST['btnBuscarEmp']) && $_POST['filtro'] == ""
    //Consulta general dependiendo el estatus sin filtro
    $res = $con->consultaGeneralEstatus("empleado", $_POST['estatus']);
}else{
        //Consulta general para imprimir todos los registros
        $res = $con->consultaGeneral("empleado");
        //Paginacion
        $total_rows = mysqli_num_rows($res);
        $paginas = $total_rows / $articulos_x_pag;
        $paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2
        
        
        $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
        $res = $con->consultaGeneralPaginacion('empleado', $iniciar, $articulos_x_pag);
}

//Insertar empleado a la base de datos
if(isset($_POST['btnRegistrarEmp'])){
    $empleadoI = new Empleado();
    $empleadoI->setNombre($_POST['nombre']);
    $empleadoI->setApellidoM($_POST['a_mat']);
    $empleadoI->setApellidoP($_POST['a_pat']);
    $empleadoI->setTel($_POST['telefono']);
    $empleadoI->setFechaNac($_POST['fechaNac']);
    $empleadoI->setCorreo($_POST['correo']);
    $empleadoI->setContra($_POST['pass']);
    $empleadoI->setSueldo($_POST['sueldo']);
    $empleadoI->setTipo($_POST['tipo']);
    $empleadoI->setEstatus('Activo');
    //insertamos foto del empleado
    $foto = $_FILES['foto']['name'];
    $ruta = $_FILES["foto"]["tmp_name"];
    $destino = "../img/fotoEmpleado/".$foto;
    copy($ruta,$destino);
    $empleadoI->setFoto($destino);
    echo $empleadoI->getFoto();
    $correo = $empleadoI->getCorreo();
    //Validar que el correo no exista en la base de datos
    $existeCorreo = $con->consultaWhereId($tabla,'correo', $correo);

    if($existeCorreo == false){
        $resI = $con->inserta($tabla,$empleadoI);
        if($resI != false){
            echo "<script>window.location.replace('../administrador/empleados.php?action=Icorrect&pagina=1')</script>";
        }else{
            echo "<script>window.location.replace('../administrador/empleados.php?action=Ix&pagina=1')</script>";
        }
    }else{
        echo "<script>window.location.replace('../administrador/empleados.php?action=Ixcorreo&pagina=1')</script>";
    }
}
//Termina Insertar empleado a la base de datos

//acciones rapidas del CRUD
if(isset($_GET['actionCRUD'])){
    
    if($_GET['actionCRUD'] == 'modificar' || $_GET['actionCRUD'] == 'masDetalles'){        
        $action = $_GET['actionCRUD'];
        $idM = desencriptar();

        $empleadoM = new Empleado();
        $empM = $con->consultaWhereId($tabla,"Id_Empleado",$idM);
        
        if($empM != false){
            while ($reg = mysqli_fetch_array($empM)) {
                $empleadoM->setIdEmpl($reg[0]);
                $empleadoM->setNombre($reg[1]);
                $empleadoM->setApellidoP($reg[2]);
                $empleadoM->setApellidoM($reg[3]);
                $empleadoM->setTel($reg[4]);
                $empleadoM->setFechaNac($reg[5]);
                $empleadoM->setCorreo($reg[6]);
                $empleadoM->setContra($reg[7]);
                $empleadoM->setSueldo($reg[8]);
                $empleadoM->setTipo($reg[9]);
                $empleadoM->setEstatus($reg[10]);
                $empleadoM->setFoto($reg[11]);  
                
                $arregloEmp = array($empleadoM->getIdEmpl(),
                                    $empleadoM->getNombre(),
                                    $empleadoM->getApellidoP(),
                                    $empleadoM->getApellidoM(),
                                    $empleadoM->getTel(),
                                    $empleadoM->getFechaNac(),
                                    $empleadoM->getCorreo(),
                                    $empleadoM->getContra(),
                                    $empleadoM->getSueldo(),
                                    $empleadoM->getTipo(),
                                    $empleadoM->getEstatus(),
                                    $empleadoM->getFoto());
                
                $_SESSION['empleado'] = $arregloEmp;
          

                if($action == 'modificar'){
                    echo "<script>window.location.replace('../administrador/formModificarEmp.php')</script>";
                
                }elseif ($action == 'masDetalles'){
                    echo "<script>window.location.replace('../administrador/masInfoEmp.php')</script>"; 
                
                }    

            }//cierra while
        }//cierra if

    //modificar Empleado
    }elseif($_GET['actionCRUD'] == "mComplete"){
        
        $idM = desencriptar();

        $empleadoMC = new Empleado();
        $empleadoMC->setIdEmpl($idM);
        $empleadoMC->setNombre($_POST['nombre']);
        $empleadoMC->setApellidoM($_POST['a_mat']);
        $empleadoMC->setApellidoP($_POST['a_pat']);
        $empleadoMC->setTel($_POST['telefono']);
        $empleadoMC->setFechaNac($_POST['fechaNac']);
        $empleadoMC->setCorreo($_POST['correo']);
        $empleadoMC->setSueldo($_POST['sueldo']);
        $empleadoMC->setTipo($_POST['tipo']);

        $correo = $empleadoMC->getCorreo();
        $id = $empleadoMC->getIdEmpl();
        
        //validacion del cambio de foto
        if(isset($_FILES['foto'])){
            //insertamos foto del empleado
            $foto = $_FILES['foto']['name'];
            $ruta = $_FILES["foto"]["tmp_name"];
            $destino = "../img/fotoEmpleado/".$foto;
            copy($ruta,$destino);
            $empleadoMC->setFoto($destino);
           // echo "aqui".$empleadoMC->getFoto();
            $modificacionFoto = $con->modificaFoto($tabla, $empleadoMC);

            if($modificacionFoto == false)
                echo "<script>window.location.replace('../administrador/formModificarEmp.php?action=Ixfoto&pagina=1')</script>";
        }

        //validacion del cambio de contraseña 
        if(isset($_POST['pass1']) && isset($_POST['pass2'])){
            if($_POST['pass1'] == $_POST['pass2']){
                $empleadoMC->setContra($_POST['pass1']);                
                $modificacionContra = $con->modificaPass($tabla,$empleadoMC);

                if($modificacionContra == false)
                    echo "<script>window.location.replace('../administrador/formModificarEmp.php?action=Ixpass&pagina=1')</script>";
            
            }else{
                echo "<script>window.location.replace('../administrador/formModificarEmp.php?action=Ixpass&pagina=1')</script>";   
            }
        }
        //termina el cambio de contraseña
        
        //Validar que el correo no se haya modificado para modificar los otros campos.
        $correoSinCambios = $con->consultaWhereAND('empleado','Id_Empleado',$id, 'Correo', $correo);
        if($correoSinCambios != false){
            $modificacionCorrecta = $con->modifica($tabla, $empleadoMC);
            
                if($modificacionCorrecta != false){
                    echo "<script>window.location.replace('../administrador/empleados.php?action=Mcorrect&pagina=1')</script>";
                }else{
                    echo "<script>window.location.replace('../administrador/empleados.php?action=Mx&pagina=1')</script>";
                }
        
        }else{
            // si se cambia el correo entra aqui
            $existeCorreo = $con->consultaWhereId('empleado','correo', $correo);
            if($existeCorreo != false){
                echo "<script>window.location.replace('../administrador/formModificarEmp.php?action=Ixcorreo&pagina=1')</script>";
            }else{
                //si el nuevo correo no existe en la tabla empleado entonces modifica el correo
                $modificacionCorrecta = $con->modifica($tabla, $empleadoMC);

                if($modificacionCorrecta != false){
                    echo "<script>window.location.replace('../administrador/empleados.php?action=Mcorrect&pagina=1')</script>";
                }else{
                    echo "<script>window.location.replace('../administrador/empleados.php?action=Mx&pagina=1')</script>";
                }  
            }
        }
    }elseif ($_GET['actionCRUD'] == "eliminar") {
        if(isset($_GET['eliComplete'])){
           
            $id = desencriptar();
            
            $empleadoProducto = $con->consultaWhereId('producto','Id_Empleado', $id);
            $empleadoVenta = $con->consultaWhereId('venta','Id_Empleado', $id);

            if($empleadoProducto != false || $empleadoVenta != false){
                //sustituir estatus
                $cambioEstatus = $con->sustituirEliminar($tabla, $id);
                
                if($cambioEstatus!= false){
                    header('location:../administrador/empleados.php?action=Ecorrect&pagina=1 ');    
                }else{
                    echo "<script>window.location.replace('../administrador/empleados.php?action=Ex&pagina=1')</script>";
            }    

            }else{
                //eliminamos por que no tiene relacion con producto o venta
                $eliminacionCorrecta = $con->eliminar($tabla, $id);
                
                if($eliminacionCorrecta != false){
                    header('location:../administrador/empleados.php?action=Ecorrect&pagina=1 ');    
                }else{
                    echo "<script>window.location.replace('../administrador/empleados.php?action=Ex&pagina=1')</script>";
                }
            }

        }else{
            $idE = $_GET['idE'];
            echo "<script>window.location.replace('../administrador/confirmarELiminacion.php?pagina=1&tabla=empleado&id=$idE')</script>";
        }
    }//cierra elseif de actionCrud mComplete
}
//Termina acciones rapidas del CRUD

if(isset($_GET['idAct'])){
    $id = desencriptar();
    $exito = $con->reactivaEstatus('Empleado', $id);

    if($exito != false){
        echo "<script>window.location.replace('../administrador/empleados.php?action=Ecorrect&pagina=1')</script>"; 
    }else{
        echo "<script>window.location.replace('../administrador/empleados.php?action=Ex&pagina=1')</script>"; 
    }
}

//Cerramos la base de datos
$con->cerrarDB();

?>