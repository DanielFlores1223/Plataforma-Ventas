<?php 
session_start();
include("../controlador/servicioController.php");
include("barraEmpleado.php");

//validamos que el usuario haya iniciado sesion
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
?>

 <!-- Barra de busqueda -->
 <div class="container">
 <form action="servicios.php?pagina=1&p=admin" method="POST">
        <div class="row bg-light text-dark p-2">
          <div class="col-sm-12 col-md-5 col-lg-5 ">
            <label>Servicios</label>             
          </div>
          <div class="col-sm-12 col-md-5 col-lg-5 text-center">
          <?php 
             if(isset($_POST['estatus'])){
               switch ($_POST['estatus']) {
                 case 'Completo':
          ?>
                  
                  <input type="radio" 
                           name="estatus" 
                           value="Pendiente"
                           id="p"
                           class="mr-0 ml-2"
                           onclick="submit()"
                  >
                  <label for="p">Pendiente</label>
                  <input type="radio" 
                            name="estatus" 
                            value="Completo" 
                            id="c"
                            class="mr-0 ml-2"
                            checked
                            onclick="submit()"
                     >
                    <label for="c">Completo</label>
                    <input type="radio" 
                           name="estatus" 
                           id="cancel"
                           value="Cancelado"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           
                    >
                    <label for="cancel">Cancelado</label>
                    <input type="radio" 
                           name="estatus" 
                           id="t"
                           value="Todos"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           
                    >
                    <label for="t">Todos</label>
                  </div>
          <?php         
                   break;
                 case 'Cancelado':
          ?>
                  
                  <input type="radio" 
                           name="estatus" 
                           value="Pendiente"
                           id="p"
                           class="mr-0 ml-2"
                           onclick="submit()"
                  >
                  <label for="p">Pendiente</label>
                  <input type="radio" 
                            name="estatus" 
                            value="Completo" 
                            id="c"
                            class="mr-0 ml-2"
                            onclick="submit()"
                            
                  >
                  <label for="c">Completo</label>
                  <input type="radio" 
                           name="estatus" 
                           value="Cancelado"
                           id="cancel"
                           class="mr-0 ml-2"
                           checked
                           onclick="submit()"
                  >
                  <label for="cancel">Cancelado</label>
                  <input type="radio" 
                           name="estatus" 
                           id="t"
                           value="Todos"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           
                    >
                    <label for="t">Todos</label>
                  </div>
          <?php
                    break;
                  case 'Pendiente':                   
          ?>    
                       
                        <input type="radio" 
                                 name="estatus" 
                                 value="Pendiente"
                                 class="mr-0 ml-2"
                                 id="p"
                                 checked
                                 onclick="submit()"
                          >
                          <label for="p">Pendiente</label>
                        <input type="radio" 
                                  name="estatus" 
                                  value="Completo" 
                                  id="c"
                                  class="mr-0 ml-2"
                                  onclick="submit()"
                           >
                          <label for="c">Completo</label>
                          <input type="radio" 
                                 name="estatus" 
                                 value="Cancelado"
                                 id="cancel"
                                 class="mr-0 ml-2"
                                 onclick="submit()"
                          >
                          <label for="cancel">Cancelado</label>
                          <input type="radio" 
                           name="estatus" 
                           id="t"
                           value="Todos"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           
                          >
                          <label for="t">Todos</label>
                        </div>
            <?php
                    break;
                  case 'Todos':                   
            ?>    
                       
                        <input type="radio" 
                                 name="estatus"
                                 id="p" 
                                 value="Pendiente"
                                 class="mr-0 ml-2"
                                 onclick="submit()"
                          >
                          <label for="p">Pendiente</label>
                        <input type="radio" 
                                  name="estatus" 
                                  id="c"
                                  value="Completo" 
                                  class="mr-0 ml-2"
                                  onclick="submit()"
                           >
                          <label for="c">Completo</label>
                          <input type="radio" 
                                 id="cancel"
                                 name="estatus" 
                                 value="Cancelado"
                                 class="mr-0 ml-2"
                                 onclick="submit()"
                          >
                          <label for="cancel">Cancelado</label>
                          <input type="radio" 
                           name="estatus" 
                           value="Todos"
                           id="t"
                           class="mr-0 ml-2"
                           checked
                           onclick="submit()"
                           
                          >
                          <label for="t">Todos</label>
                        </div>
          <?php
                 break;
                }//cierra switch
             }else{
          ?>
            
            <input type="radio" 
                     name="estatus" 
                     value="Pendiente"
                     id="p"
                     class="mr-0 ml-2"
                     checked
                     onclick="submit()"
              >
              <label for="p">Pendiente</label>
            <input type="radio" 
                      name="estatus" 
                      id="c"
                      value="Completo" 
                      class="mr-0 ml-2"
                      onclick="submit()"
                      
               >
              <label for="c">Completo</label>
              <input type="radio" 
                     name="estatus"
                     id="cancel" 
                     value="Cancelado"
                     class="mr-0 ml-2"
                     onclick="submit()"
              >
              <label for="cancel">Cancelado</label>
              <input type="radio" 
                           name="estatus" 
                           value="Todos"
                           id="t"
                           class="mr-0 ml-2"
                           onclick="submit()"
                           
              >
              <label for="t">Todos</label>
            </div>
          <?php 
             }//cierra else
          ?>
        </div>   
        </div>
        <!-- cierra los filtros de busqueda radio buttons -->
        <hr>
        <div class="container">
        <?php  
            if ($servicios != false) {
                while ($reg = mysqli_fetch_array($servicios)) {
                    $idV = $reg['Id_Venta'];
        ?>
        <div class="card mb-2">
            <div class="row mb-3 card-body">
                    <div class="col-3">
                    <?php 
                            if( $reg['Nombre'] =='Telcel Recarga 100' || $reg['Nombre'] == 'Telcel Recarga 200' || $reg['Nombre'] == 'Telcel Recarga 500'){
                    ?>
                                 <img src="../img/telcelImg.jpg" alt="" style="max-width: 100%;">
                    <?php
                            }elseif($reg['Nombre'] =='Movistar Recarga 100' || $reg['Nombre'] =='Movistar Recarga 200' || $reg['Nombre'] =='Movistar Recarga 500'){
                    ?>  
                                 <img src="../img/movistarImg.jpg" alt="" style="max-width: 100%;">          
                    <?php       
                            }elseif($reg['Nombre'] =='Unefon Recarga 100' || $reg['Nombre'] =='Unefon Recarga 200' || $reg['Nombre'] =='Unefon Recarga 500'){
                    ?>       
                                <img src="../img/unefonImg.png" alt="" style="max-width: 100%;">    
                    <?php            
                            }      
                    ?>
                    </div>
                    <div class="col-6">
                        <h4 class="font-weight-light text-info">Información del servicio</h4>
                        <p><b class="text-info">Nombre del servicio: </b><?= $reg['Nombre'] ?> </p>
                        <p><b class="text-info">Tipo de servicio: </b><?= $reg['Tipo'] ?> </p>
                        <p><b class="text-info">Fecha: </b><?= $reg['FechaVenta'] ?> </p>
                        <p><b class="text-info">Número de celular: </b><?= $reg['Numero_cel'] ?> </p>
                    </div>
                    <div class="col-3">
                       <p class="h5"><b class="text-info">Total: </b><?= $reg['Total'] ?> pesos</p>
                       <p class=""><b class="text-info">Estatus:</b>
                            <?php  if($reg['Estatus'] == "Pendiente"){ ?>
                                        <b class="font-weight-normal table-warning p-1"><?= $reg['Estatus'] ?></b>
                            <?php }elseif($reg['Estatus'] == 'Completo'){ ?>
                                        <b class="font-weight-normal table-success p-1"><?= $reg['Estatus'] ?></b>
                            <?php }elseif($reg['Estatus'] == 'Cancelado'){ ?>
                                        <b class="font-weight-normal table-danger p-1"><?= $reg['Estatus'] ?></b>
                            <?php }?>
                       </p>
                       <div class="row">
                       <?php  
                            if($reg['Estatus'] != 'Completo'){
                                if ($reg['Estatus'] == 'Cancelado') {
                        ?>  
                                    <div class="col-11 mb-1">
                                    <a href="../controlador/servicioController.php?p=admin&phone=<?=$reg['Numero_cel']?>&action=completo&id=<?= $idV ?>" 
                                       class="btn btn-success btn-sm form-control mr-3"
                                       target="target=_blank"
                                    >
                                       Activar y completar
                                    </a>
                            </div>
                       <?php 
                                }else{
                       ?>
                            <div class="col-11 mb-1">
                                 <a href="../controlador/servicioController.php?p=admin&phone=<?=$reg['Numero_cel']?>&action=completo&id=<?= $idV ?>" 
                                    class="btn btn-success btn-sm form-control mr-3"
                                    target="target=_blank"
                                 >
                                    Completado
                                 </a>
                            </div>
                        <?php 
                                }
                            }                        
                        ?>    
                        <?php  
                            if($reg['Estatus'] != 'Cancelado'){
                       ?>
                            <div class="col-11 mb-1">
                                 <a href="../controlador/servicioController.php?p=admin&phone=<?=$reg['Numero_cel']?>&action=cancel&id=<?= $idV ?>"
                                    class="btn btn-danger btn-sm form-control"
                                    target="target=_blank"
                                >
                                    Cancelar
                                </a>
                            </div>
                        <?php 
                            }                        
                        ?> 
                            <div class="col-11">
                                 <a href="https://www.mercadolibre.com/jms/mlm/lgz/msl/login/H4sIAAAAAAAEAy2NQQ7DIAwE_-JzlNw59iPIIg5BwTUCR6SK8veaqscd745vyBLT2-unEDigq-QUksIEJaNuUtmn1Q5cDLWk9I-ZRwUrMinVBu4eokjri2w0VBvmRlbCU3e_ZenGfr-MRbGwq5bmlqX3PjPVgKsUjDIH4ZmvBZ7JHE29VgwHOK0nPV_uxm0QrwAAAA/user"
                                    class="btn btn-primary btn-sm form-control"
                                    target="target=_blank"
                                 >
                                    Ir a mercado pago
                            </a>
                            </div>
                       </div>
                    </div>
            
            </div>
        </div> 
                  
        <?php
                }
            }else{
        ?>    
            <h4 class="font-weight-light text-center h2 mt-5">No hay resultados</h4>
        <?php 
            }
        ?>
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