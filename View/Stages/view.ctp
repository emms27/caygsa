<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

  $fdateupdate=explode(' ',$stage['Stage']['fecha_update']);
  $fdatealta=explode(' ',$stage['Stage']['fecha_registro']);
  $parteid=$stage['Stage']['id'];
?>

<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Partes', 
                                array('controller'=>'Involucrados','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Vista', 
                                array('controller'=>'Involucrados','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="96%"><h1>Consulta de Etapas</h1></td>
 </tr>
 <tr>
  <td colspan="2" class="arial11gris" align="left">
   La consulta de etapas te muestran toda la informacion de la etapa seleccionada.<br><br>
  </td>
 </tr>
 <tr>
  <td colspan="2">

  </td>
 </tr>
</table>


<!--  Informacion General --> 

    
         
<table border="0" class="estado">
 <tr>
  <td>
   <table border="0" width="100%">
    <tr>
     <td width="88%"><span align="left" class="arial14cafe2"></td>
     <td width="12%">


<div class="btn-group">
    <?php
         echo $this->Html->link('<i class="icon-edit"></i>',
				array('action' => 'add'),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Html->link('<i class="icon-pencil"></i>',
				array('action' => 'edit', $stage['Stage']['id']),
		                array('escape' => false,"class"=>"btn"));
     ?>
</div>


     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr><td>&nbsp;</td></tr>
 <tr>
  <td>
   <table border="0">
   <tr><td valign="top">
    <table border="0" class="accionvista">
     <tr>
      <th><span>Expediente:</span></th>
      <td><?php 
 	echo $this->Html->link($stage['Expediente']['expediente'], 
	array('plugin' => false,'controller' => 'Expedientes', 'action' => 'view', $stage['Stage']['cbexpediente_id'])); 
	?>
      </td>
     </tr>
     <tr>
      <th><span>Juzgado:</span></th>
      <td><?php echo $cbexpediente['Juzgado']; ?></td>
     </tr>
     <tr>
      <th><span>Etapa:</span></th>
      <td><?php echo h($stage['Etapa']['etapa']);  ?></td>
     </tr>	
     <tr>
      <th><span>Fecha de Acuerdo:</span></th>
      <td><?php echo h($stage['Stage']['fecha_acuerdo']);  ?></td>
     </tr>	
     <tr>
      <th><span>Fecha Notificación:</span></th>
      <td><?php echo h($stage['Stage']['fecha_notificacion']);  ?></td>
     </tr>
     <tr>
      <th><span>Fecha de Terminación:</span></th>
      <td><?php echo h($stage['Stage']['fecha_terminacion']);  ?></td>
     </tr>
      <th><span>Fecha de Regitro:</span></th>
      <td><?php  echo $this->Dates->FormatoCompletoFecha($fdatealta[0]).'&nbsp;&nbsp;'.$fdatealta[1]; ?></td>
     </tr>
    </table> <br><br>
   </td>
   <td valign="top">
    <div align="center">
      <?php 
      ?>
<!--
      <object data="pdfFiles/interfaces.pdf" type="application/pdf">
                <embed src=" pdfFiles/interfaces.pdf" type="application/pdf">&nbsp; </embed>
                    alt :<a href="pdfFiles/interfaces.pdf">
                </object>
-->
    </div>
   </td>
  </tr>
  </table>

 <div style="width:100%;">
  <?php

      echo $this->Form->textarea('Stage.notas',
	                       array('rows' => '5', 
	 		   	     'class'=>'ckeditor',
		                     'cols' => '5',
				     'default'=>$stage['Stage']['notas']
		              ));

   ?>
 </div>

  </td>
 </tr>
</table><!-- FIN Informacion General --> 
 
<p align="center" class="arial11grisclaro" >
 <em><strong>Última Actualización:</strong>
  <?php  echo $this->Dates->FormatoCompletoFecha($fdateupdate[0]).'&nbsp;&nbsp;'.$fdateupdate[1]; ?>
 </em>
</p>
