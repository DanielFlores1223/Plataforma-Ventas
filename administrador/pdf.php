<?php 
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
//reportEmpSueldo.php

if(isset($_GET['r'])){
    switch ($_GET['r']) {
        case 'emsu':
            $reportePag = 'reportEmpSueldo.php';
            break;
        
        default:
            # code...
            break;
    }
}

ob_start();
require_once $reportePag;
$html = ob_get_clean();

$html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output('nombre_pdf.pdf');
?>