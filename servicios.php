<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?>
<?php include('controlador/servicioController.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center mb-2 ml-3 mt-2">
            <?php 
                if(isset($_POST['compañia'])){
                    switch ($_POST['compañia']) {
                        case 'Telcel':        
            ?>
                            <img src="img/telcelImg.jpg" alt="" style="max-width: 100%; height: 15rem; width: 20rem">
            <?php 
                            break;
                        case 'Movistar':
            ?>
                            <img src="img/movistarImg.jpg" alt="" style="max-width: 100%; height: 15rem; width: 20rem">
            <?php 
                            break;
                        case 'Unefon':
            ?>
                            <img src="img/unefonImg.png" alt="" style="max-width: 100%; height: 15rem; width: 20rem">
            <?php 
                            break;
                    }
                }else{ 
            ?>
                    <img src="img/servicios.jpg" alt="" style="max-width: 100%; height: 15rem; width: 20rem">
            <?php 
                    }    
            ?>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="col-2">
                        <label for="" class="font-weight-bold text-info" >Compañia</label>
                    </div>
                    <div class="col-10">
                        <?php 
                            if(isset($_POST['compañia'])){
                        ?>
                                <select name="compañia" id="" class="form-control" onchange="submit()">
                                    <option value="Telcel" <?php echo $_POST['compañia'] == 'Telcel' ? 'selected':'' ?> >Telcel</option>
                                    <option value="Movistar" <?php echo $_POST['compañia'] == 'Movistar' ? 'selected':'' ?>>Movistar</option>
                                    <option value="Unefon" <?php echo $_POST['compañia'] == 'Unefon' ? 'selected':'' ?>>Unefon</option>
                                </select>
                        <?php 
                            }else{
                        ?>
                                <select name="compañia" id="" class="form-control" onchange="submit()">
                                    <option value="" disabled selected>--seleccione una opción--</option>
                                    <option value="Telcel">Telcel</option>
                                    <option value="Movistar">Movistar</option>
                                    <option value="Unefon">Unefon</option>
                                 </select> 
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="col-2">
                        <label for="servicios.php" class="font-weight-bold text-info">Recarga</label>
                    </div>
                    <div class="col-10">
                        <?php 
                            if(isset($_POST['recarga'])){
                        ?>
                                <select name="recarga" id="" class="form-control" onchange="submit()">
                                    <option value="100" <?php echo $_POST['recarga'] == '100' ? 'selected':'' ?>>100 pesos</option>
                                    <option value="200" <?php echo $_POST['recarga'] == '200' ? 'selected':'' ?>>200 pesos</option>
                                    <option value="500" <?php echo $_POST['recarga'] == '500' ? 'selected':'' ?>>500 pesos</option>
                                </select>
                        <?php 
                            }else{
                        ?>
                                <select name="recarga" id="" class="form-control" onchange="submit()">
                                    <option value="100">100 pesos</option>
                                    <option value="200">200 pesos</option>
                                    <option value="500">500 pesos</option>
                                </select>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="form-row mt-2">
                <?php if (isset($_POST['compañia'])) {
                        ?>
                    <div class="col-2">
                        <label for="" class="font-weight-bold text-info">Celular</label>
                    </div>
                    <div class="col-10">
                        <input type="tel" name="tel" id="" class="form-control" placeholder="Ingrese su número de celular" required>       
                    </div>
                </div>
                <div class="form-row mt-2 mb-3">
                    <div class="col-12 text-center">
                    <?php if(isset($_POST['btn-recarga'])){ ?>
                                <a href="<?=$boton?>" class="btn btn-warning" target="_blank">Recargar</a>         
                            <?php
                        }else{ ?>
                            <button name="btn-recarga" type="submit" class="btn btn-warning">Siguiente</button>
                        <?php
                        }
                        } ?>
                    </div>
                </div>
            
            </form>
        
        </div>
        <div class="col-3"></div>
    
    </div>
</div>


<?php if(isset($_POST['compañia']))
            include('plantillas/footer.php'); 
      else
            include('plantillas/footerAdaptado.php');              
            
?> 
