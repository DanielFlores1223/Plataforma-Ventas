<?php 
include('plantillas/bootstrap.php'); 
 include('plantillas/header.php'); 
 include('controlador/prodIndexController.php')
 ?>
<form action="" method="post">
<div class="container-fluid">
    <div class="row pb-3" style="background:rgb(238, 238, 238);">
        <div class="col-sm-12 col-md-3 col-lg-3">
        <?php 
              if(isset($_POST['sub'])){         
        ?>   
            <select name="sub" id="" class="form-control mt-2">
                <option value="" selected>Todos los productos</option>
                <option value="Hogar y Limpieza" <?php echo $_POST['sub'] == "Hogar y Limpieza" ? 'selected':''?>>Hogar y Limpieza</option>
                <option value="Salud y Cuidado Personal" <?php echo $_POST['sub'] == "Salud y Cuidado Personal" ? 'selected':''?>>Salud y Cuidado Personal</option>
                <option value="Semillas y Cereales" <?php echo $_POST['sub'] == "Semillas y Cereales" ? 'selected':''?>>Semillas y Cereales</option>
                <option value="Productos diversos" <?php echo $_POST['sub'] == "Productos diversos" ? 'selected':''?>>Productos diversos</option>
            </select>
        <?php 
              }else{
        ?>

            <select name="sub" id="" class="form-control mt-2">
                <option value="" selected>--Subcategoria--</option>
                <option value="Hogar y Limpieza">Hogar y Limpieza</option>
                <option value="Salud y Cuidado Personal">Salud y Cuidado Personal</option>
                <option value="Semillas y Cereales">Semillas y Cereales</option>
                <option value="Productos diversos">Productos diversos</option>
            </select>
        <?php 
            }
        ?>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
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
                 <button type="submit" name="btnBuscarProd" class="btn mt-2"><img src="img/lupaNormal.png" alt="imagen lupa"></button>
                </div> 
        </div>
    </div>
    </div>
</form>
<div class="container">
<div class="row">
<?php 
    if($res != false){
        while($reg = mysqli_fetch_array($res)){
          $id = $reg[0];
          //encryptar
          $encrypt1 = (($id * 123456789 * 5678) / 956783);
          $linkMD = "masDetalles.php?ir=masDetalles&c=ab&idM=".urlencode(base64_encode($encrypt1));
?>
        
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card my-2" style="width: 20rem; max-width:100%;">
            <a href="<?=$linkMD?>"> 
                <img src="<?php echo  $reg['Foto'] != "" ? $reg['Foto'] : 'img/default_img.png' ; ?>" class="card-img-top" style='height: 18rem;'>
            </a>  
              <div class="card-body">
                <h5 class="card-title"><?php echo $reg['NombreProd'] ?></h5>
                <p class="card-text"><b>Precio:</b> <b class="text-success"><?=$reg['Precio']?></b> pesos.</p>
                <a href="<?=$linkMD?>" class="btn btn-info">Más detalles</a>
                <a href="" class="btn btn-warning mt-2" data-toggle="modal" data-target="#modalInicioSesion">Agregar al carrito</a>
              </div>
            </div>
            </div>
        

<?php 
        }
    }
 ?>   
</div>
</div>

<!-- Paginacion -->    
<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                <?php if(isset($_GET['pagina'])){?>

                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled':''; ?>">
                    <a class="page-link" href="abarrotes.php?c=Ab&pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                  </li>
                  <?php 
                      for ($i=0; $i < $paginas; $i++) {                      
                  ?>
                      <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                        <a class="page-link" href="abarrotes.php?c=Ab&pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                        </li>
                  <?php 
                      }//cierra for de la paginacion 
                  ?>
                  <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                    <a class="page-link" href="abarrotes.php?c=Ab&pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                  </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- Termina Paginacion -->


  <?php include('plantillas/chatFace.php'); ?>
<?php include('plantillas/footer.php'); ?> 