<?php 
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
            <select name="tipoReport" id="" class="form-control" >
                <option disabled selected> --Seleccione un reporte-- </option>
                <option value="sueldosEmp">Reporte de sueldos de los empleados</option>
            </select>
        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-success">Generar reporte</button>
        </div>       
    </div>
</form>
<!-- cierra formulario de reportes -->
<?php if($tabla != ""){ 
            echo $tabla;   
            $totalPagar = 0; 
?>
        <?php switch ($_POST['tipoReport']) {
            case 'sueldosEmp':
                while ($reg = mysqli_fetch_array($reporte)){
                    $totalPagar += $reg['Sueldo'];
        ?>      <tr>
                   <td> <?php echo $reg['Nombre']." ".$reg['ApellidoP']." ".$reg['ApellidoM'] ?> </td> 
                   <td> <?php echo $reg['Sueldo'] ?> </td> 
                </tr>
        <?php }
                
        ?>
                <tr>
                   <td></td> 
                   <td> TOTAL A PAGAR <?php echo $totalPagar;?> pesos</td> 
                </tr>

        <?php
                break;
            
            default:
                # code...
                break;
        }
        ?>
        </table>
<?php }?>
</div>

  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>