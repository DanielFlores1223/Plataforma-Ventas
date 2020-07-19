<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");

//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tabla = 'Empleado';
$articulos_x_pag = 4;
$paginas = 0;


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
?>