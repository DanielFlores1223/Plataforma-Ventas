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

//consultas

//Consulta general para imprimir todos los registros
$res = $con->consultaGeneral("empleado");
//Paginacion
$total_rows = mysqli_num_rows($res);
$paginas = $total_rows / $articulos_x_pag;
$paginas = ceil($paginas); //redondea hacia arriba 1.2 -> 2


if(!$_GET['pagina']){
    header('Location: empleados.php?pagina=1');
}
/*
if($_GET['pagina'] > $paginas || $_GET['pagina'] <= 0){
    header('Location: proveedores.php?pagina=1');
}
*/

$iniciar = ($_GET['pagina'] - 1) * $articulos_x_pag;
$res = $con->consultaGeneralPaginacion('empleado', $iniciar, $articulos_x_pag);

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
        $empleadoM = new Empleado();
        $empM = $con->consultaWhereId($tabla,"Id_Empleado",$_GET['idM']);

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
                                    $empleadoM->getEstatus());
                
                $_SESSION['empleado'] = $arregloEmp;

                if($_GET['actionCRUD'] == 'modificar'){
                    echo "<script>window.location.replace('../administrador/formModificarEmp.php')</script>";   
                
                }elseif ($_GET['actionCRUD'] == 'masDetalles'){
                    echo "<script>window.location.replace('../administrador/masInfoEmp.php')</script>"; 
                
                }    

            }//cierra while
        }//cierra if

    //modificar Empleado
    }elseif($_GET['actionCRUD'] == "mComplete"){
        $empleadoMC = new Empleado();
        $empleadoMC->setIdEmpl($_GET['idM']);
        $empleadoMC->setNombre($_POST['nombre']);
        $empleadoMC->setApellidoM($_POST['a_mat']);
        $empleadoMC->setApellidoP($_POST['a_pat']);
        $empleadoMC->setTel($_POST['telefono']);
        $empleadoMC->setFechaNac($_POST['fechaNac']);
        $empleadoMC->setCorreo($_POST['correo']);
        $empleadoMC->setSueldo($_POST['sueldo']);
        $empleadoMC->setTipo($_POST['tipo']);

        $correo = $empleadoMC->getCorreo();
        //Validar que el correo no exista en la base de datos ->pendiente
        //$existeCorreo = $con->consultaWhereId($tabla,'correo', $correo);

        //if()
        $modificacionCorrecta = $con->modifica($tabla, $empleadoMC);

        if($modificacionCorrecta != false){
            echo "<script>window.location.replace('../administrador/empleados.php?action=Mcorrect&pagina=1')</script>";
        }else{
            echo "<script>window.location.replace('../administrador/empleados.php?action=Mx&pagina=1')</script>";
        }
        
    }
}
//Termina acciones rapidas del CRUD

?>