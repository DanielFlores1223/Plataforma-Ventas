<?php 
session_start();
include('barraAdmin.php');

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $cli = $_SESSION['cliente'];
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>

<div class="container">
    <h2 class="font-weight-light text-center my-3">Modificar Cliente #<?php echo $cli[0];?></h2>
    <hr>

<?php if(isset($_GET['action'])){
            if ($_GET['action'] == 'Ixcorreo') {
?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> El correo que intento actualizar ya existe.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/formModificarCli.php');">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>     
    <?php
            }
        }
        //encryptar
        $encrypt1 = (($cli[0] * 123456789 * 5678) / 956783);
        $linkMComplete = "../controlador/clienteController.php?actionCRUD=mComplete&pagina=1&idM=".urlencode(base64_encode($encrypt1));
    ?>
    <form action="<?php echo $linkMComplete; ?>" method="POST">
        <h5 class="font-weight-light mb-3">Datos Personales</h5>
        <div class="form-row">
            <div class="col">
                <p class="text-center">Nombre Completo</p>
            </div>
            <div class="col-3">
                <input type="text"
                       name="nombre"
                       value="<?php echo $cli[1]?>"
                       class="form-control"
                       onkeypress="return soloLetras(event)"
                >
            </div>
            <div class="col-3">
                <input type="text"
                       name="a_pat"
                       value="<?php echo $cli[2]?>"
                       class="form-control"
                       onkeypress="return soloLetras(event)"
                >
            </div>
            <div class="col-3">
                <input type="text"
                       name="a_mat"
                       value="<?php echo $cli[3]?>"
                       class="form-control"
                       onkeypress="return soloLetras(event)"
                >
            </div>
        </div>

        <div class="form-row mt-2">
            <div class="col-3">
                <p class="text-center">Teléfono</p>
            </div>
            <div class="col-9">
            <input type="text" 
                   name="telefono" 
                   value="<?php echo $cli[4]?>"
                   class="form-control" 
                   onkeypress="return validarTelefono(event)"
            > 
            </div>
        </div>

        <div class="form-row mt-2">
            <div class="col-3">
                <p class="text-center">Fecha de nacimiento</p>
            </div>
            <div class="col-9">
                <input type="date" 
                      name="fechaNac"
                      value="<?php echo $cli[5]; ?>"  
                      class="form-control"
                      required
                 >
            </div>
        </div>

        <div class="form-row mt-2 mb-3">
            <div class="col-3">
                <p class="text-center">Correo Eléctronico</p>
            </div>
            <div class="col-9">
            <input type="email" 
                   name="correo" 
                   class="form-control" 
                   value="<?php echo $cli[6]; ?>" 
                   required 
            >
            </div>
        </div>
    <div class="modal-footer">
        <a href="clientes.php?pagina=1" class="btn btn-secondary" >Cancelar</a>
        <button type="submit" class="btn btn-success" name="btnActualizarCli" value="registrar">Actualizar</button>
        
        <div id="spinnerReg"></div>
    </div>
    </form>
</div>


</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>