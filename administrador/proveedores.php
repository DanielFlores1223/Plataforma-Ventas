<?php 
include("../controlador/proveedorCont.php");
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){

?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>

      <div class="container-fluid">
        <!-- Barra de busqueda -->
        <form action="proveedores.php" method="POST">
            <div class="row bg-light text-dark p-2">
              <div class="col-sm-8 col-md-8 col-lg-8 ">
                <label>Agenda de Proveedores</label>
              
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4 text-center">
              <?php 
                 if(isset($_POST['estatus'])){
                   switch ($_POST['estatus']) {
                     case 'Activo':
              ?>
                      <label for="">Estatus: </label>
                      <input type="radio" 
                               name="estatus" 
                               value="Todos"
                               class="mr-0 ml-2"
                               onclick="submit()"
                      >
                      <label>Todos</label>
                      <input type="radio" 
                                name="estatus" 
                                value="Activo" 
                                class="mr-0"
                                checked
                                onclick="submit()"
                         >
                        <label >Activos</label>
                        <input type="radio" 
                               name="estatus" 
                               value="Inactivo"
                               class="mr-0 ml-2"
                               onclick="submit()"
                               
                        >
                        <label>Inactivos</label>
                      </div>
              <?php         
                       break;
                     case 'Inactivo':
              ?>
                      <label for="">Estatus: </label>
                      <input type="radio" 
                               name="estatus" 
                               value="Todos"
                               class="mr-0 ml-2"
                               onclick="submit()"
                      >
                      <label>Todos</label>
                      <input type="radio" 
                                name="estatus" 
                                value="Activo" 
                                class="mr-0"
                                onclick="submit()"
                                
                      >
                      <label >Activos</label>
                      <input type="radio" 
                               name="estatus" 
                               value="Inactivo"
                               class="mr-0 ml-2"
                               checked
                               onclick="submit()"
                      >
                      <label>Inactivos</label>
                      </div>
              <?php
                        break;
                      case 'Todos':                   
              ?>    
                           <label for="">Estatus: </label>
                            <input type="radio" 
                                     name="estatus" 
                                     value="Todos"
                                     class="mr-0 ml-2"
                                     checked
                                     onclick="submit()"
                              >
                              <label>Todos</label>
                            <input type="radio" 
                                      name="estatus" 
                                      value="Activo" 
                                      class="mr-0"
                                      onclick="submit()"

                               >
                              <label >Activos</label>
                              <input type="radio" 
                                     name="estatus" 
                                     value="Inactivo"
                                     class="mr-0 ml-2"
                                     onclick="submit()"
                              >
                              <label>Inactivos</label>
                            </div>

              <?php
                     break;
                    }//cierra switch
                 }else{
              ?>
                <label for="">Estatus: </label>
                <input type="radio" 
                         name="estatus" 
                         value="Todos"
                         class="mr-0 ml-2"
                         checked
                         onclick="submit()"
                  >
                  <label>Todos</label>
                <input type="radio" 
                          name="estatus" 
                          value="Activo" 
                          class="mr-0"
                          onclick="submit()"
                          
                   >
                  <label >Activos</label>
                  <input type="radio" 
                         name="estatus" 
                         value="Inactivo"
                         class="mr-0 ml-2"
                         onclick="submit()"
                  >
                  <label>Inactivos</label>
                </div>
              <?php 
                 }//cierra else
              ?>
            </div>   
            </div>
            <div class="container">
            <!--Cierra row de radio buttons -->
            
            <div class="row bg-light pb-2">
              <div class="col-sm-12 col-md-3 col-lg-3">
                <?php 
                  if(isset($_POST['filtro'])){
                    //echo "<script>alert('".$_POST['estatus']."')</script>";
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
                    class="form-control mt-2  w-75" 
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
                    class="form-control mt-2 w-75" 
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
            </div>               
        </form>     
                
            <div class="col-sm-12 col-md-3 col-lg-3">     
                <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modalRegistroProv">
                    Registrar un Nuevo Proveedor
                </button>              
            </div>
          </div>
          <hr>
         <!-- termina Barra de busqueda -->
         <!-- Comienza alertas dependiendo de la accion -->
         <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
         <?php 
         //comienzan alertas correctas
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
              }elseif ($_GET['action'] == 'Ecorrect') { 
          ?>    
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se realizo la acción <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/proveedores.php');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>

        <?php
              //comienzan alertas con errores
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
              }elseif ($_GET['action'] == 'Ex') { 
        ?> 
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> La acción no se realizo.
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
        <!-- Comienza tabla donde muestra los registros 
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
    
               // if($res != false){
                    //$result = $_SESSION['arreglo2'];
                    
                    //while ($reg = mysqli_fetch_array($res)){
                     // $id =  $reg[0];
                ?>  

                <tr>
                    <td class="text-center"><?php// echo $reg[0]?></td>
                    <td class="text-center"><?php //echo $reg['Nombre_Proveedor']?></td>
                    <td class="text-center"><?php //echo $reg['Nombre_Agente']?></td>
                    <td class="text-center"><?php //echo $reg['Telefono']?></td>
                    <td class="text-center">
                        <a href="../controlador/proveedorCont.php?actionCRUD=modificar&pagina=1&idM=<?php// echo $id?>" class="btn btn-warning btn-sm ">Modificar</a> 
                        <a href="../controlador/proveedorCont.php?actionCRUD=eliminar&pagina=1&idE=<?php //echo $id?>" class="btn btn-danger btn-sm">Eliminar</a> 
                        <a href="../controlador/proveedorCont.php?actionCRUD=masDetalles&pagina=1&idMD=<?php //echo $id?>" class="btn btn-info btn-sm">Más detalles</a>
                    </td>
                    
                </tr> 
              <?php 
              
                   // } //cierra while que muestra resultados      
                //}//cierra if
         
              ?>
        </div>
            </table>-->
            <!-- Termina tabla donde muestra los registros -->
            <div class="row">
               <?php     
                if($res != false && mysqli_num_rows($res) > 0){                    
                    while ($reg = mysqli_fetch_array($res)){
                      $id =  $reg[0];
                ?>  
                  <div class="col-sm-12 col-md-4 col-lg-4 mb-2">
                      <div class="card bg-light" style="width: 18rem;">
                      <div class="text-center">
                        <img src="../img/contactoAgenda.png" class="card-img-top" style="width: 5rem;" alt="...">
                      </div>
                          <div class="card-body <?php echo $reg['Estatus'] == 'Activo' ? 'bg-success text-white':'bg-danger text-white'?> ">
                            <h5 class="card-title">Proveedor: #<?php echo $reg[0]?> </h5>
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item <?php echo $reg['Estatus'] == 'Activo' ? 'bg-success text-white':'bg-danger text-white'?>">Nombre del Proveedor: <?php echo $reg['Nombre_Proveedor']?> </li>
                            <li class="list-group-item <?php echo $reg['Estatus'] == 'Activo' ? 'bg-success text-white':'bg-danger text-white'?>">Nombre del agente: <?php echo $reg['Nombre_Agente']?></li>
                            <li class="list-group-item <?php echo $reg['Estatus'] == 'Activo' ? 'bg-success text-white':'bg-danger text-white'?>">Telefono: <?php echo $reg['Telefono']?></li>
                          </ul>
                          <div class="card-body">
                          <?php 
                              //encryptar
                              $encrypt1 = (($id * 123456789 * 5678) / 956783);
                              $linkE = "../controlador/proveedorCont.php?actionCRUD=eliminar&pagina=1&idE=".urlencode(base64_encode($encrypt1));
                              $linkM = "../controlador/proveedorCont.php?actionCRUD=modificar&pagina=1&idM=".urlencode(base64_encode($encrypt1));
                              $linkMD = "../controlador/proveedorCont.php?actionCRUD=masDetalles&pagina=1&p=administrador&idMD=".urlencode(base64_encode($encrypt1));
                         ?>   
                          <a href="<?php echo $linkM?>" class="btn btn-warning btn-sm ">Modificar</a> 
                          <a href="<?php echo $linkE?>" class="btn btn-danger btn-sm">Eliminar</a> 
                          <a href="<?php echo $linkMD?>" class="btn btn-info btn-sm">Más Info</a>
                          </div>
                      </div> 
                      </div> 
              <?php 
              
                    } //cierra while que muestra resultados      
                }else {//cierra if
              ?>
                  <div class="col-12 mt-5">
                      <h2 class="text-center font-weight-light">No hay resultados :(</h2>
                  </div>

              <?php  
                }//cierra else
         
              ?>
        </div>
             <!-- Paginacion -->     
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                <?php if(isset($_GET['pagina'])){?>

                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled':''; ?>">
                    <a class="page-link" href="proveedores.php?pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                  </li>
                  <?php 
                      for ($i=0; $i < $paginas; $i++) {                      
                  ?>
                      <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                        <a class="page-link" href="proveedores.php?pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                        </li>
                  <?php 
                      }//cierra for de la paginacion 
                  ?>
                  <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                    <a class="page-link" href="proveedores.php?pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                  </li>
                    <?php }?>
                </ul>
            </nav>
            <!-- Termina Paginacion -->
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
                <form action='../controlador/proveedorCont.php?pagina=1' method="POST" onsubmit="mostrarSpinner('spinnerReg')">
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

<?php 
}else{
  echo "<script>window.location.replace('../index.php')</script>";
}

?>