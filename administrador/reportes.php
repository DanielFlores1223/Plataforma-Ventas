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
    <?php if(isset($_POST['tipoReport']) && $_POST['tipoReport'] == 'rdia'){ ?>
        <div class="col-1">
            <p class="text-center">Reportes</p>
        </div>
        <div class="col-2">
            <input type="date" name="fecha" id="" value="<?php echo $_POST['fecha'] ?>" class="form-control" required onchange="submit()">
        </div>
    <?php }else { ?>
            <div class="col-3">
                <p class="text-center">Reportes</p>
            </div>
    <?php 
                }
    ?>
        <div class="col-6">
            <?php 
                    if(isset($_POST['tipoReport'])){
            ?>
                    <select name="tipoReport" id="" class="form-control" onchange="submit()" >
                        <option value="sueldosEmp" <?php echo $_POST['tipoReport'] == 'sueldosEmp'? 'selected':'' ; ?>>Reporte de sueldos de los empleados</option>
                        <option value="prodSurt" <?php echo $_POST['tipoReport'] == 'prodSurt'? 'selected':'' ; ?>>Reporte de productos a surtir</option>
                        <option value="rdia" <?php echo $_POST['tipoReport'] == 'rdia'? 'selected':'' ; ?>>Reporte de ventas por dia</option>
                    </select>
            <?php   }else {
            ?>
                    <select name="tipoReport" id="" class="form-control" onchange="submit()" >
                        <option disabled selected> --Seleccione un reporte-- </option>
                        <option value="sueldosEmp">Reporte de sueldos de los empleados</option>
                        <option value="prodSurt">Reporte de productos a surtir</option>
                        <option value="rdia">Reporte de ventas por dia</option>
                    </select>
            <?php 
            }
            ?>
        </div>
</form>
<?php if(isset($_POST['tipoReport'])){ 
          switch ($_POST['tipoReport']) {
            case 'sueldosEmp':
    ?>
                <div class="col-3">
                            <a href="pdf.php?r=emsu" target="_blank" class="btn btn-success">Generar PDF</a>
                </div>       
                </div>
<?php 
                include('reportEmpSueldo.php');
                    break;
            case 'prodSurt':
?>
            <div class="col-3">
                        <a href="pdf.php?r=prodSurt" target="_blank" class="btn btn-success">Generar PDF</a>
            </div>  
            </div>  
<?php 
            include('reportprodSurt.php');
                break;

            case 'rdia':
?>
            <div class="col-3">
                        <a href="pdf.php?r=rdia" target="_blank" class="btn btn-success">Generar PDF</a>
            </div>  
            </div> 
  
<?php       include('reportVentaDia.php');
            break;
    }
        
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