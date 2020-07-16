<?php

session_start();
//$dir = dirname(__FILE__);//optine el directorio de la pagina 
include ('../modelo/conexion.php');

if(isset($_POST['correo']) && isset($_POST['pass'])){

    $email=$_POST['correo'];
    $password=$_POST['pass'];

    $obj = new ConexionMySQL("root","");
    
    if ($obj->validaLoginNuevo($email,$password)==false) {
        //echo "USUARIO INVALIDO";
        echo json_encode('USUARIO INVALIDO');
    }else{
        $_SESSION['usuario'] = $email;
        $_SESSION['contra'] = $password;
        echo json_encode('VALIDO');//de momento lo vamos a mandar asi 
    }
}
else{
    //echo "NO HAS INICIADO SESSION ";
    header("Location:../index.php");
}