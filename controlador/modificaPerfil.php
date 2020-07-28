<?php
session_start();
include('../modelo/conexion.php');
include('../modelo/clases.php');

if(isset($_POST['btn'])){
    $obj = new ConexionMySQL("root","");
    $tipo=$_SESSION['tipo'];

    if($_POST['btn']=="guardar"){
        if($_SESSION['tipo']=="CLIENTE"){
            $obj2=new Cliente();
            
            $obj2->setIdCli($_SESSION['id']);
            $obj2->setNombre($_POST['nombre']);
            $obj2->setApellidoM($_POST['apellidom']);
            $obj2->setApellidoP($_POST['apellidop']);
            $obj2->setTel($_POST['telefono']);
            $obj2->setFechaNac($_POST['fechnac']);
            $obj2->setCorreo($_POST['correo']);
            $resp=$obj->modificaPerfil("Cliente",$obj2);
        
        }else if($_SESSION['tipo']=="ADMIN"){
            $obj2= new Empleado();
    
            $obj2->setIdEmpl($_SESSION['idAdmin']);
            $obj2->setNombre($_POST['nombre']);
            $obj2->setApellidoM($_POST['apellidom']);
            $obj2->setApellidoP($_POST['apellidop']);
            $obj2->setTel($_POST['telefono']);
            $obj2->setFechaNac($_POST['fechnac']);
            $obj2->setCorreo($_POST['correo']);
            $resp=$obj->modificaPerfil("Empleado",$obj2);
        }else{
            $obj2= new Empleado();
    
            $obj2->setIdEmpl($_SESSION['id']);
            $obj2->setNombre($_POST['nombre']);
            $obj2->setApellidoM($_POST['apellidom']);
            $obj2->setApellidoP($_POST['apellidop']);
            $obj2->setTel($_POST['telefono']);
            $obj2->setFechaNac($_POST['fechnac']);
            $obj2->setCorreo($_POST['correo']);
            $resp=$obj->modificaPerfil("Empleado",$obj2);
        }
        
        if($resp==true){
            if($tipo=="CLIENTE"){
                echo "<script>window.location.replace('../cliente/perfil.php?action=Actualizado')</script>";
            }else if($tipo=="ADMIN"){
                echo "<script>window.location.replace('../administrador/perfil.php?action=Actualizado')</script>";
            }else{
                echo "<script>window.location.replace('../empleado/perfil.php?action=Actualizado')</script>";
            }
        }
        else{
            if($tipo=="CLIENTE"){
                echo "<script>window.location.replace('../cliente/perfil.php?action=fail')</script>";
            }else if($tipo=="ADMIN"){
                echo "<script>window.location.replace('../administrador/perfil.php?action=fail')</script>";
            }else{
                echo "<script>window.location.replace('../empleado/perfil.php?action=fail')</script>";
            }
        }
    }
}else{
    echo "No ingreso";
}
 