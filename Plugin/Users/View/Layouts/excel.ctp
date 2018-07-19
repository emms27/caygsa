<?php 
header('Content-type: application/vnd.ms-excel');
header("Pragma: no-cache");
header("Expires: 0");
header("Content-disposition: attachment; filename=nombre_archivo.xlsx");
echo $content_for_layout; 
?>
