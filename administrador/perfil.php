<?php 
session_start();
include('../plantillas/bootstrap.php');
include('../plantillas/header.php');
?>

<div class="container">
    <h3><?php echo $_SESSION['usuario'];?> </h3><br>
    <h3><?php echo $_SESSION['contra'];?> </h3><br>
</div>