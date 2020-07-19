<?php
//session_start();
include ('..\modelo/conexion.php');
include ('..\modelo/clases.php');

function muestraPerfil($tipo){
    $obj= new ConexionMySQL("root","");

    $campos= array("id","Nombre","Apellido Paterno","Apellido Materno","Telefono","Fecha de Nacimiento","Correo","Contraseña","Sueldo","Tipo","Estatus");

    echo '<div class="col-sm-8 col-md-8 col-lg-8 "><label>Perfil</label><form>';

    if($tipo=="CLIENTE"){
        $obj2= new Cliente();
            $obj2=$obj->getClienteInfo($_SESSION['usuario'],$obj2);
            echo "<table class='table table-striped'>";
            echo "<tr><td><label>ID</label></td><td>".$obj2->getIdCli()."</td></tr>";
            echo "<tr><td><label>Nombre</label></td><td>".$obj2->getNombre()."</td></tr>";
            echo "<tr><td><label>Apellido Paterno</label></td><td>".$obj2->getApellidoP()."</td></tr>";
            echo"<tr><td><label>Apellido Materno</label></td><td>".$obj2->getApellidoM()."</td></tr>";
            echo "<tr><td><label>Telefono</label></td><td>".$obj2->getTel()."</td></tr>";
            echo "<tr><td><label>Fecha de Nacimiento</label></td><td>".$obj2->getFechaNac()."</td></tr>";
            echo "<tr><td><label>Correo</label></td><td>".$obj2->getCorreo()."</td></tr>";
            echo "<tr><td><label>Contraseña</label></td><td>".$obj2->getContra()."</td></tr>";
            echo "</table>";
    
    }else{
        $obj2= new Empleado();
            $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
            echo "<table class='table table-striped'>";
            echo "<tr><td><label>ID</label></td><td>".$obj2->getIdEmpl()."</td></tr>";
            echo "<tr><td><label>Nombre</label></td><td>".$obj2->getNombre()."</td></tr>";
            echo "<tr><td><label>Apellido Paterno</label></td><td>".$obj2->getApellidoP()."</td></tr>";
            echo "<tr><td><label>Apellido Materno</label></td><td>".$obj2->getApellidoM()."</td></tr>";
            echo "<tr><td><label>Telefono</label></td><td>".$obj2->getTel()."</td></tr>";
            echo "<tr><td><label>Fecha de Nacimiento</label></td><td>".$obj2->getFechaNac()."</td></tr>";
            echo "<tr><td><label>Correo</label></td><td>".$obj2->getCorreo()."</td></tr>";
            echo "<tr><td><label>Contraseña</label></td><td>".$obj2->getContra()."</td></tr>";
            echo "<tr><td><label>Sueldo</label></td><td>".$obj2->getSueldo()."</td></tr>";
            echo "<tr><td><label>Tipo</label></td><td>".$obj2->getTipo()."</td></tr>";
            //echo "<tr><td><label>Estatus</label></td><td>".$obj2->getEstatus()."</td></tr>";
    }
    echo '</div>';
}