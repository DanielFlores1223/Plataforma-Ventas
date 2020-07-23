<?php 
session_start();
//include("../controlador/empleadoController.php");
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container-fluid">
  <!-- Barra de busqueda -->
  <form action="" method="POST">
        <div class="row bg-light text-dark p-2">
          <div class="col-sm-8 col-md-8 col-lg-8 ">
            <label>Clientes</label>             
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
                            case "Id_Cliente":
                        ?> 
                              <option value="">Mostrar todos los registros</option> 
                              <option value="Id_Cliente" selected>Id del Cliente</option>
                              <option value="Nombre">Nombre del Cliente</option>
                              <option value="ApellidoP">Apellido del Cliente</option>
                              <option value="Telefono">Telefono</option>
                        <?php 
                            break;
                            case "Nombre":
                        ?>    
                              <option value="">Mostrar todos los registros</option>
                              <option value="Id_Cliente">Id del Cliente</option>
                              <option value="Nombre" selected>Nombre del Cliente</option>
                              <option value="ApellidoP">Apellido del Cliente</option>
                              <option value="Telefono">Telefono</option>

                        <?php
                            break;
                            case "ApellidoP":
                        ?>
                              <option value="">Mostrar todos los registros</option>
                              <option value="Id_Cliente">Id del Cliente</option>
                              <option value="Nombre">Nombre del Cliente</option>
                              <option value="ApellidoP" selected>Apellido del Cliente</option>
                              <option value="Telefono">Telefono</option>
                        <?php
                            break;
                            case 'Telefono':
                        ?>     
                              <option value="">Mostrar todos los registros</option>
                              <option value="Id_Cliente">Id del Cliente</option>
                              <option value="Nombre">Nombre del Cliente</option>
                              <option value="ApellidoP" >Apellido del Cliente</option>
                              <option value="Telefono" selected>Telefono</option>
                        <?php
                              break;
                              case '':
                        ?>
                                <option value="" selected>Mostrar todos los registros</option>
                                <option value="Id_Cliente">Id del Cliente</option>
                                <option value="Nombre">Nombre del Cliente</option>
                                <option value="ApellidoP">Apellido del Cliente</option>
                                <option value="Telefono">Telefono</option>
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
                        <option value="Id_Cliente">Id del Cliente</option>
                        <option value="Nombre">Nombre del Cliente</option>
                        <option value="ApellidoP">Apellido del Cliente</option>
                        <option value="Tipo">Telefono</option>
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
                    placeholder="Buscar Cliente..."
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
                    placeholder="Buscar Cliente..."
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
                <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modalRegistroCli">
                    Registrar un Nuevo Cliente
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

        <!-- Modal registro -->

<div class="modal fade" id="modalRegistroCli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="background:rgb(238, 238, 238);">
      <div class="modal-header"  style="background:rgb(238, 238, 238);">
        <div class="mr-3">
          <img src="../img/usario_header.png" alt="">
        </div>
          <h5 class="modal-title" id="modalRegistro">  Registro cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <img src="../img/logo_crem_adap.png" alt="logo cremeria liz">
          </div>
          <div class="col-8">
            <p class="text-center alert alert-warning">Ingresa la información que se solicita.<p>
          </div>
       </div>
      <hr>
        <!-- Formulario de registro  -->
        <form action='controlador/signup.php' method="POST">
          <p >Nombre completo</p>
          <div class="form-row">
              <div class="col">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre(s)" onkeypress="return soloLetras(event)">
              </div>
              <div class="col">
                <input type="text" name="a_pat" class="form-control" placeholder="Apellido Paterno" onkeypress="return soloLetras(event)">
              </div>
              <div class="col">
                <input type="text" name="a_mat" class="form-control" placeholder="Apellido Materno" onkeypress="return soloLetras(event)">
              </div>
          </div>
          <br>
          <div class="form-row">
              <div class="col-4">
                 <p>Fecha de nacimiento</p>
              </div>
              <div class="col-8">
                <input type="date" name="fechaNac" class="form-control" placeholder="fecha de nacimiento">
              </div>
          </div>
          <div class="form-row mt-2">
              <div class="col-4">
                 <p >Teléfono ó movil</p>
              </div>
              <div class="col-8">
                <input type="text" name="telefono" class="form-control" placeholder="Ejem. 33-33-33-33-33" onkeypress="return validarTelefono(event)"> 
              </div>
          </div>
          <hr>
          <p >Registro de cuenta</p>
          <div class="form-row">
              <div class="col">
                <input type="email" name="correo" class="form-control" placeholder="Correo">
              </div>
              <div class="col">
                <input type="password" name="contra" class="form-control" placeholder="Contraseña">
              </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="signup-button" onclick="mostrarSpinner('spinnerReg')">Registrar</button>
            <div id="spinnerReg"></div>
          </div>
        </form>
        <!-- termina Formulario de registro  -->
      </div>
    </div>
  </div>
</div>    

 <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
 </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>