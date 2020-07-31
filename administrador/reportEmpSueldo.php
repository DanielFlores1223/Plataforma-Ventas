<?php 
error_reporting(0);
session_start();
    $n = $_SESSION['nombre'];
    $s = $_SESSION['sueldo'];
    count($n);
    $total = 0;
?>

<style type="text/css">
    .tabla{
        color: black;
        border: 1px solid;
        padding: 16px 48px;
         
    }

    .header{
        font-weight: bold;
        background-color: rgb(189, 189, 189);
    }

    .titulo{
        color: rgb(224, 191, 3);
    }

    .txt-center{
        text-align: center;
    }

    .txt-right{
        text-align: right;
    }

    .tdTotal{
        padding: 16px 48px;
        padding-right: 0;
    }

    h5{
        font-size: 20px;
    }

    td{
        font-size: 16px;
    }

    p{
        font-size: 16px;
    }
   
</style>

<div class="txt-right">
<p> <b>Fecha:</b>  
<?php  $fechaActual = date('d-m-Y'); 
  echo $fechaActual;?>
</p>
</div>

<div>
    <img src="../img/logo_crem_adap.png" alt="">
    <h5 class="txt-center titulo" >Cremeria y Abarrotes Liz</h5>
</div>
<h5 class="txt-center">Reporte de sueldos de los empleados</h5>
    <table align=center id="tabla" >
        <tr>
            <td class="tabla txt-center header">Nombre Completo</td>
            <td class="tabla txt-center header">Sueldo</td>
        </tr>
        <?php for($i = 0; $i < count($n); $i++){
                $total+=$s[$i];
            ?>
            <tr>
                <td class="tabla txt-center"><?php echo $n[$i]?></td>
                <td class="tabla txt-center"><?php echo $s[$i]?> pesos</td>
        
            </tr>
        <?php } ?>
            <tr>
                <td> 
                       
                </td>
                <td class="tabla txt-center">
                Total: <?php echo $total; ?> pesos
                </td>
            </tr>
    </table>
