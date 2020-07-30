<?php 
include("../controlador/empleadoController.php");
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container-fluid">
  <!-- Barra de busqueda -->
  <form action="empleados.php?pagina=1" method="POST">
        <div class="row bg-light text-dark p-2">
          <div class="col-sm-8 col-md-8 col-lg-8 ">
            <label>Empleados</label>             
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
                      class="mr-0 ml-2"
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
                            case "Id_Empleado":
                        ?> 
                              <option value="">Mostrar todos los registros</option> 
                              <option value="Id_Empleado" selected>Id del Empleado</option>
                              <option value="Nombre">Nombre del Empleado</option>
                              <option value="ApellidoP">Apellido del Empleado</option>
                              <option value="Tipo">Tipo de Empleado</option>
                        <?php 
                            break;
                            case "Nombre":
                        ?>    
                              <option value="">Mostrar todos los registros</option>
                              <option value="Id_Empleado">Id del Empleado</option>
                              <option value="Nombre" selected>Nombre del Empleado</option>
                              <option value="ApellidoP">Apellido del Empleado</option>
                              <option value="Tipo">Tipo de Empleado</option>

                        <?php
                            break;
                            case "ApellidoP":
                        ?>
                              <option value="">Mostrar todos los registros</option>
                              <option value="Id_Empleado">Id del Empleado</option>
                              <option value="Nombre">Nombre del Empleado</option>
                              <option value="ApellidoP" selected>Apellido del Empleado</option>
                              <option value="Tipo">Tipo de Empleado</option>
                        <?php
                            break;
                            case 'Tipo':
                        ?>     
                              <option value="">Mostrar todos los registros</option>
                              <option value="Id_Empleado">Id del Empleado</option>
                              <option value="Nombre">Nombre del Empleado</option>
                              <option value="ApellidoP" >Apellido del Empleado</option>
                              <option value="Tipo" selected>Tipo de Empleado</option>
                        <?php
                              break;
                              case '':
                        ?>
                                <option value="" selected>Mostrar todos los registros</option>
                                <option value="Id_Empleado">Id del Empleado</option>
                                <option value="Nombre">Nombre del Empleado</option>
                                <option value="ApellidoP">Apellido del Empleado</option>
                                <option value="Tipo">Tipo de Empleado</option>
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
                        <option value="Id_Empleado">Id del Empleado</option>
                        <option value="Nombre">Nombre del Empleado</option>
                        <option value="ApellidoP">Apellido del Empleado</option>
                        <option value="Tipo">Tipo de Empleado</option>
                    </select>
                <?php 
                  }
               ?>                 
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-inline">
                  <?php 
                    if(isset($_POST['barraBusquedaEmp'])){
                  ?>
                  <input type="search" 
                    name="barraBusquedaEmp" 
                    class="form-control mt-2  w-75" 
                    placeholder="Buscar Empleado..."
                    value="<?php echo $_POST['barraBusquedaEmp'];?>"
                    aria-label="Search"
                    autofocus
                  >                    
                 <?php 
                    }else{
                 ?> 
                    <input type="search" 
                    name="barraBusquedaEmp" 
                    class="form-control mt-2 w-75" 
                    placeholder="Buscar Empleado..."
                    value=""
                    aria-label="Search"
                    autofocus
                    >

                  <?php  
                  }
                  ?>                 
                 <button type="submit" name="btnBuscarEmp" class="btn mt-2"><img src="../img/lupaUser32.png" alt="imagen lupa"></button>
                </div> 
            </div>               
        </form>     
        <!-- termina Barra de busqueda --> 
        <!-- Boton para abrir registro de empleado -->       
            <div class="col-sm-12 col-md-3 col-lg-3">     
                <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modalRegistroEmp">
                    Registrar un Nuevo Empleado
                </button>              
            </div>
          </div>
          <hr>
         <!-- Termina Boton para abrir registro de empleado --> 
          <!-- Comienza alertas dependiendo de la accion -->
          <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
         <?php 
         //comienzan alertas correctas
            if(isset($_GET['action'])){
              
              if($_GET['action'] == 'Icorrect'){
         ?>
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se registraron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
         <?php
              }elseif ($_GET['action'] == 'Mcorrect') {
         ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se actualizaron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
          <?php       
              }elseif ($_GET['action'] == 'Ecorrect') { 
          ?>    
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se realizo la acción <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>

        <?php
              //comienzan alertas con errores
              }elseif ($_GET['action'] == 'Ix') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se registraron. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div> 
        <?php
              //comienzan alertas con errores
              }elseif ($_GET['action'] == 'Ixcorreo') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> El correo que intento registrar ya esta registrado. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>     
        <?php        
              }elseif ($_GET['action'] == 'Mx') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se actualizaron.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>                    
        <?php       
              }elseif ($_GET['action'] == 'Ex') { 
        ?> 
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> La acción no se realizo.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/empleados.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>  

        <?php  
              }//cierra el elseif  
            }//cierra if donde comprueba que se creo get action
        ?>
        </div>
        <!-- Termina alertas dependiendo de la accion -->




        <!-- Modal para el registro -->
        <div class="modal fade" id="modalRegistroEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <div class="mr-3">
                    <img src="../img/usario_header.png" alt="">
                </div>
                <h5 class="modal-title" id="exampleModalLabel">Registro de Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Formulario registro de proovedor -->
                <form action='../controlador/empleadoController.php?pagina=1' method="POST" enctype="multipart/form-data" onsubmit="mostrarSpinner('spinnerReg')">
                  <h5 class="font-weight-light mb-3">Datos Personales</h5>
                     <div class="form-row">
                        <div class="col">
                        <p class="text-center">Nombre completo</p>
                         </div>
                         <div class="col-sm-12 col-md-3 col-lg-3">
                           <input type="text" 
                                name="nombre" 
                                class="form-control mb-1" 
                                placeholder="Nombre(s)" 
                                onkeypress="return soloLetras(event)"
                                required
                            >
                         </div>
                         <div class="col-sm-12 col-md-3 col-lg-3">
                           <input type="text" 
                                name="a_pat" 
                                class="form-control mb-1" 
                                placeholder="Apellido Paterno" 
                                onkeypress="return soloLetras(event)"
                                required
                            >
                         </div>
                         <div class="col-sm-12 col-md-3 col-lg-3">
                           <input type="text" 
                                name="a_mat" 
                                class="form-control mb-1" 
                                placeholder="Apellido Materno" 
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
                         <div class="col-sm-6 col-md-3 col-lg-3">
                            <p class="text-center">Foto</p>
                         </div>
                         <div class="col-sm-6 col-md-9 col-lg-9">
                         <input type="file" 
                             name="foto" 
                             class="form-control-file" 
                             accept="image/*"
                             required
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
                        placeholder=""
                        required 
                      > 
                      </div>
                      <div class="col-sm-12 col-md-2 col-lg-2">
                         <p class="text-center">Tipo</p>
                      </div>
                      <div class="col-sm-12 col-md-4 col-lg-4">
                       <select name="tipo" id="" class="form-control" required>
                            <option value="Bodega">Bodega</option>
                            <option value="Cajero">Cajero</option>
                            <option value="ADMIN">ADMIN</option>
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
                        placeholder="Ejemp: usu@cremeria.com"
                        required 
                      > 
                      </div>
                      <div class="col-sm-12 col-md-2 col-lg-2">
                         <p class="text-center">Contraseña</p>
                      </div>
                      <div class="col-sm-12 col-md-4 col-lg-4">
                        <input type="password" 
                          name="pass" 
                          class="form-control" 
                          placeholder=""
                          required 
                          minlength='6' 
                          title='minimo 6 caracteres'
                        > 
                      </div>
                  </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="btnRegistrarEmp" value="registrar">Registrar</button>
                    <div id="spinnerReg"></div>
                  </div>
                </form>

                <!-- Termina Formulario registro de proovedor -->
              </div>
            </div>
          </div>
        </div>  
        <!-- Termina Modal para el registro -->  

        <!-- Comienza tabla donde muestra los registros --> 
         <div class="col-sm-12 col-md-12 col-lg-12" id="tabla">
            <table class="mt-1 table table-striped">
                <tr>
                    <td class="text-center"><b>Id</b></td>
                    <td class="text-center"><b>Nombre del Empleado</b></td>
                    <td class="text-center"><b>Correo</b></td>
                    <td class="text-center"><b>Teléfono</b></td>
                    <td class="text-center"><b>Acción<b></td>
                    
                </tr> 

                <?php 
    
                if($res != false){                 
                    
                    while ($reg = mysqli_fetch_array($res)){
                      $id =  $reg[0];
                ?>  

                <tr>
                    <td class="text-center"><?php echo $reg[0]?></td>
                    <td class="text-center"><?php echo $reg['Nombre']?></td>
                    <td class="text-center"><?php echo $reg['Telefono']?></td>
                    <td class="text-center"><?php echo $reg['Correo']?></td>
                    <td class="text-center">
                      <?php 
                        //encryptar
                        $encrypt1 = (($id * 123456789 * 5678) / 956783);
                        $linkE = "../controlador/empleadoController.php?actionCRUD=eliminar&pagina=1&idE=".urlencode(base64_encode($encrypt1));
                        $linkM = "../controlador/empleadoController.php?actionCRUD=modificar&pagina=1&idM=".urlencode(base64_encode($encrypt1));
                        $linkMD = "../controlador/empleadoController.php?actionCRUD=masDetalles&pagina=1&idM=".urlencode(base64_encode($encrypt1));
                      ?>
                        <a href="<?php echo $linkM ?>" class="btn btn-warning btn-sm ">Modificar</a> 
                        <a href="<?php echo $linkE ?>" class="btn btn-danger btn-sm">Eliminar</a> 
                        <a href="<?php echo $linkMD?>" class="btn btn-info btn-sm">Más detalles</a>
                    </td>
                    
                </tr> 
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
            </table>
            <!-- Termina tabla donde muestra los registros -->


         <!-- Paginacion -->    
         <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                <?php if(isset($_GET['pagina'])){?>

                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled':''; ?>">
                    <a class="page-link" href="empleados.php?pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                  </li>
                  <?php 
                      for ($i=0; $i < $paginas; $i++) {                      
                  ?>
                      <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                        <a class="page-link" href="empleados.php?pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                        </li>
                  <?php 
                      }//cierra for de la paginacion 
                  ?>
                  <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                    <a class="page-link" href="empleados.php?pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                  </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- Termina Paginacion -->
  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>