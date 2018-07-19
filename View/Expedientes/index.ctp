<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

 $tableHeaders = $this->Html->tableHeaders(array('',
  $this->Paginator->sort('Expediente.expediente', '<i class="icon-file-alt"></i> Expediente', array('escape' => false)),
  $this->Paginator->sort('Expediente.globaljuzgado_id', '<i class="icon-legal"></i> Juzgado', array('escape' => false)),
  $this->Paginator->sort('Expediente.htsjpmateria_id', '<i class="icon-tasks"></i> Asunto', array('escape' => false)),
  $this->Paginator->sort('Expediente.cis', 'CIS', array('escape' => false)),
  $this->Paginator->sort('Expediente.num_credito', 'Núm. Crédito', array('escape' => false)),
  $this->Paginator->sort('Expediente.fecha_registro', '<i class="icon-time"></i> Registro', array('escape' => false)),
  $this->Paginator->sort('Expediente.fehcha_terminacion', '<i class="icon-time"></i> Terminación', array('escape' => false)),
		    'Acci&oacute;n'),
		    array('class'=>'encabezado')
                   ); 
 

   $options = array(
    'label' => 'Buscar',
    'class'=>'btn',
    'div' => array('class' => 'input submit'));

//$this->extend('/Common/admin_index');
/*$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Menus'), $this->here);
*/


?>
<div id="breadcrumb">
  <?php
    $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
    $this->Html->addCrumb('Expediente',  '/Expedientes'); 
    $this->Html->addCrumb('Consulta' ,  '/Expedientes' , array('class' => 'breadcrumblast')); 
    //echo $this->Html->getCrumbs('  > ', 'Home');
  ?>
</div><br>

 <div class="row-fluid">
  <div class="span12 actions">
   <ul class="nav-buttons">
    <li>
        <?php
         echo $this->Html->link('New Expediente', 
                                array('controller'=>'Expedientes','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>

<div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Expediente',array('action'=>'index','class'=>'form-inline'));  ?>
    <div class="input-append">
     <?php      
      echo $this->Form->input('sexpediente', array(
	 		      'type'=>'search',
			      'div' => false,
			      'label' => false,
			      'id'=>'sexpediente',
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
                                array('controller'=>'Expedientes','action'=>'index'),
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
			<?php
			$e=1;
			$rows = array();
			//foreach ($expediente  as $menu):
                        foreach ($expediente as $expediente): 
      //$rexp=$expediente['Expediente']['id'];
      //$nexpc1=substr($rexp, 4,-4); 
      //$nexpc2=substr($rexp, 8); 
    ?>
    <tr>
   	<td><?php echo $e; ?></td>
   	<td><?php echo $expediente['Expediente']['expediente']; ?></td>
        <td><?php echo $expediente['Juzgado']['organo_judicial']; ?></td>
        <td><?php echo $expediente['Materia']['descripcion']; ?></td>
        <td><?php echo $expediente['Expediente']['cis']; ?></td>
        <td><?php echo $expediente['Expediente']['num_credito']; ?></td>
        <td><?php echo $expediente['Expediente']['fecha_registro']; ?></td>
        <td><?php echo $expediente['Expediente']['fecha_terminacion']; ?></td>
<?php
/*				$actions = array();
				$actions[] = $this->Croogo->adminRowAction(
					'',
					array('controller' => 'links', 'action' => 'index',	'?' => array('menu_id' => $menu['Expediente']['id'])),
					array('icon' => 'zoom-in', 'tooltip' => __d('croogo', 'View links'))
				);
				$actions[] = $this->Croogo->adminRowActions($menu['Menu']['id']);
				$actions[] = $this->Croogo->adminRowAction(
					'',
					array('controller' => 'menus', 'action' => 'edit', $menu['Menu']['id']),
					array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
				);
				$actions[] = $this->Croogo->adminRowAction(
					'',
					array('controller' => 'menus', 'action' => 'delete', $menu['Menu']['id']),
					array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
					__d('croogo', 'Are you sure?')
				);
				$actions = $this->Html->div('item-actions', implode(' ', $actions));
				$rows[] = array(
					$menu['Menu']['id'],
					$this->Html->link($menu['Menu']['title'], array('controller' => 'links',	'?' => array('menu_id' => $menu['Menu']['id']))),
					$menu['Menu']['alias'],
					$menu['Menu']['link_count'],
					$this->Html->div('item-actions', $actions),
				);
			endforeach;

			echo $this->Html->tableCells($rows);
*/
			?>
<td>
<div class="item-actions">
<?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Expedientes','action'=>'view',$expediente['Expediente']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Expedientes','action'=>'edit',$expediente['Expediente']['id']),
				array('title'=>'Editar este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Editar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-print"></i>',
                                array('controller'=>'Expedientes','action'=>'pdf',$expediente['Expediente']['id']),
				array('title'=>'Imprimir este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Imprimir este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
/*
	 echo $this->Form->postLink(_(''),
          array('action' => 'delete',$expediente['Expediente']['id']),
	  array('class'=>'icon-trash icon-large',
		'title'=>'Eliminar este elemento',
	        'data-title'=>"Eliminar este elemento",
	        'rel'=>"tooltip"),
		 __('¿Realmente desea hacer copiar de la orden %s?',$expediente['Expediente']['id'])
         );	
*/
	 ?>
    </div>
   </td>
  </tr>
  <?php $e++; endforeach; ?>
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
<?php
 //echo $this->element('Online.online');
 ?>
