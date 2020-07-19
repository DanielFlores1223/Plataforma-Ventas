<?php
session_start();
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>

<div class="container-fluid">
    <!-- /#page-content-wrapper -->

    <?php
    include('..\controlador/perfilCont.php');

    muestraPerfil($_SESSION['tipo']);
    ?>

<?php 
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}
?>