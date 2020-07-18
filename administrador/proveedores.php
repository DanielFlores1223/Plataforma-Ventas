<?php 
include("../controlador/proveedorCont.php");
include("barraAdmin.php");

?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<style>

</style>
      <div class="container">
        <!-- Barra de busqueda -->
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <form action="proveedores.php" method="POST">
                <?php 
                  if(isset($_POST['filtro'])){
                ?>
                  <select class="form-control mt-2" name="filtro" id="">
                        <?php 
                          switch($_POST['filtro']){
                            case "Id_Proveedor":
                        ?> 
                              <option value="" selected>Mostrar todos los registros</option> 
                              <option value="Id_Proveedor" selected>Id del Proveedor</option>
                              <option value="Nombre_Proveedor">Nombre del Proveedor</option>
                              <option value="Nombre_Agente">Nombre del Agente</option>
                              <option value="Categoria">Categoria</option>
                        <?php 
                            break;
                            case "Nombre_Proveedor":
                        ?>    
                              <option value="" selected>Mostrar todos los registros</option>
                              <option value="Id_Proveedor">Id del Proveedor</option>
                              <option value="Nombre_Proveedor" selected>Nombre del Proveedor</option>
                              <option value="Nombre_Agente">Nombre del Agente</option>
                              <option value="Categoria">Categoria</option>

                        <?php
                            break;
                            case "Nombre_Agente":
                        ?>
                              <option value="" selected>Mostrar todos los registros</option>
                              <option value="Id_Proveedor">Id del Proveedor</option>
                              <option value="Nombre_Proveedor">Nombre del Proveedor</option>
                              <option value="Nombre_Agente" selected>Nombre del Agente</option>
                              <option value="Categoria">Categoria</option>
                        <?php
                            break;
                            case 'Categoria':
                        ?>     
                              <option value="" selected>Mostrar todos los registros</option>
                              <option value="Id_Proveedor">Id del Proveedor</option>
                              <option value="Nombre_Proveedor">Nombre del Proveedor</option>
                              <option value="Nombre_Agente" >Nombre del Agente</option>
                              <option value="Categoria" selected>Categoria</option>
                        <?php
                              break;
                              case '':
                        ?>
                                <option value="" selected>Mostrar todos los registros</option>
                                <option value="Id_Proveedor">Id del Proveedor</option>
                                <option value="Nombre_Proveedor">Nombre del Proveedor</option>
                                <option value="Nombre_Agente" >Nombre del Agente</option>
                                <option value="Categoria" >Categoria</option>
                        <?php
                              break;
                          }
                        ?>
                    </select>

                <?php
                  }else{
                ?>
                    <select class="form-control mt-2" name="filtro" id="">
                        <option value="">Filtrar por...</option>
                        <option value="Id_Proveedor">Id del Proveedor</option>
                        <option value="Nombre_Proveedor">Nombre del Proveedor</option>
                        <option value="Nombre_Agente">Nombre del Agente</option>
                        <option value="Categoria">Categoria</option>
                    </select>
                <?php 
                  }
               ?> 
                
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
            
                <div class="form-inline">
                  <?php 
                    if(isset($_POST['barraBusqueda'])){
                  ?>
                  <input type="search" 
                    name="barraBusqueda" 
                    class="form-control mt-2 ml-3 w-75" 
                    placeholder="Buscar Proveedor..."
                    value="<?php echo $_POST['barraBusqueda'];?>"
                    aria-label="Search"
                    autofocus
                  >                    
                 <?php 
                    }else{
                 ?> 
                    <input type="search" 
                    name="barraBusqueda" 
                    class="form-control mt-2 ml-3 w-75" 
                    placeholder="Buscar Proveedor..."
                    value=""
                    aria-label="Search"
                    autofocus
                    >

                  <?php  
                  }
                  ?>
                 
                 
                 <button type="submit" name="btnBuscarProv" class="btn mt-2"><img src="../img/lupaUser32.png" alt="imagen lupa"></button>
                </div>  
                </form>     
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3">           
                <button type="submit" class="btn btn-success mt-2" data-toggle="modal" data-target="#modalRegistroProv">
                    Registrar un Nuevo Proveedor
                </button>              
            </div>
        </div>
         <!-- termina Barra de busqueda -->
         <!-- Comienza alertas dependiendo de la accion -->
         <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
         <?php 
            if(isset($_GET['action'])){
              
              if($_GET['action'] == 'Icorrect'){
         ?>
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se registraron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/proveedores.php');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
         <?php
              }elseif ($_GET['action'] == 'Mcorrect') {
         ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se actualizaron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/proveedores.php');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
        <?php
              }elseif ($_GET['action'] == 'Ix') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se registraron. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/proveedores.php');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div> 
        <?php        
              }elseif ($_GET['action'] == 'Mx') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se actualizaron.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/proveedores.php');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>        
        <?php       
              }//cierra el elseif 
            }//cierra if donde comprueba que se creo get action
        ?>
        </div>
        <!-- Termina alertas dependiendo de la accion -->
        <!-- Comienza tabla donde muestra los registros -->
         <div class="col-sm-12 col-md-12 col-lg-12" id="tabla">
            <table border=1 class="mt-1 table">
                <tr>
                    <td class="text-center"><b>Id</b></td>
                    <td class="text-center"><b>Nombre Proveedor</b></td>
                    <td class="text-center"><b>Nombre Agente</b></td>
                    <td class="text-center"><b>Teléfono</b></td>
                    <td class="text-center"><b>Acción<b></td>
                    
                </tr> 

                <?php 
    
                if($res != false){
                    //$result = $_SESSION['arreglo2'];
                    
                    while ($reg = mysqli_fetch_array($res)){
                      $id =  $reg[0];
                ?>  

                <tr>
                    <td class="text-center"><?php echo $reg[0]?></td>
                    <td class="text-center"><?php echo $reg['Nombre_Proveedor']?></td>
                    <td class="text-center"><?php echo $reg['Nombre_Agente']?></td>
                    <td class="text-center"><?php echo $reg['Telefono']?></td>
                    <td class="text-center">
                        <a href="../controlador/proveedorCont.php?actionCRUD=modificar&idM=<?php echo $id?>" class="btn btn-warning btn-sm ">Modificar</a> 
                        <a href="" class="btn btn-danger btn-sm">Eliminar</a> 
                        <a href="../controlador/proveedorCont.php?actionCRUD=masDetalles&idMD=<?php echo $id?>" class="btn btn-info btn-sm">Más detalles</a>
                    </td>
                    
                </tr> 
              <?php 
              
                    }       
                }
         
              ?>
        </div>
            </table>
            <!-- Termina tabla donde muestra los registros -->
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
                <form action='../controlador/proveedorCont.php' method="POST" onsubmit="mostrarSpinner('spinnerReg')">
                    <div class="form-row">
                          <div class="col-4">
                             <p class="text-center">Nombre del Proveedor</p>
                          </div>
                          <div class="col-8">
                            <input type="text" 
                              name="nombreProv" 
                              class="form-control" 
                              placeholder="Nombre(s)" 
                              onkeypress=" 
                              return soloLetras(event)" 
                              maxlength = "50"
                              required 
                              title="maximo 50 caracteres"
                            >
                          </div>
                      </div>
                      <div class="form-row mt-2">
                          <div class="col-4">
                             <p class="text-center">Nombre del Agente</p>
                          </div>
                          <div class="col-8">
                            <input type="text" 
                              name="nombreAgente" 
                              class="form-control" 
                              placeholder="Nombre(s)" 
                              onkeypress="return soloLetras(event)"
                              maxlength = "50"
                              required 
                              title="maximo 50 caracteres"
                            > 
                          </div>
                      </div>

                  <div class="form-row mt-2">
                      <div class="col-4">
                         <p class="text-center">Teléfono o móvil</p>
                      </div>
                      <div class="col-8">
                      <input type="text" 
                        name="telefono" 
                        class="form-control" 
                        placeholder="Ejem. 33-33-33-33-33" 
                        onkeypress="return validarTelefono(event)"
                        maxlength = "14"
                        minlength = "14"
                        required 
                        title="maximo 14 caracteres"
                      > 
                      </div>
                  </div>
                  <div class="form-row mt-2">
                      <div class="col-4">
                         <p class="text-center">Horario</p>
                      </div>
                      <div class="col-8">
                        <input type="text" 
                          name="horario" 
                          class="form-control" 
                          placeholder="Ejem. 00:00 - 00:00" 
                          onkeypress="return validarHorario(event, this)"
                          maxlength = "11"
                          minlength = "11"
                          required 
                          title="maximo 11 caracteres"
                        > 
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
                        <input type="text" 
                          name="direccion" 
                          class="form-control" 
                          placeholder="calle, colonia, numero-exterior"
                          maxlength="50"
                          required 
                          title="maximo 50 caracteres"
                        > 
                      </div>
                  </div>

                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="btnRegistrar" value="registrar">Registrar</button>
                    <div id="spinnerReg"></div>
                  </div>
                </form>

                <!-- Termina Formulario registro de proovedor -->
              </div>
            </div>
          </div>
        </div>  
        <!-- Termina Modal para el registro -->     
       
<!-- Cierra el contenido de la pagina con la barra de navegacion-->    
    </div>
</div> 