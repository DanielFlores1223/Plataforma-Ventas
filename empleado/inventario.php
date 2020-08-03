<?php 
include("../controlador/inventarioController.php");
include("barraEmpleado.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>

<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<div class="container-fluid">
  <!-- Barra de busqueda -->
  <form action="inventario.php?pagina=1" method="POST">
        <div class="row bg-light text-dark p-2">
          <div class="col-sm-8 col-md-8 col-lg-6 ">
            <label>Productos</label>             
          </div>
          <div class="col-sm-4 col-md-4 col-lg-6 text-right">
          <?php 
             if(isset($_POST['categoria'])){
               switch ($_POST['categoria']) {
                 case 'Alimentos':
          ?>
                  <label for="">Categoria: </label>
                  <input type="radio" 
                           name="categoria" 
                           value="Todos"
                           class="mr-0 ml-2"
                           onclick="submit()"
                  >
                  <label>Todos</label>
                  <input type="radio" 
                            name="categoria" 
                            value="Alimentos" 
                            class="mr-0 ml-2"
                            checked
                            onclick="submit()"
                     >
                    <label >Alimentos</label>
                    <input type="radio" 
                           name="categoria" 
                           value="Abarrotes"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           
                    >
                    <label>Abarrotes</label>
                    <input type="radio" 
                           name="categoria" 
                           value="Servicios"
                           class="mr-0 ml-2"
                           onclick="submit()"
                    >
              <label>Servicios</label>
                  </div>
          <?php         
                   break;
                 case 'Abarrotes':
          ?>
                  <label for="">Categoria: </label>
                  <input type="radio" 
                           name="categoria" 
                           value="Todos"
                           class="mr-0 ml-2"
                           onclick="submit()"
                  >
                  <label>Todos</label>
                  <input type="radio" 
                            name="categoria" 
                            value="Alimentos" 
                            class="mr-0 ml-2"
                            onclick="submit()"
                            
                  >
                  <label >Alimentos</label>
                  <input type="radio" 
                           name="categoria" 
                           value="Abarrotes"
                           class="mr-0 ml-2"
                           checked
                           onclick="submit()"
                  >
                  <label>Abarrotes</label>
                  <input type="radio" 
                         name="categoria" 
                         value="Servicios"
                         class="mr-0 ml-2"
                         onclick="submit()"
                  >
                  <label>Servicios</label>
                  </div>
          <?php
                    break;
                  case 'Todos':                   
          ?>    
                       <label for="">Categoria: </label>
                        <input type="radio" 
                                 name="categoria" 
                                 value="Todos"
                                 class="mr-0 ml-2"
                                 checked
                                 onclick="submit()"
                          >
                          <label>Todos</label>
                        <input type="radio" 
                                  name="categoria" 
                                  value="Alimentos" 
                                  class="mr-0 ml-2"
                                  onclick="submit()"
                           >
                          <label >Alimentos</label>
                          <input type="radio" 
                                 name="categoria" 
                                 value="Abarrotes"
                                 class="mr-0 ml-2"
                                 onclick="submit()"
                          >
                          <label>Abarrotes</label>
                          <input type="radio" 
                                 name="categoria" 
                                 value="Servicios"
                                 class="mr-0 ml-2"
                                 onclick="submit()"
                          >
                         <label>Servicios</label>
                        </div>
          <?php
                 break;
                 case 'Servicios':
          ?>
                  <label for="">Categoria: </label>
                  <input type="radio" 
                           name="categoria" 
                           value="Todos"
                           class="mr-0 ml-2"
                           onclick="submit()"
                    >
                    <label>Todos</label>
                  <input type="radio" 
                            name="categoria" 
                            value="Alimentos" 
                            class="mr-0 ml-2"
                            onclick="submit()"
                     >
                    <label >Alimentos</label>
                    <input type="radio" 
                           name="categoria" 
                           value="Abarrotes"
                           class="mr-0 ml-2"
                           onclick="submit()"
                    >
                    <label>Abarrotes</label>
                    <input type="radio" 
                           name="categoria" 
                           value="Servicios"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           checked
                    >
                   <label>Servicios</label>
                  </div>

          <?php
                 break;

                }//cierra switch
             }else{
          ?>
            <label for="">Categoria: </label>
            <input type="radio" 
                     name="categoria" 
                     value="Todos"
                     class="mr-0 ml-2"
                     checked
                     onclick="submit()"
              >
              <label>Todos</label>
            <input type="radio" 
                      name="categoria" 
                      value="Alimentos" 
                      class="mr-0 ml-2"
                      onclick="submit()"
                      
               >
              <label >Alimentos</label>
              <input type="radio" 
                     name="categoria" 
                     value="Abarrotes"
                     class="mr-0 ml-2"
                     onclick="submit()"
              >
              <label>Abarrotes</label>
              <input type="radio" 
                     name="categoria" 
                     value="Servicios"
                     class="mr-0 ml-2"
                     onclick="submit()"
              >
              <label>Servicios</label>
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
                ?>
                  <select class="form-control mt-2" name="filtro" id="">
                        <?php 
                          switch($_POST['filtro']){
                            case "Id_Producto":
                        ?> 
                              <option value="">Mostrar todos los Productos</option> 
                              <option value="Id_Producto" selected>Código del Producto</option>
                              <option value="NombreProd">Nombre del Producto</option>
                              <option value="SubCategoria">Subcategoria</option>
                              <option value="Existencia">Existencia de Producto</option>
                        <?php 
                            break;
                            case "NombreProd":
                        ?>    
                              <option value="">Mostrar todos los Productos</option>
                              <option value="Id_Producto">Id del Producto</option>
                              <option value="NombreProd" selected>Nombre del Producto</option>
                              <option value="SubCategoria">Subcategoria</option>
                              <option value="Existencia">Existencia de Producto</option>

                        <?php
                            break;
                            case "SubCategoria":
                        ?>
                              <option value="">Mostrar todos los Productos</option>
                              <option value="Id_Producto">Id del Producto</option>
                              <option value="NombreProd">Nombre del Producto</option>
                              <option value="SubCategoria" selected>Subcategoria</option>
                              <option value="Existencia">Existencia de Producto</option>
                        <?php
                            break;
                            case 'Existencia':
                        ?>     
                              <option value="">Mostrar todos los Productos</option>
                              <option value="Id_Producto">Id del Producto</option>
                              <option value="NombreProd">Nombre del Producto</option>
                              <option value="SubCategoria" >Subcategoria</option>
                              <option value="Existencia" selected>Existencia de Producto</option>
                        <?php
                              break;
                              case '':
                        ?>
                                <option value="" selected>Mostrar todos los Productos</option>
                                <option value="Id_Producto">Id del Producto</option>
                                <option value="NombreProd">Nombre del Producto</option>
                                <option value="SubCategoria">Subcategoria</option>
                                <option value="Existencia">Existencia de Producto</option>
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
                        <option value="Id_Producto">Id del Producto</option>
                        <option value="NombreProd">Nombre del Producto</option>
                        <option value="SubCategoria">Subcategoria</option>
                        <option value="Existencia">Existencia de Producto</option>
                    </select>
                <?php 
                  }
               ?>                 
              </div>
              <div class="col-sm-12 col-md-7 col-lg-7 ">
                <div class="form-inline">
                  <?php 
                    if(isset($_POST['barraBusquedaProd'])){
                  ?>
                  <input type="search" 
                    name="barraBusquedaProd" 
                    class="form-control mt-2  w-75" 
                    placeholder="Buscar Producto..."
                    value="<?php echo $_POST['barraBusquedaProd'];?>"
                    aria-label="Search"
                    autofocus
                  >                    
                 <?php 
                    }else{
                 ?> 
                    <input type="search" 
                    name="barraBusquedaProd" 
                    class="form-control mt-2 w-75" 
                    placeholder="Buscar Producto..."
                    value=""
                    aria-label="Search"
                    autofocus
                    >

                  <?php  
                  }
                  ?>                 
                 <button type="submit" name="btnBuscarProd" class="btn mt-2"><img src="../img/lupaNormal.png" alt="imagen lupa"></button>
                </div> 
            </div>               
        </form>     
        <!-- termina Barra de busqueda --> 
         <!-- Boton para abrir registro de productos        
         <div class="col-sm-12 col-md-3 col-lg-2">     
                <button type="button" class="btn" data-toggle="modal" data-target="#modalRegistroProd">
                    <img src="../img/agregarProd100.png" alt="" style="max-widht: 100%">
                    <p>Registrar Producto</p>
                </button>              
            </div>
             Termina Boton para abrir registro de productos -->
          </div>
          <hr>  
          <!-- Comienza alertas dependiendo de la accion -->
          <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
         <?php 
         //comienzan alertas correctas
            if(isset($_GET['action'])){
              
              if($_GET['action'] == 'Icorrect'){
         ?>
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se registraron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
         <?php
              }elseif ($_GET['action'] == 'Mcorrect') {
         ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se actualizaron los datos <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
          <?php       
              }elseif ($_GET['action'] == 'Ecorrect') { 
          ?>    
             <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se realizo la acción <strong>Correctamente!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>

        <?php
              //comienzan alertas con errores
              }elseif ($_GET['action'] == 'Ix') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se registraron. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div> 
        <?php
              //comienzan alertas con errores
              }elseif ($_GET['action'] == 'Ixcorreo') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> El correo que intento registrar ya esta registrado. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>     
        <?php        
              }elseif ($_GET['action'] == 'Mx') {
        ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Los datos no se actualizaron.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>                    
        <?php       
              }elseif ($_GET['action'] == 'Ex') { 
        ?> 
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> La acción no se realizo.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/inventario.php?pagina=1');">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>  

        <?php  
              }//cierra el elseif  
            }//cierra if donde comprueba que se creo get action
        ?>
        </div>
        <!-- Termina alertas dependiendo de la accion -->
        <!-- comienza mostrar productos -->
        
        <?php 
        if($res != false){  
            while($reg = mysqli_fetch_array($res)){ 
                $id = $reg[0];      
        ?>          
        <div class="card my-3" style="border-top: .3rem solid rgb(224, 191, 3);">
             <div class="row">
                <div class="col-2 mt-2">
                    <img src="<?php echo  $reg['Foto'] != "" ? '../'.$reg['Foto'] : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
                </div>
                <div class="col-6 mt-2">
                    <h5> <?php echo $reg['NombreProd']; ?> </h5>
                    <p><b class="text-info">Descripción:</b> <?php echo $reg['Descripcion']; ?></p>
                    <p><b class="text-info">Precio:</b> <?php echo $reg['Precio'];?> pesos</p>
                    <p><b class="text-info">Existencia:</b> <?php echo $reg['Existencia']; ?></p>
                    <p><b class="text-info">Categoria:</b> <?php echo $reg['Categoria']; ?></p>
                </div>
                <div class="col-4 mt-5 text-center">
                <?php 
                    //encryptar
                    $encrypt1 = (($id * 123456789 * 5678) / 956783);
                    $linkE = "../controlador/inventarioController.php?actionCRUD=eliminar&pagina=1&idE=".urlencode(base64_encode($encrypt1));
                    $linkM = "../controlador/inventarioController.php?actionCRUD=modificar&pagina=1&idM=".urlencode(base64_encode($encrypt1));
                    $linkMD = "../controlador/inventarioController.php?actionCRUD=masDetalles&pagina=1&p=empleado&idM=".urlencode(base64_encode($encrypt1));
                 ?>
                    <p><b>Acciones</b></p>              
                    <a href="<?php echo $linkMD; ?>" class="btn btn-info mt-2 btn-sm">Más detalles</a>
                    
                </div>
            </div> 
            </div> 
        <?php         
            }
        }else {//cierra if
        ?>
            <div class="col-12 mt-5">
                <h2 class="text-center font-weight-light">No hay resultados :(</h2>
            </div>
    
        <?php  
          }//cierra else
    
        ?>
        
    <!-- termina mostrar productos -->
     <!-- Paginacion -->    
     <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                <?php if(isset($_GET['pagina'])){?>

                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled':''; ?>">
                    <a class="page-link" href="inventario.php?pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                  </li>
                  <?php 
                      for ($i=0; $i < $paginas; $i++) {                      
                  ?>
                      <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                        <a class="page-link" href="inventario.php?pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                        </li>
                  <?php 
                      }//cierra for de la paginacion 
                  ?>
                  <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                    <a class="page-link" href="inventario.php?pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                  </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- Termina Paginacion -->

<!-- Modal para el registro -->
<div class="modal fade" id="modalRegistroProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <div class="mr-3">
                    <img src="../img/agregarProd100.png" alt="" style="max-widht: 100%">
                </div>
                <h5 class="modal-title" id="exampleModalLabel">Registro de Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Formulario registro de proovedor -->
                <form action='../controlador/inventarioController.php?pagina=1' method="POST" enctype="multipart/form-data" onsubmit="mostrarSpinner('spinnerReg')">
                  <h5 class="font-weight-light mb-3">Datos del Producto</h5>
                  <div class="form-row mt-2">
                         <div class="col-sm-6 col-md-2 col-lg-2">
                            <p class="text-center">Foto</p>
                         </div>
                         <div class="col-sm-6 col-md-10 col-lg-10">
                         <input type="file" 
                             name="foto" 
                             class="form-control-file" 
                             accept="image/*"
                             required
                        > 
                         </div>
                    </div>
                     <div class="form-row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                        <p class="text-center">Código</p>
                         </div>
                         <div class="col-sm-12 col-md-4 col-lg-4">
                           <input type="number" 
                                name="codigo" 
                                class="form-control mb-1" 
                                placeholder="" 
                                required
                            >
                         </div>
                         <div class="col-sm-12 col-md-2 col-lg-2">
                            <p class="text-center">Nombre</p>   
                         </div>
                         <div class="col-sm-12 col-md-4 col-lg-4">
                           <input type="text" 
                                name="nombre" 
                                class="form-control mb-1" 
                                placeholder="Nombre del producto"
                                required
                            >
                         </div>
                     </div>
                     <div class="form-row mt-2">
                        <div class="col-sm-6 col-md-4 col-lg-2">
                        <p class="text-center">Categoria</p>
                         </div>
                         <div class="col-sm-6 col-md-4 col-lg-4">
                            <select name="categoria" id="" class="form-control" onchange="mostrarSubcat(this.value, 'subcat-div')">
                                <option value="Alimentos">Alimentos</option>
                                <option value="Abarrotes">Abarrotes</option>
                                <option value="Servicios" disabled>Servicios</option>
                            </select>
                         </div>
                         <div class="col-sm-6 col-md-2 col-lg-2">
                            <p class="text-center">Subcategoria</p>
                         </div>
                            <div class="col-sm-6 col-md-4 col-lg-4"> 
                            <div id="subcat-div">                    
                                <select name="subCategoria" id="" class="form-control">                            
                                        <option value="Quesos y Lacteos">Quesos y Lacteos</option>
                                        <option value="Carnes frias y Embutidos">Carnes frias y Embutidos</option>
                                        <option value="Bebidas y Frituras">Bebidas y Frituras</option>
                                        <option value="Reposteria">Reposteria</option>                    
                                </select>
                                </div>
                            </div>
                    </div>
                    <div class="form-row mt-2">
                         <div class="col-sm-6 col-md-2 col-lg-2">
                            <p class="text-center">Precio</p>
                         </div>
                         <div class="col-sm-6 col-md-4 col-lg-4">
                         <input type="number" 
                             name="precio" 
                             class="form-control" 
                             required
                        > 
                         </div>
                         <div class="col-sm-6 col-md-2 col-lg-2">
                            <p class="text-center">Cantidad</p>
                         </div>
                         <div class="col-sm-6 col-md-4 col-lg-4">
                         <input type="number" 
                             name="cantidad" 
                             class="form-control" 
                             required
                        > 
                         </div>
                    </div>
                    <div class="form-row mt-2 mb-2">
                         <div class="col-sm-6 col-md-2 col-lg-2">
                            <p class="text-center">Descripción</p>
                         </div>
                         <div class="col-sm-6 col-md-4 col-lg-10">
                            <textarea name="descripcion" id="" class="form-control" rows="3"></textarea>
                         </div>
                    </div>
                    <div class="form-row mt-2 mb-2">
                         <div class="col-sm-6 col-md-2 col-lg-2">
                            <p class="text-center">Proveedor del Producto</p>
                         </div>
                         <div class="col-sm-6 col-md-4 col-lg-10">
                            <select name="idProv" id="" class="form-control">
                                <?php     
                                     while ($reg2 = mysqli_fetch_array($proveedores)){
                                ?>
                                    <option value="<?php echo $reg2[0]; ?>"> 
                                        <?php echo $reg2[1]." - ".$reg2[2]." - ".$reg2['Categoria']?> 
                                    </option>
                                <?php 
                                     }
                                
                                ?>
                            </select>
                         </div>
                    </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="btnRegistrarProd" value="registrar">Registrar</button>
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

}//cierra validacion de un inicio de sesion previo
?>