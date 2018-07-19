<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */

 $datetoday = $this->Helpers->load('Dates');
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Ayuda', 
                                array('controller'=>'pages','action'=>'help'),
				array('title'=>'Ayuda','escape' => false));
       ?>
</div><br><br>

<h6 style="float:right;"><?php echo $datetoday->fechaActual(); ?></h6>
<table class="cuadrocafe2">
 <tr>
  <td>
<video width="320" height="240" controls>
  <source src="<?php echo $this->webroot; ?>app/webroot/files/tutoriales/FichaBusqueda.ogv" type="video/ogg">
  Your browser does not support the video tag.
</video>
<div>Busqueda y Reporte de Fichas</div>
  </td>
 </tr>
</table>
