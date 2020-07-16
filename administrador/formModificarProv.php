<?php  include("barraAdmin.php") ?>
    <h2 class="text-center font-weight-light my-4"> Modificar Información del Proveedor</h2>
    <hr>
    <!-- Formulario registro de proovedor -->
    <div class="container">
        <form action='' method="POST">
            <div class="form-row">
                <div class="col-4">
                     <p class="text-center">Nombre del Proveedor</p>
                 </div>
                <div class="col-7">
                    <input type="text" name="nombreProv" class="form-control" placeholder="Nombre(s)">
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Nombre del Agente</p>
                </div>
                <div class="col-7">
                    <input type="text" name="nombreAgente" class="form-control" placeholder="Nombre(s)"> 
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Teléfono o móvil</p>
                </div>
                <div class="col-7">
                    <input type="text" name="telefono" class="form-control" placeholder="Ejem. 33-33-33-33-33"> 
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-4">
                    <p class="text-center">Horario</p>
                </div>
                <div class="col-7">
                    <input type="text" name="telefono" class="form-control" placeholder="Ejem. 00:00 - 00:00"> 
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-4">
                     <p class="text-center">Categoria</p>
                </div>
                <div class="col-7">
                    <select name="categoria" id="" class="form-control">
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
                    <input type="text" name="direccion" class="form-control" placeholder="calle, colonia, numero-exterior"> 
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