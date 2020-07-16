<<<<<<< HEAD
<?php 
session_start();
include("barraAdmin.php");
include("../controlador/proveedorCont.php");
?>
      <div class="container">
        <!-- Barra de busqueda -->
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <form action="">
                    <select class="form-control mt-2" name="" id="">
                        <option value="">Filtrar por...</option>
                        <option value="">Nombre del Proveedor</option>
                        <option value="">Categoria</option>
                        <option value="">Subcategoria</option>
                    </select>
                
                </form>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
            
                <form class="form-inline">

                  <input class="form-control mt-2 ml-3 w-75" type="text" placeholder="Buscar Proveedor..."
                    aria-label="Search">
                 <button type="submit" class="btn mt-2"><img src="../img/lupaUser32.png" alt="imagen lupa"></button>
                </form>       
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">           
                <button type="submit" class="btn btn-success mt-2" data-toggle="modal" data-target="#modalRegistroProv">
                    Registrar un Nuevo Proveedor
                </button>              
            </div>
        </div>
         <!-- termina Barra de busqueda -->
         <div class="col-sm-12 col-md-12 col-lg-12">
            <table border=1 class="mt-5 table">
                <tr>
                    <td class="text-center"><b>Id</b></td>
                    <td class="text-center"><b>Nombre Proveedor</b></td>
                    <td class="text-center"><b>Nombre Agente</b></td>
                    <td class="text-center"><b>Teléfono</b></td>
                    <td class="text-center"><b>Acción<b></td>
                    
                </tr> 

                <?php 
    
                if($_SESSION['arreglo2'] != false){
                    $result = $_SESSION['arreglo2'];
                    
                    while ($reg = mysqli_fetch_array($result)){
                      $id =  $reg[0];
                ?>  

                <tr>
                    <td class="text-center"><?php echo $reg[0]?></td>
                    <td class="text-center"><?php echo $reg['Nombre_Proveedor']?></td>
                    <td class="text-center"><?php echo $reg['Nombre_Agente']?></td>
                    <td class="text-center"><?php echo $reg['Telefono']?></td>
                    <td class="text-center">
                        <a href="formModificarProv.php?id=<?php echo $id?>" class="btn btn-warning btn-sm ">Modificar</a> 
                        <a href="" class="btn btn-danger btn-sm">Eliminar</a> 
                        <a href="masInfoProv.php" class="btn btn-info btn-sm">Más detalles</a>
                    </td>
                    
                </tr> 
              <?php 
              
                    }       
                }
         
              ?>
        </div>
            </table>
      </div>

      <!-- Modal para el registro -->
        <div class="modal fade" id="modalRegistroProv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <div class="mr-3">
                    <img src="../img/usario_header.png" alt="">
                </div>
                <h5 class="modal-title" id="exampleModalLabel">Registro de Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Formulario registro de proovedor -->
                <form action='../controlador/proveedorCont.php' method="POST">
                    <div class="form-row">
                          <div class="col-4">
                             <p class="text-center">Nombre del Proveedor</p>
                          </div>
                          <div class="col-8">
                            <input type="text" name="nombreProv" class="form-control" placeholder="Nombre(s)">
                          </div>
                      </div>
                      <div class="form-row mt-2">
                          <div class="col-4">
                             <p class="text-center">Nombre del Agente</p>
                          </div>
                          <div class="col-8">
                            <input type="text" name="nombreAgente" class="form-control" placeholder="Nombre(s)"> 
                          </div>
                      </div>

                  <div class="form-row mt-2">
                      <div class="col-4">
                         <p class="text-center">Teléfono o móvil</p>
                      </div>
                      <div class="col-8">
                      <input type="text" name="telefono" class="form-control" placeholder="Ejem. 33-33-33-33-33"> 
                      </div>
                  </div>
                  <div class="form-row mt-2">
                      <div class="col-4">
                         <p class="text-center">Horario</p>
                      </div>
                      <div class="col-8">
                        <input type="text" name="horario" class="form-control" placeholder="Ejem. 00:00 - 00:00"> 
                      </div>
                  </div>
                  
                  <div class="form-row mt-2">
                      <div class="col-4">
                         <p class="text-center">Categoria</p>
                      </div>
                      <div class="col-8">
                        <select name="categoria" id="" class="form-control">
                            <option value="Alimentos">Alimentos</option>
                            <option value="Abarrotes">Abarrotes</option>
                            <option value="Servicios">Servicios</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-row mt-2 mb-2">
                      <div class="col-4">
                         <p class="text-center">Dirección</p>
                      </div>
                      <div class="col-8">
                        <input type="text" name="direccion" class="form-control" placeholder="calle, colonia, numero-exterior"> 
                      </div>
                  </div>

                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="btnRegistrar" value="registrar" onclick="mostrarSpinner('spinnerReg')">Registrar</button>
                    <div id="spinnerReg"></div>
                  </div>
                </form>

                <!-- Termina Formulario registro de proovedor -->
              </div>
            </div>
          </div>
        </div>  
    
<!-- Cierra el contenido de la pagina con la barra de navegacion-->    
    </div>
</div> 