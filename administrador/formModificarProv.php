<?php  
session_start();
include("barraAdmin.php");
include("../modelo/conexion.php");
include("../modelo/clases.php");
//Conexion a la base de datos
$dbUser="root";
$dbPass="";
$con = new ConexionMySQL($dbUser,$dbPass);

$proveedor2 = new Proveedor();
$consultaModificar = $con->consultaWhereId("Proveedor","Id_Proveedor",$_GET['id']);
    
    
    while ($reg = mysqli_fetch_array($consultaModificar)){
        $proveedor2->setIdProv($reg[0]);
        $proveedor2->setNombreProv($reg[1]);
        $proveedor2->setNombreAgen($reg[2]);
        $proveedor2->setTel($reg[3]);
        $proveedor2->setHorario($reg[4]);
        $proveedor2->setCategoria($reg[5]);
        $proveedor2->setDireccion($reg[6]);
    }    

?>
    <h2 class="text-center font-weight-light my-4"> 
        Modificar Información del Proveedor: <?php echo $proveedor2->getIdProv()?>
    </h2>
    <hr>
    <!-- Formulario registro de proovedor -->
    <div class="container">
        <form action='../controlador/proveedorCont.php?id=<?php echo $_GET['id'];?>' method="POST">
            <div class="form-row">
                <div class="col-4">
                     <p class="text-center">Nombre del Proveedor</p>
                 </div>
                <div class="col-7">
                    <input type="text" 
                    name="nombreProv" 
                    class="form-control" 
                    value="<?php echo $proveedor2->getNombreProv(); ?>">
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
                    value="<?php echo $proveedor2->getNombreAgen(); ?>">
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
                    value="<?php echo $proveedor2->getTel(); ?>">
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Horario</p>
                </div>
                <div class="col-7">
                    <input type="text" 
                    name="telefono" 
                    class="form-control" 
                    value="<?php echo $proveedor2->getHorario(); ?>">
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-4">
                     <p class="text-center">Categoria</p>
                </div>
                <div class="col-7">
                    <select name="categoria" id="" class="form-control">
                        <option value="<?php echo $proveedor2->getCategoria(); ?>">
                            <?php echo $proveedor2->getCategoria(); ?>
                        </option>
                        <option value="">Alimentos</option>
                        <option value="">Abarrotes</option>
                        <option value="">Servicios</option>
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
                    value="<?php echo $proveedor2->getDireccion(); ?>">
                </div>
            </div>
            <div class="text-center">
                <a href="proveedores.php" class="btn btn-secondary" >Cancelar</a>
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