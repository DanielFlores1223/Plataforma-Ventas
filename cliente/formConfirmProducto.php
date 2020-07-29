<?php 
session_start();
include('barraCliente.php');
//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    include ('../modelo/conexion.php');
    include ('../modelo/clases.php');
    $obj = new ConexionMySQL("root","");
    $obj2 = new Producto();


    if(isset($_POST['idComprar'])){
        $id=$_POST['idComprar'];
        $obj2=$obj->getProduct($obj2,$id);
        if($obj2!=null){ ?>
            <form action="../controlador/pedido.php" method="POST"><hr>    
            <div class="container">
                <div class="card bg-light">
                    <div class="container">
                        <h3>Confirmar Pedido</h3>
                    </div><hr>
                    <div class="row mt-4">
                        <div class="col-3">
                            <div class="ml-4">
                            <img src='../img/default_img.png' width='190px' height='200px'>
                            </div>
                        </div>   
                        <div class='col-2'> 
                            <label>Producto</label>          
                            <p><?php echo $obj2->getNombreProd(); ?></p>
                            <label class="mt-2">Precio</label>
                            <p><?php echo $obj2->getPrecio(); ?></p>
                        </div> 
                        <div class="col-2">
                            <label>Categoria</label>  
                            <p><?php echo $obj2->getCategoria(); ?></p>
                            <label class="mt-2">SubCategoria</label>
                            <p><?php echo $obj2->getSubCat(); ?></p>
                        </div>
                        <div class="col-2">
                            <label>Cantidad </label>  
                            <select class="form-control"  name="cantidad" id="cant">
                                <option value="Todos">1</option>
                                <option value=2>2</option>
                                <option value="Abarrotes">3</option>
                                <option value="Servicios">4</option>
                                <option value="Servicios">5</option>
                                <option value="Servicios">6</option>
                                <option value="Servicios">7</option>
                                <option value="Servicios">8</option>
                                <option value="Servicios">9</option>
                            </select>      
                            <label class="mt-2">Total</label>
                            <input type="text" class="form-control" value="<?php echo $obj2->getPrecio(); ?>">
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class='col-12'>
                            <div class="text-right mr-4">            
                                <a href='home.php' class='btn btn-secondary '>Cancelar</a>
                                <button name='btn' value='guardar' type='submit' class='btn btn-success ' >Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div >
            </div>
           </form>
        <?php }else{
            echo "<script>window.location.replace('../cliente/home.php?action=fail')</script>";
        }
    }else{
        echo "<script>window.location.replace('../cliente/home.php')</script>";
    }

    if(isset($_POST['idAgregar'])){
        echo "<script>window.location.replace('../cliente/home.php?action=agregado')</script>";  
    }

    if(isset($_POST['idInfo'])){

        echo "<script>window.location.replace('../cliente/home.php?action=mostrar')</script>";
    }
}else{
    echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>