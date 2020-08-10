<?php 
include("../modelo/clases.php");
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
//reportEmpSueldo.php

if(isset($_GET['r'])){
    switch ($_GET['r']) {
        case 'emsu':
            $reportePag = 'reportEmpSueldo.php';
            $orientacion = 'P';
            $nPdf = 'reporte de sueldos.pdf';
            $tamaño = 'A4';
            break;
        case 'prodSurt':
            $reportePag = 'reportprodSurt.php';
            $orientacion = 'L';
            $nPdf = 'reporte de productos a surtir.pdf';
            $tamaño = 'A4';
            break;
     
        case 'rdia':
            $reportePag = 'reportVentaDia.php';
            $orientacion = 'L';
            $nPdf = 'reporte de ventas por dia.pdf';
            $tamaño = 'A4';
            break;

        case 'rmes':
            $reportePag = 'reportVentaMes.php';
            $orientacion = 'L';
            $nPdf = 'reporte de ventas por mes.pdf';
            $tamaño = 'A4';
            break;
        
        case 'ryear':
            $reportePag = 'reportVentasYear.php';
            $orientacion = 'L';
            $nPdf = 'reporte de ventas por año.pdf';
            $tamaño = 'A4';
            break;
    }
}

ob_start();
require_once $reportePag;
$html = ob_get_clean();

$html2pdf = new Html2Pdf($orientacion,$tamaño,'es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output($nPdf);
?>