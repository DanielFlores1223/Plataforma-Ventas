<?php  
session_start();
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){

$infoProvM = $_SESSION['arregloProvMod'];

//encryptar
$encrypt1 = (($infoProvM[0] * 123456789 * 5678) / 956783);
$linkMComplete = "../controlador/proveedorCont.php?pagina=1&idMcomplete=".urlencode(base64_encode($encrypt1));
?>
    <h2 class="text-center font-weight-light my-4"> 
        Modificar Información del Proveedor: #<?php echo $infoProvM[0]?>
    </h2>
    <hr>
    <!-- Formulario registro de proovedor -->
    <div class="container">
        <form action="<?php echo $linkMComplete;?>" method="POST">
            <div class="form-row">
                <div class="col-4">
                     <p class="text-center">Nombre del Proveedor</p>
                 </div>
                <div class="col-7">
                    <input type="text" 
                    name="nombreProv" 
                    class="form-control" 
                    value="<?php echo $infoProvM[1]; ?>">
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Nombre del Agente</p>
                </div>
                <div class="col-7">
                    <input type="text" 
                    name="nombreAgente" 
                    class="form-control" 
                    value="<?php echo $infoProvM[2]; ?>">
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Teléfono o móvil</p>
                </div>
                <div class="col-7">
                    <input type="text" 
                    name="telefono" 
                    class="form-control" 
                    value="<?php echo $infoProvM[3]; ?>">
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Horario</p>
                </div>
                <div class="col-7">
                    <input type="text" 
                    name="horario" 
                    class="form-control" 
                    value="<?php echo $infoProvM[4]; ?>">
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-4">
                     <p class="text-center">Categoria</p>
                </div>
                <div class="col-7">
                    <select name="categoria" id="" class="form-control">
                        <option value="<?php echo $infoProvM[5]; ?>">
                            <?php echo $infoProvM[5]; ?>
                        </option> 
                        <?php   
                            if($infoProvM[5] == "Alimentos"){
                        ?>
                                <option value="Abarrotes">Abarrotes</option>
                                <option value="Servicios">Servicios</option>
                        <?php 
                            }elseif ($infoProvM[5] == "Abarrotes") {
                        ?>
                                <option value="Alimentos">Alimentos</option>
                                <option value="Servicios">Servicios</option>
                        <?php 
                            }elseif ($infoProvM[5] == "Servicios") {                        
                       ?>
                            <option value="Alimentos">Alimentos</option>
                            <option value="Abarrotes">Abarrotes</option>
                        <?php 
                            }//cierra el ultimo elseif donde evalua el valor del select
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row mt-2 mb-2">
                <div class="col-4">
                    <p class="text-center">Dirección</p>
                </div>
                <div class="col-7">
                    <input type="text" 
                    name="direccion" 
                    class="form-control" 
                    value="<?php echo $infoProvM[6]; ?>">
                </div>
            </div>
            <div class="text-center">
                <a href="proveedores.php?pagina=1" class="btn btn-secondary" >Cancelar</a>
                <button type="submit" class="btn btn-success" name="signup-button" onclick="mostrarSpinner('spinnerReg')">Actualizar</button>
                <div id="spinnerReg"></div>
            </div>
        </form>
    </div>
    <hr>
    <!-- Termina Formulario registro de proovedor -->
<!-- Cierra el contenido de la pagina con la barra de navegacion-->    
</div>
</div> 
<?php 
}else{
   echo "<script>window.location.replace('../index.php')</script>";
}
?>