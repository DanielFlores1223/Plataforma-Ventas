<?php
session_start();
include("barraAdmin.php");
include('..\controlador/perfilCont.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container-fluid">
    <div class="container">
    <img src="../img/contactoAgenda.png">
    </div>
        
    <div class="container">
    <?php
    

    muestraPerfil($_SESSION['tipo']);
    ?>


    </div>
    <!-- /#page-content-wrapper -->
<?php 
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}
?>