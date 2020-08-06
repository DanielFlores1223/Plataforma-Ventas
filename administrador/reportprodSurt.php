<?php 
    session_start();
    $_SESSION['idProd'];
    $_SESSION['NombreProd'];
    $_SESSION['existencia'];
    $_SESSION['precio'];
    $_SESSION['n_prov'];
    $_SESSION['n_agen'];
    $_SESSION['tel'];
    $_SESSION['horario'];
    
?>
<style type="text/css">
    .tabla{
        color: black;
        border: 1px solid;
        padding: 10px 15px;
         
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
<h5 class="txt-center">Reporte de productos a surtir</h5>
<table align=center>
    <tr>
        <td class="tabla txt-center header">Id</td>
        <td class="tabla txt-center header">Nombre</td>
        <td class="tabla txt-center header">Existencia</td>
        <td class="tabla txt-center header">Precio</td>
        <td class="tabla txt-center header">Proveedor</td>
        <td class="tabla txt-center header">Agente</td>
        <td class="tabla txt-center header">Tel</td>
        <td class="tabla txt-center header">Horario</td>
    </tr>

    <?php for($i = 0; $i < count($_SESSION['idProd']); $i++){
    ?>
            <tr>
                <td class="tabla txt-center"><?= $_SESSION['idProd'][$i]?></td>
                <td class="tabla txt-center"><?= $_SESSION['NombreProd'][$i] ?></td>
                <td class="tabla txt-center"><?= $_SESSION['existencia'][$i] ?></td>
                <td class="tabla txt-center">$<?= $_SESSION['precio'][$i] ?></td>
                <td class="tabla txt-center"><?= $_SESSION['n_prov'][$i] ?></td>
                <td class="tabla txt-center"><?= $_SESSION['n_agen'][$i] ?></td>
                <td class="tabla txt-center"><?= $_SESSION['tel'][$i] ?></td>
                <td class="tabla txt-center"><?= $_SESSION['horario'][$i] ?></td>
            </tr>
        <?php } ?>
</table>