<?php
session_start();
include("barraAdmin.php");
include('../modelo/conexion.php');
include('../modelo/clases.php');
if(isset($_SESSION['usuario'] ) && isset($_SESSION['contra'])){
    $obj= new ConexionMySQL("root",""); 
    $obj2 = new Empleado();
?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="../javascript/validaciones.js"></script>
<script src="../javascript/funcionesExtra.js"></script>
<!-- miperfil -->
<div class="container">
<?php if(isset($_GET['action'])){
                if($_GET['action']=='Actualizado'){?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                Se Actualizaron los datos <strong>Correctamente!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.replace('../administrador/perfil.php');">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php }else{
                    echo "NO SE PUDO ACTUALIZAR";
                }
            } ?>
                    <?php
                    $obj2=$obj->getEmpleadoInfo($_SESSION['usuario'],$obj2);
                    $_SESSION['idE']= $obj2->getIdEmpl();
                    //$nombre = $obj2->getNombre();
                    ?>
    <div class="card bg-light">
    <div class="row">
        <div class="col-2" align = right>
        <img src="<?php echo  $obj2->getFoto() != "" ? $obj2->getFoto() : '../img/empDefault.png' ; ?>" style="max-width:100%;" alt="">
            
        </div>
        <div class="col-4">
            <h5 class="card-title mb-4"><?php echo $obj2->getNombre()." ".$obj2->getApellidoP()." ".$obj2->getApellidoM(); ?></h5>
            <p>Fecha de Nacimiento: <?php echo $obj2->getFechaNac(); ?> </p>
            <p>Telefono: <?php echo $obj2->getTel(); ?></p>
            <p>Correo: <?php echo $obj2->getCorreo(); ?></p>
        </div>
        <div class="col-4">
            <h5 class="card-title mb-5"></h5>
            <p >Tipo de Empleado: <?php echo $obj2->getTipo(); ?> </p>
            <p>Sueldo: <?php echo $obj2->getSueldo(); ?></p>
            <p>Estatus: <?php echo $obj2->getEstatus(); ?></p>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-secondary ml-5 mt-1" data-toggle="modal" data-target="#configModal"> <img src="../img/config.png" alt=""></button>
        </div>
    </div>
    </div>
 </div>
<!--cierra miperfil -->
<!-- Notificaciones -->
<?php 
     $totalSP = 0;
     $totalVP = 0;
     $totalPE = 0;
     $notificaciones = 0;
     $serviciosP = $obj->consultaServicioVentaEstatus('Pendiente');
     $numPedidos = $obj->consultaVentaEstatus('Pendiente');
     $prodExistencia = $obj->reporteProdSurt();
       if ($serviciosP) {
        $notificaciones++;
        $totalSP = mysqli_num_rows($serviciosP);
       }
       if ($numPedidos) {
        $notificaciones++;
        $totalVP = mysqli_num_rows($numPedidos);
       }
       if ($prodExistencia) {
        $notificaciones++;
        $totalPE = mysqli_num_rows($prodExistencia);
       } 
?>
 <div class="container my-3">
    <div class="row my-3">
            <div class="col-12">
              <h4 class="font-weight-light h3">Notificaciones ( <?=$notificaciones?> )</h4>
              <hr>
            </div>   
    </div>
    <div class="row">
            <div class="col-12">
              <?php 
                  if ($totalSP > 0) {
              ?>
                  <div class="alert alert-warning" role="alert">
                      Tienes servicios pendientes por realizar
                  </div>
              <?php
                  }
                  
                  if ($totalVP > 0) {
              ?>
                  <div class="alert alert-info" role="alert">
                      Tienes pedidos pendientes por realizar
                  </div>
              <?php
                  }  
                  
                  if ($totalPE > 0) {
              ?>
                    <div class="alert alert-dark" role="alert">
                      Tienes productos por terminarse revisa el inventario.
                    </div>  
              <?php 
                  }
            
                  if ($notificaciones == 0) {                    
              ?>
                    No tienes Notificaciones 
              <?php 
                  }
              ?>
            </div>
    
    </div>
    
    <hr>
 </div>

<!--grafica-->
<div class="container">
    <div class="row">
            <div class="col-6">
            <p class="text-center h4 font-weight-light mt-2">Gráfica de clientes</p>
            <canvas id="grafica1" width="200" height="120" style="max-width:100%;"></canvas>
                   
            </div>    
<?php 
  $activos = $obj->totalClientesEstatus('Activo');
  $inactivos = $obj->totalClientesEstatus('Inactivo');
?>

<script type="text/javascript">
        var ctx= document.getElementById("grafica1").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"pie",
            data:{
                labels:['clientes activos','clientes inactivos',],
                datasets:[{
                        label:'Num datos',
                        data:[<?=$activos?>,<?=$inactivos?>],
                        backgroundColor:[
                          'rgb(74, 135, 72,0.5)',
                            '	rgb(230, 0, 0, 0.5)',
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>

<?php 
  $hoy = date('Y-m-d');
  $ayer = date('Y-m-d',strtotime($hoy."- 1 days"));
  $antier =date('Y-m-d',strtotime($hoy."- 2 days"));
  //echo"fecha de hoy: ".$hoy." dia: ".$ayer." ayer: ".$antier;
  $vHoy = $obj->totalVentasporDia($hoy); 
  $vAyer = $obj->totalVentasporDia($ayer);
  $vAntier = $obj->totalVentasporDia($antier);
  //echo $vHoy;    
?>
        <div class="col-6">
            <p class="text-center h4 font-weight-light mt-3">Gráfica de ventas de los últimos tres dias</p>
            <canvas id="grafica2" width="200" height="120" style="max-width:100%;"></canvas>                  
        </div>  

    </div>     
</div>
<script type="text/javascript">
        var ctx= document.getElementById("grafica2").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"bar",
            data:{
                labels:['Antier','Ayer','Hoy'],
                datasets:[{
                        label:'Ventas',
                        data:[<?=$vAntier?>,<?=$vAyer?>,<?=$vHoy?>],
                        backgroundColor:[
                          'rgb(74, 135, 72,0.5)',
                            'rgb(74, 135, 72,0.5)',
                            'rgb(74, 135, 72,0.5)',
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>

<!--cierra grafica-->

<!-- modal config -->
<div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <img src="../img/config.png" alt="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-12">
            <h5 class="text-center font-weight-light ">Configuraciones</h5>
            </div>
      </div>
        <div class="form-row">
            <div class="col-12 mt-2">
            <form action="perfilModifica.php" method="POST">
              <button type="submit" class="btn btn-primary form-control">Modificar Información</button>
            </form>
            </div>        
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="button" class="btn btn-primary form-control" data-dismiss="modal"  data-toggle="modal" data-target="#passModal">Cambiar contraseña</button>
            </div>        
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Cerrar</button>
            </div>        
        </div>
      </div>
    </div>
  </div>
</div>
<!--cierra modal config-->

<!-- modal cambio de contraseña -->
<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
      <img src="../img/pass_icono.png" alt="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-12">
            <h5 class="text-center font-weight-light ">Cambio de contraseña</h5>
            <div id="alerta"></div>      
      </div>
      </div>
            <form action="../controlador/modificaPerfil.php?cam=si" method="post" onsubmit="return validaPass(pass1, pass2, 'alerta')">
                <input type="password" 
                       name="pass1" 
                       class="form-control mt-1" 
                       placeholder="Ingrese su nueva contraseña"
                       required 
                       minlength='6' 
                       title='minimo 6 caracteres'
                >
                <input type="password" 
                       name="pass2" 
                       class="form-control mt-2" 
                       placeholder="Ingrese de nuevo la nueva contraseña"
                       required 
                       minlength='6' 
                       title='minimo 6 caracteres'
                >
                <button type="submit" name="btn" value="guardar" class="btn btn-primary form-control mt-2">Cambiar contraseña</button>
                <button type="button" class="btn btn-secondary form-control mt-2" data-dismiss="modal">Cerrar</button>
            </form>
    </div>
  </div>
</div>
<!--cierra modal config pass-->

  <!-- Cierra el contenido de la pagina con la barra de navegacion-->    
  </div>
</div>
<?php 
}else{
   echo "<script>window.location.replace('../index.php?action=fail')</script>";
}
?>
