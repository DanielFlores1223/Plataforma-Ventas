<?php

session_start();
include '/modelo/conexion.php';

$email=$_POST['correo'];
$password=$_POST['pass'];

$_SESSION['usuario'] = $email;
$_SESSION['contra'] = $password;

echo "EL usuario es: ".$emial."<br>";
echo "La contresena es: ".$password;

$obj = new ConexionMySQL();

if ($obj->validaLogin($emial,$password)==0) {
	echo "USUARIO INVALIDO";
}else{
    echo "USUARIO VALIDO";
}

