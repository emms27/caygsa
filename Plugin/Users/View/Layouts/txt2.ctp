<?php 
 $filename='layaout_chequexrango_'.date("dmY").'.txt';
header('Content-type: application/txt');
header('Content-Disposition: attachment; filename="'.$filename.'"');
echo $content_for_layout; 
?>
