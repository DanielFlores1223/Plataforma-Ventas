<?php session_start();
include('barraCliente.php');
include('../modelo/conexion.php');
include('../modelo/clases.php');
//if(isset($_SESSION['usuario']) && isset($_SESSION['contra'])){ 
  $obj= new ConexionMySQL("root",""); 
  $obj2 = new Cliente();
  ?>


<h1>"SALUDOS BANDA"</h1>
