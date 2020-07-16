<?php
session_start();
include ('../modelo/conexion.php');

if(isset($_POST['signup-button'])){
    $name=$_POST['nombre'];
    $flastname=$_POST['a_pat'];
    $mlastname=$_POST['a_mat'];
    $birthd=$_POST['fechaNac'];
    $phone=$_POST['telefono'];
    $user=$_POST['correo'];
    $password=$_POST['contra'];

    if(empty($name)||empty($flastname)||empty($mlastname)||empty($birthd)||empty($phone)||empty($user)||empty($password)){
        header("Location:../index.php?error=espaciosvcios&nombre=".$name."&mail=".$user);
        exit();
    }else{
        $obj=new ConexionMySQL($dbUser,$dbPass);
        if($obj->usuarioExistente($user)==true){
            header("Location:../index.php?error=usuarioexistente&mail=".$user);
            exit();
        }else{
            if($obj->creaUsuario($name,$flastname,$mlastname,$birthd,$phone,$user,$password)==true){
                echo "<div><h3>Cuenta creado con Exito, Ahora inicie session</h3></div>";
            }else{
                echo "<div><h3>No se pudo registrar Cliente, comtacte al administrador</h3></div>";
            }
        }
    }
}else{
    echo ('No se ha ingresado datos');
}

