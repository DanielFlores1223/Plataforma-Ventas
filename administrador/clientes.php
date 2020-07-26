<?php 
//session_start();
include("../controlador/clienteController.php");
include("barraAdmin.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container-fluid">
  <!-- Barra de busqueda -->
  <form action="clientes.php?pagina=1" method="POST">
        <div class="row bg-light text-dark p-2">
          <div class="col-sm-8 col-md-8 col-lg-8 ">
            <label>Clientes</label>             
          </div>
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
                    if(isset($_POST['barraBusquedaCli'])){
                  ?>
                  <input type="search" 
                    name="barraBusquedaCli" 
                    class="form-control mt-2  w-75" 
                    placeholder="Buscar Cliente..."
                    value="<?php echo $_POST['barraBusquedaCli'];?>"
                    aria-label="Search"
                    autofocus
                  >                    
                 <?php 
                    }else{
                 ?> 
                    <input type="search" 
                    name="barraBusquedaCli" 
                    class="form-control mt-2 w-75" 
                    placeholder="Buscar Cliente..."
                    value=""
                    aria-label="Search"
                    autofocus
                    >

                  <?php  
                  }
                  ?>                 
                 <button type="submit" name="btnBuscarCli" class="btn mt-2"><img src="../img/lupaUser32.png" alt="imagen lupa"></button>
                </div> 
            </div>               
        </form>     
        <!-- termina Barra de busqueda --> 
         <!-- Boton para abrir registro de cliente -->       
         <div class="col-sm-12 col-md-3 col-lg-3">     
                <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#modalRegistroCli">
                    Registrar un Nuevo Cliente
                </button>              
            </div>
          </div>
          <hr>
         <!-- Termina Boton para abrir registro de cliente --> 

        <!-- Comienza alertas dependiendo de la accion -->
        <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
         <?php 
         //comienzan alertas correctas
            if(isset($_GET['action'])){
              
              if($_GET['action'] == 'Icorrect'){
         ?>
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se registraron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
         <?php
              }elseif ($_GET['action'] == 'Mcorrect') {
         ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se actualizaron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
          <?php       
              }elseif ($_GET['action'] == 'Ecorrect') { 
          ?>    
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se realizo la acción <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>

        <?php
              //comienzan alertas con errores
              }elseif ($_GET['action'] == 'Ix') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se registraron. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div> 
        <?php
              //comienzan alertas con errores
              }elseif ($_GET['action'] == 'Ixcorreo') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> El correo que intentó registrar ya esta registrado. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>     
        <?php        
              }elseif ($_GET['action'] == 'Mx') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se actualizaron.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>                    
        <?php       
              }elseif ($_GET['action'] == 'Ex') { 
        ?> 
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> La acción no se realizo.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/clientes.php?pagina=1');">
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
            <table class="mt-1 table table-striped">
                <tr>
                    <td class="text-center"><b>Id</b></td>
                    <td class="text-center"><b>Nombre del Cliente</b></td>
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
                    <td class="text-kcenter"><?php echo $reg[0]?></td>
                    <td class="text-center"><?php echo $reg['Nombre']." ".$reg['ApellidoP']." ".$reg['ApellidoM']?></td>
                    <td class="text-center"><?php echo $reg['Correo']?></td>
                    <td class="text-center"><?php echo $reg['Telefono']?></td>
                    <td class="text-center">
                      <?php 
                        //encryptar
                        /*$encrypt1 = (($id * 123456789 * 5678) / 956783);
                        $linkE = "../controlador/clienteController.php?actionCRUD=eliminar&pagina=1&idE=".urlencode(base64_encode($encrypt1));
                        $linkM = "../controlador/clienteController.php?actionCRUD=modificar&pagina=1&idM=".urlencode(base64_encode($encrypt1));
                        $linkMD = "../controlador/clienteController.php?actionCRUD=masDetalles&pagina=1&idM=".urlencode(base64_encode($encrypt1));
                      */
                        ?>
                        <a href="<?php //echo $linkM ?>" class="btn btn-warning btn-sm ">Modificar</a> 
                        <a href="<?php //echo $linkE ?>" class="btn btn-danger btn-sm">Eliminar</a> 
                        <a href="<?php //echo $linkMD?>" class="btn btn-info btn-sm">Más detalles</a>
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
                    <a class="page-link" href="clientes.php?pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                  </li>
                  <?php 
                      for ($i=0; $i < $paginas; $i++) {                      
                  ?>
                      <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                        <a class="page-link" href="clientes.php?pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                        </li>
                  <?php 
                      }//cierra for de la paginacion 
                  ?>
                  <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                    <a class="page-link" href="clientes.php?pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                  </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- Termina Paginacion -->



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
      <hr>
        <!-- Formulario de registro  -->
        <form action='../controlador/clienteController.php' method="POST">
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
          <div class="form-row mb-2">
              <div class="col">
                <input type="email" name="correo" class="form-control" placeholder="Correo">
              </div>
              <div class="col">
                <input type="password" name="contra" class="form-control" placeholder="Contraseña">
              </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="btnRegCliente" onclick="mostrarSpinner('spinnerReg')">Registrar</button>
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