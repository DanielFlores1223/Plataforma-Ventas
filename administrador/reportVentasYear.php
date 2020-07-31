<?php 
session_start();
?>
<style type="text/css">
    .tabla{
        color: black;
        border: 1px solid;
        padding: 10px 32px;
         
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

    h5{
        font-size: 20px;
    }

    td{
        font-size: 16px;
    }

    p{
        font-size: 16px;
    }

    .tbl-ganancia{
        margin-top: 25px;
        background-color: rgb(109, 212, 68);
    }
   
    .td-2{
        border-left: 0px;
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
<h5 class="txt-center">Reporte de Ventas por año <?= $_SESSION['year'] ?></h5>
<table align=center>
    <tr>
        <td class="tabla txt-center header">Id</td>
        <td class="tabla txt-center header td-2">Metodo de pago</td>
        <td class="tabla txt-center header td-2">Tipo</td>
        <td class="tabla txt-center header td-2">Total</td>
        <td class="tabla txt-center header td-2">Fecha de la venta</td>
        <td class="tabla txt-center header td-2">Nombre del cliente</td>
        <td class="tabla txt-center header td-2">Tel</td>
    </tr>
    <?php for($i = 0; $i < count( $_SESSION['idVenta']); $i++){
    ?>
            <tr>
                <td class="tabla txt-center"><?= $_SESSION['idVenta'][$i]?></td>
                <td class="tabla txt-center td-2"><?= $_SESSION['metodoPago'][$i] ?></td>
                <td class="tabla txt-center td-2"><?= $_SESSION['tipo'][$i] ?></td>
                <td class="tabla txt-center td-2"><?= $_SESSION['total'][$i] ?></td>
                <td class="tabla txt-center td-2"><?= $_SESSION['fechaV'][$i] ?></td>
                <td class="tabla txt-center td-2"><?= $_SESSION['nombre'][$i] ?></td>
                <td class="tabla txt-center td-2"><?= $_SESSION['tel'][$i] ?></td>
            </tr>
        <?php } ?>
</table>

<table align=right class="tbl-ganancia">
<tr>
 <td class="tabla txt-center"> <b>Ganancia total del año: </b><?=$_SESSION['ganancia']?> pesos</td>
            
</tr>
</table>