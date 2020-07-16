<?php

session_start();
//$dir = dirname(__FILE__);//optine el directorio de la pagina 
include ('../modelo/conexion.php');

if(isset($_POST['correo']) && isset($_POST['pass'])){
    
    $email=$_POST['correo'];
    $password=$_POST['pass'];

    $obj = new ConexionMySQL("root","");
    
    if($_POST['tipoUsu']=='cliente'){

        if($obj->validaCliente($email,$password)==false){
            echo json_encode('INVALIDO');
            //echo "INVALIDO";
        }
        else{
            $_SESSION['usuario'] = $email;
            $_SESSION['contra'] = $password;
            echo json_encode('esCLIENTE');//de momento lo vamos a mandar asi 
        }
    }
    else{
        if($obj->validaEmpleado($email,$password)==false){
            echo json_encode('INVALIDO');
        }
        else{
            if($_POST['tipoUsu']=='admin'){
                $_SESSION['usuario'] = $email;
                $_SESSION['contra'] = $password;
                echo json_encode('esADMIN');

            }else{
                $_SESSION['usuario'] = $email;
                $_SESSION['contra'] = $password;
                echo json_encode('esEMPLEADO');
            }
        }

    }
}
else{
    //echo "NO HAS INICIADO SESSION ";
    header("Location:../index.php");
}