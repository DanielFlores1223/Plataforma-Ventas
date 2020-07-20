<?php
session_start();
include("barraAdmin.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj= new ConexionMySQL("root",""); 
    $obj2 = new Empleado();
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container-fluid">
    <div class="container">
    <img src="../img/contactoAgenda.png">
    </div>
    <form action="perfilModifica.php" method="POST">
    <div class="container">
        <div class="col-sm-8 col-md-8 col-lg-8 "><label><h3>Perfil</h3></label>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-dark">
                    <?php
                    $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
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
                    echo "<tr><td><label>Estatus</label></td><td>".$obj2->getEstatus()."</td></tr>";
                    ?>
                </table>
            </div>
        </div>
        <!-- </div> no tine el ulrimo poeue se mu8eve el boton -->
    </div>    
    <div class='card-body'>
        <button class='btn btn-warning ' type="submit">Modificar</button>
    </div>
    </form>
</div>
<?php 
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}
?>