<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */


    $tableHeaders = $this->Html->tableHeaders(array('',
        $this->Paginator->sort('Event.cbexpediente_id', 'Expediente', array('escape' => false)),
        $this->Paginator->sort('Event.title', 'Título', array('escape' => false)),
        $this->Paginator->sort('Event.cbeventtype_id', 'Tipo de Evento', array('escape' => false)),
	$this->Paginator->sort('Event.start', '<i class="icon-time"></i> Inicio', array('escape' => false)),
	$this->Paginator->sort('Event.end', '<i class="icon-time"></i> Fin', array('escape' => false)),
	$this->Paginator->sort('Event.all_day', 'All Day', array('escape' => false)),
	$this->Paginator->sort('Event.status', 'Estado', array('escape' => false)),
	$this->Paginator->sort('Event.active', 'Status', array('escape' => false)),
		    'Acci&oacute;n'),
		    array('class'=>'encabezado')
                   ); 
 

   $options = array(
    'label' => 'Buscar',
    'class'=>'btn',
    'div' => array('class' => 'input submit'));
?>
<!-- <a href="#" id="to-top"><i class="icon-chevron-up"></i></a>  -->



<div id="breadcrumb">
      <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Eventos',  '/full_calendar/Events'); 
              $this->Html->addCrumb('Consulta' ,  '/full_calendar/Events' , array('class' => 'breadcrumblast')); 
//              echo $this->Html->getCrumbs('  > ', 'Home');

       ?>
</div><br>

 <div class="arial11gris" align="left">
  La consulta de partes te muestran una línea temporal de todas las partes dadas de alta en el Sistema desde el principio de los tiempos.<br><br>
 </div>


 <div class="row-fluid">
  <div class="span12 actions">
   <ul class="nav-buttons">
    <li>
        <?php
         echo $this->Html->link('New Evento', 
                                array('plugin'=>'full_calendar','controller'=>'Events','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>



 <div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Event',array('action'=>'index','class'=>'form-inline'));  ?>
    <div class="input-append">
         <?php      
     echo $this->Form->input('sparte', array(
			     'type'=>'search',
			     'div' => false,
			     'label' => false,
			     'id'=>'sdeposito',
			     //'id'=>"example-input-append-btn2",
			     'class'=>"input-small",
			     'placeholder'=>"buscar..",
		             'style'=>'border:1px solid gray;',
		             'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                             'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on" 

	));
     ?>
      <button class="btn btn-success"><i class="icon-search"></i></button>
    </div>
<?php
      echo '<div class="input submit">';
      echo $this->Html->link('<i class="icon-repeat"></i>',
                                array('plugin'=>'full_calendar','controller'=>'Events','action'=>'index'),
				array('title'=>'Nueva Busqueda',
				      'escape' => false,
				      'class'=>'btn',
				      'data-title'=>'Nueva Busqueda',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
      echo '</div>'; 
  
     echo $this->Form->end();

 ?>
   </div>

   <table id="example-datatables3" class="table table-striped table-bordered table-hover">

    <thead><?php echo $tableHeaders; ?></thead>
    <?php $p=1; foreach ($events as $cliente):  ?>
    <tr>
     <td><?php echo $p; ?></td>
     <td><?php echo $cliente['Expediente']['expediente']; ?> </td>
     <td><?php echo $cliente['Event']['title']; ?> </td>
     <td><?php 
	echo $this->Html->link($cliente['EventType']['name'], array('controller' => 'event_types', 'action' => 'view', $cliente['EventType']['id'])); 
	 ?>
     </td>
     <td><?php echo $cliente['Event']['start']; ?></td>
     <?php if($cliente['Event']['all_day'] == 0) { ?>
	<td><?php echo $cliente['Event']['end']; ?></td>
     <?php } else { ?>
	<td>N/A</td>
     <?php } ?>
     <td><?php if($cliente['Event']['all_day'] == 1) { echo "Yes"; } else { echo "No"; } ?>&nbsp;</td>
     <td><?php echo $cliente['Event']['status']; ?></td>
     <td>
      <?php
       if ($cliente['Event']['active']==0) $sclass="icon-remove red ajax-toggle";
       else $sclass="icon-ok green ajax-toggle";

         echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Events','action'=>'status',$cliente['Event']['id']),
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
                                array('action'=>'view',$cliente['Event']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('action'=>'edit',$cliente['Event']['id']),
				array('title'=>'Editar este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Editar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
/*
	 echo $this->Form->postLink(_(''),
          array('action' => 'delete',$cliente['Event']['id']),
	  array('class'=>'icon-trash icon-large',
		'title'=>'Eliminar este elemento',
	        'data-title'=>"Eliminar este elemento",
	        'rel'=>"tooltip"),
		 __('¿Realmente desea hacer copiar de la orden %s?',$cliente['Event']['id'])
         );		 
*/
?>
     </div>
    </td>
    <?php $p++; endforeach; ?>
    </tr>
   </table>

 <div class="paging">
  <?php echo $this->Paginator->prev('« Anterior', null, null, array('class' => 'disabled')); 
   echo $this->Paginator->numbers(array('modulus'=>'9','separator' => ''));  
   echo $this->Paginator->next('Siguiente »', null, null, array('class' => 'disabled')); 
  ?>
 </div><p>&nbsp;Página <?php echo $this->Paginator->counter(array('format' => '%page% de %pages%')); ?>, registros encontrados    
<strong><?php echo $this->Paginator->counter(array('format' => '%count%')); ?></strong>.</p>


  </div>
 </div>
