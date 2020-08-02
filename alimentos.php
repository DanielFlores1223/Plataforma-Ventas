<?php 
include('plantillas/bootstrap.php'); 
include('plantillas/header.php'); 
include('controlador/prodIndexController.php')
?>
<form action="" method="post">


</form>
<div class="container">
<div class="row">
<?php 
    if($res != false){
        while($reg = mysqli_fetch_array($res)){
?>
        
          <div class="col-4">
            <div class="card my-2" style="width: 20rem;">
            <img src="<?php echo  $reg['Foto'] != "" ? $reg['Foto'] : 'img/default_img.png' ; ?>" class="card-img-top" style='height: 18rem;'>
              <div class="card-body">
                <h5 class="card-title"><?php echo $reg['NombreProd'] ?></h5>
                <p class="card-text"><b>Precio:</b> <b class="text-success"><?=$reg['Precio']?></b> pesos.</p>
                <a href="#" class="btn btn-info">Más detalles</a>
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
                    <a class="page-link" href="alimentos.php?c=Al&pagina=<?php echo $_GET['pagina'] - 1; ?>">Anterior</a>
                  </li>
                  <?php 
                      for ($i=0; $i < $paginas; $i++) {                      
                  ?>
                      <li class="page-item <?php echo $_GET['pagina'] == ($i+1) ? ' active' : '' ?>">
                        <a class="page-link" href="alimentos.php?c=Al&pagina=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                        </li>
                  <?php 
                      }//cierra for de la paginacion 
                  ?>
                  <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':''; ?>">
                    <a class="page-link" href="alimentos.php?c=Al&pagina=<?php echo $_GET['pagina'] + 1; ?>">Siguiente</a>
                  </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- Termina Paginacion -->
<?php include('plantillas/footer.php'); 

?> 
