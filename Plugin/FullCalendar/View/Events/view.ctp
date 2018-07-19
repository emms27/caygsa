<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

  $fdateupdate=explode(' ',$event['Event']['fecha_update']);
  $fdatealta=explode(' ',$event['Event']['fecha_registro']);
  $parteid=$event['Event']['id'];
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
  <td width="96%"><h1>Consulta de Eventos</h1></td>
 </tr>
 <tr>
  <td colspan="2" class="arial11gris" align="left">
   La consulta de eventos te muestran toda la informacion del evento seleccionado.<br><br>
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
				array('plugin' => 'full_calendar', 'action' => 'edit', $event['Event']['id']),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Form->postLink('<i class="icon-trash"></i>',
	  array('action' => 'cancel', $event['Event']['id']),
	  array('escape' => false,"class"=>"btn"), __('¿Realmente desea cancelar el evento %s?', $event['Event']['id'])
                );

         echo $this->Html->link('<i class="icon-search"></i>',
				array('plugin' => 'full_calendar', 'action' => 'index'),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Html->link('<i class="icon-calendar"></i>',
				array('plugin' => 'full_calendar','controller' => 'full_calendar'),
		                array('escape' => false,"class"=>"btn"));
     ?>

  <div class="btn-group">

   <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
   <i class="icon-download-alt"> </i>
    <span class="icon-caret-down"></span></a>
  <ul class="dropdown-menu">
    <li>
     <?php
         echo $this->Html->link('<i class="icon-download-alt"></i> Excel',
				array('action' => 'expediente_pdf',$event['Event']['id']),
		                array('escape' => false));
     ?>
    </li>
    <li>
     <?php
         echo $this->Html->link('<i class="icon-download-alt"></i> Texto Plano',
				array('action' => 'expediente_pdf',$event['Event']['id']),
		                array('escape' => false));
     ?>
    </li>
  </ul>
 </div>
</div>


     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr><td>&nbsp;</td></tr>
 <tr>
  <td>
   <table border="0" class="accionvista">
    <tr>
     <th><span>Expediente:</span></th>
     <td><?php 
	echo $this->Html->link($event['Event']['cbexpediente_id'], 
	array('plugin' => false,'controller' => 'Expedientes', 'action' => 'view', $event['Event']['cbexpediente_id'])); ?></td>
    </tr>
    <tr>
     <th><span>Tipo de Evento:</span></th>
     <td><?php echo $this->Html->link($event['EventType']['name'], array('controller' => 'event_types', 'action' => 'view', $event['EventType']['id'])); ?></td>
    </tr>
    <tr>
     <th><span>Título:</span></th>
     <td><?php echo h($event['Event']['title']);  ?></td>
    </tr>	
    <tr>
     <th><span>Detalles:</span></th>
     <td><?php echo h($event['Event']['details']);  ?></td>
    </tr>	
    <tr>
    <tr>
     <th><span>Status:</span></th>
     <td><?php echo h($event['Event']['status']);  ?></td>
    </tr>	
    <tr>
     <th><span>Inicio:</span></th>
     <td><?php echo h($event['Event']['start']); ?></td>
    </tr>
    <tr>
     <th><span>Fin:</span></th>
     <td><?php 	if($event['Event']['all_day'] != 1) echo $event['Event']['end']; else echo "N/A"; ?></td>
    </tr>
    <tr>
     <th><span>All Day:</span></th>
     <td><?php 
          if($event['Event']['all_day'] == 1) { echo "Yes"; } else { echo "No"; }
         ?></td>
    </tr>
     <th><span>Fecha de Regitro:</span></th>
     <td><?php  echo $this->Dates->FormatoCompletoFecha($fdatealta[0]).'&nbsp;&nbsp;'.$fdatealta[1]; ?></td>
    </tr>
   </table> <br><br>
  </td>
 </tr>
</table><!-- FIN Informacion General -->   
<p align="center" class="arial11grisclaro" >
 <em><strong>Última Actualización:</strong>
  <?php  echo $this->Dates->FormatoCompletoFecha($fdateupdate[0]).'&nbsp;&nbsp;'.$fdateupdate[1]; ?>
 </em>
</p>
