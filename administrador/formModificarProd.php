<?php 
include("../controlador/inventarioController.php");
include('barraAdmin.php');

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $prod = $_SESSION['producto'];
?>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>

<div class="container">
 <!-- Formulario registro de proovedor -->
 <?php 
 if(isset($_GET['action'])){      
        if ($_GET['action'] == 'Ixfoto') {
?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Al intentar actualizar la foto.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/formModificarEmp.php');">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>  
<?php
        }
    }
       //encryptar
       $encrypt1 = (($prod[0] * 123456789 * 5678) / 956783);
       $linkMComplete = "../controlador/inventarioController.php?actionCRUD=mComplete&pagina=1&idM=".urlencode(base64_encode($encrypt1));
   ?>
 <form action='<?php echo $linkMComplete; ?>' method="POST" enctype="multipart/form-data" onsubmit="mostrarSpinner('spinnerReg')">
 <div class="form-row">
         <div class="col-2 text-center mt-2">
            <img src="<?php echo  $prod[8] != "" ? $prod[8] : '../img/default_img.png' ; ?>" style="max-width:100%;" alt="">
            <div id="formFoto">
               <button type="button"
                   name="btnActFoto"
                   class="btn btn-primary form-control"
                   onclick="mostrarFormFoto('formFoto')"
               >
                  Cambiar Foto
               </button>
            </div>     
         </div>
          <div class="col-10 mt-5">
          <h2 class="font-weight-light text-center my-3">Modificar Producto #<?php echo $prod[0];?></h2>
         
          </div>  
      </div> 
      <hr>
        <h5 class="font-weight-light mb-3 ">Datos del Producto</h5>
           <div class="form-row">
              <div class="col-sm-12 col-md-2 col-lg-2">
              <p class="text-center">Código</p>
               </div>
               <div class="col-sm-12 col-md-4 col-lg-4">
                 <input type="number" 
                      name="codigo" 
                      class="form-control mb-1" 
                      value="<?php echo $prod[0];?>"
                      required
                      disabled
                  >
               </div>
               <div class="col-sm-12 col-md-2 col-lg-2">
                  <p class="text-center">Nombre</p>   
               </div>
               <div class="col-sm-12 col-md-4 col-lg-4">
                 <input type="text" 
                      name="nombre" 
                      class="form-control mb-1" 
                      value="<?php echo $prod[1];?>"
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
                      <option value="Alimentos" <?php echo $prod[2] == 'Alimentos' ? 'selected' : '' ;?> >Alimentos</option>
                      <option value="Abarrotes"  <?php echo $prod[2] == 'Abarrotes' ? 'selected' : '' ;?>>Abarrotes</option>
                      <option value="Servicios" disabled>Servicios</option>
                  </select>
               </div>
               <div class="col-sm-6 col-md-2 col-lg-2">
                  <p class="text-center">Subcategoria</p>
               </div>
                  <div class="col-sm-6 col-md-4 col-lg-4"> 
                  <div id="subcat-div">                    
                      <select name="subCategoria" id="" class="form-control">  
                              <?php if($prod[2] == 'Alimentos'){ ?>                
                                        <option value="Quesos y Lacteos"
                                            <?php echo $prod[3] == 'Quesos y Lacteos' ? 'selected' : '' ;?>>
                                            Quesos y Lacteos
                                        </option>
                                        <option value="Carnes frias y Embutidos"
                                            <?php echo $prod[3] == 'Carnes frias y Embutidos' ? 'selected' : '' ;?>>
                                            Carnes frias y Embutidos
                                        </option>
                                        <option value="Bebidas y Frituras"
                                            <?php echo $prod[3] == 'Bebidas y Frituras' ? 'selected' : '' ;?>>
                                            Bebidas y Frituras
                                        </option>
                                        <option value="Reposteria"
                                            <?php echo $prod[3] == 'Reposteria' ? 'selected' : '' ;?>>
                                            Reposteria
                                        </option>
                              <?php }elseif ($prod[2] == 'Abarrotes') {?>
                                        <option value="Hogar y Limpieza" 
                                            <?php echo $prod[3] == 'Hogar y Limpieza' ? 'selected' : '' ;?>>
                                            Hogar y Limpieza
                                        </option>
                                        <option value="Salud y Cuidado Personal"
                                            <?php echo $prod[3] == 'Salud y Cuidado Personal' ? 'selected' : '' ;?>>
                                            Salud y Cuidado Personal
                                        </option>
                                        <option value="Semillas y Cereales"
                                            <?php echo $prod[3] == 'Semillas y Cereales' ? 'selected' : '' ;?>>
                                            Semillas y Cereales
                                        </option>
                                        <option value="Productos diversos"
                                            <?php echo $prod[3] == 'Productos diversos' ? 'selected' : '' ;?>>
                                            Productos diversos
                                        </option>
                            <?php } ?>                  
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
                   value="<?php echo $prod[5]?>"
                   class="form-control" 
                   required
              > 
               </div>
               <div class="col-sm-6 col-md-2 col-lg-2">
                  <p class="text-center">Existencia</p>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
               <input type="number" 
                   name="existencia" 
                   value="<?php echo $prod[4]?>"
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
                  <textarea name="descripcion" id="" class="form-control" rows="3"><?php echo $prod[6]?></textarea>
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
                      <option value="<?php echo $reg2[0]; ?> "
                      <?php echo $prod[7] == $reg2[0] ? 'selected' : '' ;?>> 
                        <?php echo $reg2[1]." - ".$reg2[2]." - ".$reg2['Categoria']?> 
                      </option>
                  <?php 
                       }
                  
                  ?>            
                  </select>
               </div>
          </div>
       <div class="modal-footer">
          <a href="inventario.php?pagina=1"  class="btn btn-secondary">Cancelar</a>
          <button type="submit" class="btn btn-success" name="btnRegistrarProd" value="registrar">Actualizar</button>
          <div id="spinnerReg"></div>
        </div>
</form>

      <!-- Termina Formulario registro de productor -->
      </div>
</div>
<?php 
}else{
    echo "<script>window.location.replace('../index.php')</script>";

}//cierra validacion de un inicio de sesion previo
?>