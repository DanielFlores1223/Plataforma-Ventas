<?php 
error_reporting(0);
include("../controlador/reporteController.php");
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>
<div class="container">
<!-- formulario de reportes -->
<form action="" method="post">
    <div class="row bg-light py-3">
        <div class="col-3">
            <p class="text-center">Reportes</p>
        </div>
        <div class="col-6">
            <select name="tipoReport" id="" class="form-control" onchange="submit()" >
                <option disabled selected> --Seleccione un reporte-- </option>
                <option value="sueldosEmp">Reporte de sueldos de los empleados</option>
            </select>
        </div>
        <div class="col-3">
            <a href="pdf.php?r=emsu" target="_blank" class="btn btn-success">Generar PDF</a>
        </div>       
    </div>
</form>
<!-- cierra formulario de reportes -->
<?php if(isset($_POST['tipoReport'])){
            if($_POST['tipoReport'] == 'sueldosEmp')
                
?>
    <?php include('reportEmpSueldo.php'); ?>


<?php 
}
?>
  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>