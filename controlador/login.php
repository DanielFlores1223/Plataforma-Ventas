<?php

session_start();
//$dir = dirname(__FILE__);//optine el directorio de la pagina 
include ('../modelo/conexion.php');

if(isset($_POST['correo']) && isset($_POST['pass'])){
    
    $email=$_POST['correo'];
    $password=$_POST['pass'];

    $obj = new ConexionMySQL("root","");

    switch($obj->getTipoUsuario($email)){
        
        case 'CLIENTE':
            if($obj->validaCliente($email,$password)==false){
                echo json_encode('INVALIDO');
            }
            else{
                $_SESSION['tipo']="CLIENTE";
                $_SESSION['usuario'] = $email;
                $_SESSION['contra'] = $password;
                echo json_encode('esCLIENTE');//de momento lo vamos a mandar asi 
            }
        break;

        case 'ADMIN':
            if($obj->validaEmpleado($email,$password)==false){
                echo json_encode('INVALIDO');
            }
            else{
                $_SESSION['tipo']="ADMIN";
                $_SESSION['usuario'] = $email;
                $_SESSION['contra'] = $password;
                echo json_encode('esADMIN');
            }    
        break;

        case 'EMPLEADO':
            if($obj->validaEmpleado($email,$password)==false){
                echo json_encode('INVALIDO');
            }
            else{
                $_SESSION['tipo']="EMPLEADO";
                $_SESSION['usuario'] = $email;
                $_SESSION['contra'] = $password;
                echo json_encode('esEMPLEADO');
            } 
        break;

        case 'NONE':
            echo json_encode('INVALIDO');
        break;
    }
}
else{
    //echo "NO HAS INICIADO SESSION ";
    header("Location:../index.php?action=fail");
}