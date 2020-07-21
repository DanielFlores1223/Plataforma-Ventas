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
            $obj2->setContra($_POST['contra']);
            $resp=$obj->modifica("Cliente",$obj2);
        }else if($_SESSION['tipo']=="ADMIN"){
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
            $resp=$obj->modifica("Empleado",$obj2);
        }else{
            $obj2= new Empleado();
    
            $obj2->setIdEmpl($_SESSION['id']);
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
            $resp=$obj->modifica("Empleado",$obj2);
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
 