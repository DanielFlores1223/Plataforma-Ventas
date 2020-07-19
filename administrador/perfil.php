<?php
session_start();
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>




<?php 
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}
?>