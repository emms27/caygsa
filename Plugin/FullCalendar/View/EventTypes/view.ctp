<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

  $fdateupdate=explode(' ',$eventType['EventType']['fecha_update']);
  $fdatealta=explode(' ',$eventType['EventType']['created']);

  $etapas=$this->Html->tableHeaders(
                array('#', 
                      'Título',
		      '<i class="icon-time"></i> Inicio',
		      '<i class="icon-time"></i> Fin',
		      'All Day',
		      'Estado',
		      'Status',
		      'Acci&oacute;n'),
	              array('')); 

?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Expedientes', 
                                array('controller'=>'Expedientes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Consulta', 
                                array('controller'=>'Expedientes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Vista', 
                                array('controller'=>'Expedientes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>


<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="96%"><h1>Consulta Tipo de Eventos</h1></td>
 </tr>
 <tr>
  <td colspan="2" class="arial11gris" align="left">
   La consulta de dellate expediente te muestran el saldo que cuenta el expediente y el estado que guarda cada proceso.
  </td>
 </tr>
</table><br>

<table border="0" class="estado">
 <tr>
  <td>
   <table border="0" width="100%">
    <tr>
     <td width="87%"></td>
     <td width="13%">

<div class="btn-group">
    <?php
         echo $this->Html->link('<i class="icon-edit"></i>',
				array('action' => 'add'),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Html->link('<i class="icon-pencil"></i>',
				array('action' => 'edit', $eventType['EventType']['id']),
		                array('escape' => false,"class"=>"btn"));
     ?>

</div>

     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td><br>
   <table border="0" >
    <tr>
     <td width="50%">
    <table border="0" class="accionvista">
   <tr>
     <th><span>Expediente:</span></th>
     <td><?php echo h($eventType['EventType']['name']);  ?></td>
   </tr>
   <tr>
     <th><span>Tipo:</span></th>
     <td><?php echo h($eventType['EventType']['color']);  ?></td>
   </tr>
   <tr>
     <th><span>Fecha de Regitro:</span></th>
     <td><?php  echo $this->Dates->FormatoCompletoFecha($fdatealta[0]).'&nbsp;&nbsp;'.$fdatealta[1]; ?></td>
    </tr>
   </table> <br><br>
  </td>
 </tr>
</table><!-- FIN Informacion General --><br><br>
<!--
 <div aling="center" style="border:1px solid red; width:70%; text-align:center;">
  <?php
      echo $this->Form->textarea('X.notas',
	                       array('rows' => '5', 
	 		   	     'class'=>'ckeditor',
		                     'cols' => '5',
		                     'placeholder'=>'Escriba una observacion si es necesario'
		              ));
      
   ?>
 </div>
-->


    <table border="0" class="testgrid" >
     <?php
       echo $etapas; 
       $p=1; foreach ($eventType['Event'] as $event): 
     ?>
     <tr>
        <td><?php echo $p; ?></td>
        <td><?php echo $event['title'];?></td>
	<td><?php echo $event['start'];?></td>
        <td><?php if($event['all_day'] != 1) { echo $event['end']; } else { echo "N/A"; } ?></td>
        <td><?php if($event['all_day'] == 1) { echo "Yes"; } else { echo "No"; }?></td>
        <td><?php echo $event['status']; ?></td>
    <td>
      <?php
       if ($event['active']==0) $sclass="icon-remove red ajax-toggle";
       else $sclass="icon-ok green ajax-toggle";

         echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Events','action'=>'status',$event['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
	?>
     </td>
	<td>
      <div class="item-actions">
  <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'events','action'=>'view',$event['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'events','action'=>'edit',$event['id']),
				array('title'=>'Editar este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Editar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

	 echo $this->Form->postLink(_(''),
          array('controller'=>'events','action' =>'delete',$event['id']),
	  array('class'=>'icon-trash icon-large',
		'title'=>'Eliminar este elemento',
	        'data-title'=>"Eliminar este elemento",
	        'rel'=>"tooltip"),
		 __('¿Realmente desea hacer copiar de la orden %s?',$event['id'])
         );		 ?>
     </div>
       </td>
     </tr>
       <?php $p++; endforeach; ?>
      </table>

 
   <!-- FIN TAB --> 
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<p align="center" class="arial11grisclaro" >
 <em><strong>Última Actualización:</strong>
  <?php  echo $this->Dates->FormatoCompletoFecha($fdateupdate[0]).'&nbsp;&nbsp;'.$fdateupdate[1]; ?>
 </em>
</p>
