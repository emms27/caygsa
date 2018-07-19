<?php 
 header('Content-type: application/vnd.ms-excel');
 header("Content-Disposition: attachment; filename=Reporte por Juzgado.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 
 echo $content_for_layout; 
?>
