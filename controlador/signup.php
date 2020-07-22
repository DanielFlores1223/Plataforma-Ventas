<?php
session_start();
include ('../modelo/conexion.php');
include ('../modelo/clases.php');
$obj= new Cliente();

if(isset($_POST['signup-button'])){
    $obj->setNombre($_POST['nombre']);
    $obj->setApellidoP($_POST['a_pat']);
    $obj->setApellidoM($_POST['a_mat']);
    $obj->setFechaNac($_POST['fechaNac']);
    $obj->setTel($_POST['telefono']);
    $obj->setCorreo($_POST['correo']);
    $obj->setContra($_POST['contra']);

    if(empty($obj->getNombre())||empty($obj->getApellidoP())||empty($obj->getApellidoM())
    ||empty($obj->getFechaNac())||empty($obj->getTel())||empty($obj->getCorreo())||empty($obj->getContra())){
        header("Location:../index.php?error=espaciosvcios&nombre=".$name."&mail=".$user);
        exit();
    }else{
        $obj2=new ConexionMySQL("root","");
        if($obj2->usuarioExistente($obj->getCorreo())==true){
            header("Location:../index.php?error=usuarioexistente");
            exit();
        }else{
            if($obj2->inserta("Cliente",$obj)==true){
                //echo "<script>window.location.replace('../index.php?action=Registrado')</script>";
                echo "<script>window.location.replace('../index.php?action=Registrado')</script>";
            }else{
                echo "<script>window.location.replace('../index.php?action=failSignIn')</script>";
            }
        }
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}

