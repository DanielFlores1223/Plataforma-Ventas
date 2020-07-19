<?php
//session_start();
include ('..\modelo/conexion.php');
include ('..\modelo/clases.php');

function muestraPerfil($tipo){
    $obj= new ConexionMySQL("root","");

    echo $tipo;
    switch($tipo){

        case "ADMIN":
            $obj2= new Empleado();
            $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
            echo "<table>";
            echo "<tr><td>".$obj2->getIdEmpl()."</td></tr>";
            echo "<tr><td>".$obj2->getNombre()."</td></tr>";
            echo "<tr><td>".$obj2->getApellidoP()."</td></tr>";
            echo "<tr><td>".$obj2->getApellidoM()."</td></tr>";
            echo "<tr><td>".$obj2->getTel()."</td></tr>";
            echo "<tr><td>".$obj2->getFechaNac()."</td></tr>";
            echo "<tr><td>".$obj2->getCorreo()."</td></tr>";
            echo "<tr><td>".$obj2->getContra()."</td></tr>";
            echo "<tr><td>".$obj2->getSueldo()."</td></tr>";
            echo "<tr><td>".$obj2->getTipo()."</td></tr>";
        break;

        case "EMPLEADO":
            $obj2= new Empleado();
            $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
            echo "<table>";
            echo "<tr><td>".$obj2->getIdEmpl()."</td></tr>";
            echo "<tr><td>".$obj2->getNombre()."</td></tr>";
            echo "<tr><td>".$obj2->getApellidoP()."</td></tr>";
            echo "<tr><td>".$obj2->getApellidoM()."</td></tr>";
            echo "<tr><td>".$obj2->getTel()."</td></tr>";
            echo "<tr><td>".$obj2->getFechaNac()."</td></tr>";
            echo "<tr><td>".$obj2->getCorreo()."</td></tr>";
            echo "<tr><td>".$obj2->getContra()."</td></tr>";
            echo "<tr><td>".$obj2->getSueldo()."</td></tr>";
            echo "<tr><td>".$obj2->getTipo()."</td></tr>";
            echo "</table>";
            //echo $infoArray;
        break;

        case "CLIENTE":
            
            $obj2= new Cliente();
            $obj2=$obj->getClienteInfo($_SESSION['usuario'],$obj2);
            echo "<table>";
            echo "<tr><td>".$obj2->getIdCli()."</td></tr>";
            echo "<tr><td>".$obj2->getNombre()."</td></tr>";
            echo "<tr><td>".$obj2->getApellidoP()."</td></tr>";
            echo "<tr><td>".$obj2->getApellidoM()."</td></tr>";
            echo "<tr><td>".$obj2->getTel()."</td></tr>";
            echo "<tr><td>".$obj2->getFechaNac()."</td></tr>";
            echo "<tr><td>".$obj2->getContra()."</td></tr>";
            echo "</table>";
        break;

    }
}