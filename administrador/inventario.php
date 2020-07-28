<?php 
include("../controlador/inventarioController.php");
include("barraAdmin.php");

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
         <!-- Boton para abrir registro de empleado -->       
         <div class="col-sm-12 col-md-3 col-lg-2">     
                <button type="button" class="btn" data-toggle="modal" data-target="#modalRegistroProd">
                    <img src="../img/agregarProd100.png" alt="" style="max-widht: 100%">
                    <p>Registrar Producto</p>
                </button>              
            </div>
          </div>
          <hr>
         <!-- Termina Boton para abrir registro de empleado -->  


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
                <form action='../controlador/empleadoController.php?pagina=1' method="POST" enctype="multipart/form-data" onsubmit="mostrarSpinner('spinnerReg')">
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
                                        <option value="Bebidas y frituras">Bebidas y frituras</option>
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
                            <select name="" id="" class="form-control">
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