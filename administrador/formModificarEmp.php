<?php 
session_start();
include('barraAdmin.php');

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $emp = $_SESSION['empleado'];
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>

<div class="container">
<h2 class="font-weight-light text-center my-3">Modificar Información del Empleado: <?php echo $emp[0]; ?> </h2>
<hr>
<?php 

if(isset($_GET['action'])){
if ($_GET['action'] == 'Ixpass') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> las contraseñas no coinciden.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/formModificarEmp.php');">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>     
    <?php        
              }elseif ($_GET['action'] == 'Ixcorreo') {
     ?>
     <?php
              }
            }
        ?>
<form action='../controlador/empleadoController.php?actionCRUD=mComplete&pagina=1&idM=<?php echo $emp[0]; ?>' method="POST" onsubmit="mostrarSpinner('spinnerReg')">
    <h5 class="font-weight-light mb-3">Datos Personales</h5>
       <div class="form-row">
          <div class="col">
          <p class="text-center">Nombre completo</p>
           </div>
           <div class="col-sm-12 col-md-3 col-lg-3">
             <input type="text" 
                  name="nombre" 
                  class="form-control mb-1" 
                  value="<?php echo $emp[1]; ?>" 
                  onkeypress="return soloLetras(event)"
                  required
              >
           </div>
           <div class="col-sm-12 col-md-3 col-lg-3">
             <input type="text" 
                  name="a_pat" 
                  class="form-control mb-1" 
                  value="<?php echo $emp[2]; ?>" 
                  onkeypress="return soloLetras(event)"
                  required
              >
           </div>
           <div class="col-sm-12 col-md-3 col-lg-3">
             <input type="text" 
                  name="a_mat" 
                  class="form-control mb-1" 
                  value="<?php echo $emp[3]; ?>" 
                  onkeypress="return soloLetras(event)"
                  required
              >
           </div>
       </div>
       <div class="form-row mt-2">
          <div class="col-sm-6 col-md-3 col-lg-3">
          <p class="text-center">Fecha de nacimiento</p>
           </div>
           <div class="col-sm-6 col-md-9 col-lg-9">
             <input type="date" 
                  name="fechaNac"
                  value="<?php echo $emp[5]; ?>"  
                  class="form-control"
                  required
             >
           </div>
       </div>
       <div class="form-row mt-2">
           <div class="col-sm-6 col-md-3 col-lg-3">
              <p class="text-center">Teléfono</p>
           </div>
           <div class="col-sm-6 col-md-9 col-lg-9">
           <input type="text" 
               name="telefono" 
               class="form-control" 
               value="<?php echo $emp[4]; ?>" 
               onkeypress="return validarTelefono(event)"
               maxlength = "14"
               minlength = "14"
               required 
               title="maximo 14 caracteres"
          > 
           </div>
      </div>
       <hr>
    <h5 class="font-weight-light mb-3">Datos Laborales</h5>
    <div class="form-row mt-2">
        <div class="col-sm-12 col-md-2 col-lg-2">
           <p class="text-center">Sueldo</p>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
        <input type="number" 
          name="sueldo" 
          class="form-control" 
          value="<?php echo $emp[8]; ?>" 
          required 
        > 
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2">
           <p class="text-center">Tipo</p>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
         <select name="tipo" id="" class="form-control" required>
            <?php 
                if($emp[9] == "Bodega"){
            ?>
              <option value="Bodega" selected>Bodega</option>
              <option value="Cajero">Cajero</option>
              <option value="ADMIN">ADMIN</option>
            <?php 
                }elseif ($emp[9] == "Cajero") {
            ?>
                <option value="Bodega">Bodega</option>
                <option value="Cajero" selected>Cajero</option>
                <option value="ADMIN">ADMIN</option>
            <?php        
                }elseif ($emp[9] == "ADMIN") {
            ?>
                <option value="Bodega">Bodega</option>
                <option value="Cajero">Cajero</option>
                <option value="ADMIN" selected>ADMIN</option>
            <?php
                }//cierra elseif de tipo            
            ?>
         </select>
        </div>
    </div>
    <div class="form-row mt-2 mb-3">
        <div class="col-sm-12 col-md-2 col-lg-2">
           <p class="text-center">Correo</p>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
        <input type="email" 
          name="correo" 
          class="form-control" 
          value="<?php echo $emp[6]; ?>" 
          required 
        > 
        </div>     
      
        <div class="col-sm-12 col-md-2 col-lg-2">
           <p class="text-center">Contraseña</p>
        </div>
        <div id="formPass" class="col-sm-12 col-md-4 col-lg-4">
        <button type="button"
                name="btnActContra"
                class="btn btn-secondary form-control"
                onclick="mostrarFormPass('formPass')"
                >
          Cambiar contraseña
        </button>     
        </div> 
     </div>
 <div class="modal-footer">
    <a href="empleados.php?pagina=1" class="btn btn-secondary" >Cancelar</a>
    <button type="submit" class="btn btn-success" name="btnActualizarEmp" value="registrar">Actualizar</button>
    <div id="spinnerReg"></div>
  </div>
</form>
<!-- Termina Formulario registro de proovedor -->

</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>