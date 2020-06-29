<?php

session_start();
//$dir = dirname(__FILE__);//optine el directorio de la pagina 
include '../modelo/conexion.php';

if(isset($_POST['correo']) && isset($_POST['pass'])){

    $email=$_POST['correo'];
    $password=$_POST['pass'];

    echo "EL usuario es: ".$email."<br>";
    echo "La contresena es: ".$password."<br>";

    $obj = new ConexionMySQL();
    
    if ($obj->validaLogin($email,$password)==0) {
        echo "USUARIO INVALIDO";
        //aqui redirecciona a la pagina pricipal pero con un alert
    }else{
        $_SESSION['usuario'] = $email;
        $_SESSION['contra'] = $password;
        echo "USUARIO VALIDO";
        //aqui debe redirecionar a la pagina principal dependiendo al usuario
    }
}
else{
    //echo "NO HAS INICIADO SESSION ";
    header("Location:../index.php");
}