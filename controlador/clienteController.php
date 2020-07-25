<?php 
session_start();  
include("../modelo/conexion.php");
include("../modelo/clases.php");
//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$tabla = 'Cliente';
$articulos_x_pag = 3;
$paginas = 0;

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


?>