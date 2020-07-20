<?php

session_start();
include("../administrador/barraAdmin.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj = new ConexionMySQL("root","");
    if($_SESSION['tipo']=="CLIENTE"){
        $obj2=new Cliente();
        $obj2->setIdCli($_POST['id']);
        $obj2->setNombre($_POST['nombre']);
        $obj2->setApellidoM($_POST['apellidom']);
        $obj2->setApellidoP($_POST['apellidop']);
        $obj2->setTel($_POST['telefono']);
        $obj2->setFechaNac($_POST['fechnac']);
        $obj2->setCorreo($_POST['correo']);
        $obj2->setContra($_POST['contra']);
    
    
    }else {
        $obj2= new Empleado();
        $obj2->setIdEmpl($_POST['id']);
        $obj2->setNombre($_POST['nombre']);
        $obj2->setApellidoM($_POST['apellidom']);
        $obj2->setApellidoP($_POST['apellidop']);
        $obj2->setTel($_POST['telefono']);
        $obj2->setFechaNac($_POST['fechnac']);
        $obj2->setCorreo($_POST['correo']);
        $obj2->setContra($_POST['contra']);
        $obj2->setSueldo($_POST['sueldo']);
        $obj2->setTipo($_POST['tipo']);
        $obj2->setEstatus($_POST['estatus']);
    }
    
    if($obj->modifica("Cliente",$obj2)==true){
        echo "<h3>se ha insertado con exito</h3>";
    }else{
        echo "<h3>No se pudo insertar</h3>";
    }
}else{
    echo "<script>window.location.replace('../index.php')</script>";
}