<?php 
switch ($_GET['tabla']) {
  case 'empleado':
    include("../controlador/empleadoController.php");
    $pag = "empleados";
    $controlador = "empleadoController";
    break;
  
  case 'proveedor':
    include("../controlador/proveedorCont.php");
    $pag = "proveedores";
    $controlador = "proveedorCont";
    break;

  case 'producto':
    include("../controlador/inventarioController.php");
    $pag = "inventario";
    $controlador = "inventarioController";
    break;
  
  case 'cliente':
    include("../controlador/clienteController.php");
    $pag = "clientes";
    $controlador = "clienteController";
    break;
  default:
    # code...
    break;
}
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
 

?>
        <!-- Modal Eliminar -->
        <div id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Eliminar <?php echo $_GET['tabla'] ?></h5>
            </div>
            <div class="modal-body">
              <p>¿Seguro que deseas eliminar este registro?</p>
            </div>
            <div class="modal-footer">
            <a href="<?=$pag?>.php?pagina=1" class="btn btn-secondary">No</a>
            <a href="../controlador/<?=$controlador?>.php?actionCRUD=eliminar&pagina=1&eliComplete=s&idE= <?php echo $_GET['id']?>" class="btn btn-success">Si</a>
            </div>
          </div>
        </div>
      </div>

 <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
 </div>
</div>

<script type="text/javascript">
        $(function(){
         $("#myModal").modal();
        });
       </script>

<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>