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
    <?php }elseif(isset($_POST['tipoReport']) && $_POST['tipoReport'] == 'rmes'){
     ?>
         <div class="col-1">
            <p class="text-center">Reportes</p>
        </div>
        <div class="col-2">
            <input type="month" name="fecha" id="" value="<?php echo $_POST['fecha'] ?>" class="form-control" required onchange="submit()">
        </div>

    <?php
     }elseif (isset($_POST['tipoReport']) && $_POST['tipoReport'] == 'ryear') {
    ?>
        <div class="col-1">
            <p class="text-center">Reportes</p>
        </div>
        <div class="col-2">
            <select name="year" id="" class="form-control" onchange="submit()">
                <option disabled selected>seleccione año</option>
                <?php 
                //llenamos el select con la cantidad de años
                    $año = 2020;
                    for ($i=0; $i < 11; $i++) { 
                ?>
                        <option value="<?=$año?>" <?php echo $_POST['year'] == $año ? 'selected' : ''?>><?=$año?></option>

                <?php
                        $año++;
                    } 
                ?>
            </select>
        </div>

    <?php }else{ ?>
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
                        <option value="rmes" <?php echo $_POST['tipoReport'] == 'rmes'? 'selected':'' ; ?>>Reporte de ventas por mes</option>
                        <option value="ryear" <?php echo $_POST['tipoReport'] == 'ryear'? 'selected':'' ; ?>>Reporte de ventas por año</option>
                    </select>
            <?php   }else {
            ?>
                    <select name="tipoReport" id="" class="form-control" onchange="submit()" >
                        <option disabled selected> --Seleccione un reporte-- </option>
                        <option value="sueldosEmp">Reporte de sueldos de los empleados</option>
                        <option value="prodSurt">Reporte de productos a surtir</option>
                        <option value="rdia">Reporte de ventas por dia</option>
                        <option value="rmes">Reporte de ventas por mes</option>
                        <option value="ryear">Reporte de ventas por año</option>
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
            case 'rmes':
?>
            <div class="col-3">
                        <a href="pdf.php?r=rmes" target="_blank" class="btn btn-success">Generar PDF</a>
            </div>  
            </div> 

<?php
                include('reportVentaMes.php');
                break;
                case 'ryear':
?>
            <div class="col-3">
                        <a href="pdf.php?r=ryear" target="_blank" class="btn btn-success">Generar PDF</a>
            </div>  
            </div> 

<?php 
                include('reportVentasYear.php');
                    break;
    }
        
}else{               
?> 
</div>

<div class="row">
 <div class="col-12 text-center">
     <svg width="25em" height="25em" viewBox="0 0 16 16" class="bi bi-file-earmark-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h5.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zm-.5 2a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V11a.5.5 0 0 0 1 0V9.5H10a.5.5 0 0 0 0-1H8.5V7z"/>
    </svg>
    <p class="h4 font-weight-light">No se ha seleccionado un reporte</p>
 </div>

</div>

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