<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

    $tableHeaders = $this->Html->tableHeaders(array('',
        $this->Paginator->sort('Stage.cbstage_id', '<i class="icon-file-alt"></i> Etapa', array('escape' => false)),
        $this->Paginator->sort('Stage.cbexpediente_id', '<i class="icon-file-alt"></i> Expediente', array('escape' => false)),
	$this->Paginator->sort('Stage.fecha_registro', '<i class="icon-time"></i> Registro', array('escape' => false)),
	$this->Paginator->sort('Stage.fecha_acuerdo', '<i class="icon-time"></i> Acuerdo', array('escape' => false)),
	$this->Paginator->sort('Stage.fecha_notificacion', '<i class="icon-time"></i> Notificación', array('escape' => false)),
	$this->Paginator->sort('Stage.fecha_terminacion', '<i class="icon-time"></i> Terminación', array('escape' => false)),
	//$this->Paginator->sort('Stage.status', '<i class=""></i> Status', array('escape' => false)),
	$this->Paginator->sort('Stage.fehcha_update', '<i class="icon-time"></i> Última Actualización', array('escape' => false)),
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
              $this->Html->addCrumb('Etapa',  '/Stages'); 
              $this->Html->addCrumb('Consulta' ,  '/Stages' , array('class' => 'breadcrumblast')); 
//              echo $this->Html->getCrumbs('  > ', 'Home');

         ?>
</div><br>

 <div class="row-fluid">
  <div class="span12 actions">
   <ul class="nav-buttons">
    <li>
        <?php
         echo $this->Html->link('New Etapa', 
                                array('controller'=>'Stages','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>

<div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Stage',array('action'=>'index','class'=>'form-inline'));  ?>
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
                                array('controller'=>'Stages','action'=>'index'),
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
			//foreach ($Etapa  as $menu):
                        foreach ($etapa as $etapa): 
      //$rexp=$etapa['Etapa']['id'];
      //$nexpc1=substr($rexp, 4,-4); 
      //$nexpc2=substr($rexp, 8); 
    ?>
    <tr>
   	<td><?php echo $e; ?></td>
   	<td><?php echo $etapa['Etapa']['etapa']; ?></td>
        <td>
         <?php
          echo $this->Html->link($etapa['Expediente']['expediente'], 
                               array('controller'=>'Expedientes','action'=>'view/'.$etapa['Stage']['cbexpediente_id']),
			       array('title'=>'Inicio','escape' => false));
         ?>
        </td>
        <td><?php echo $etapa['Stage']['fecha_registro']; ?></td>
        <td><?php echo $etapa['Stage']['fecha_acuerdo']; ?></td>
        <td><?php echo $etapa['Stage']['fecha_notificacion']; ?></td>
        <td><?php echo $etapa['Stage']['fecha_terminacion'];  ?></td>
<!--        <td><?php 
       if ($etapa['Stage']['ver']==0) $sclass="icon-remove red ajax-toggle"; else $sclass="icon-ok green ajax-toggle";
       echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Stages','action'=>'status',$etapa['Stage']['id']),
				array('title'=>'Modificar este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Modificar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
          ?>
        </td>
-->
        <td><?php echo $etapa['Stage']['fecha_update']; ?></td>
<?php
/*				$actions = array();
				$actions[] = $this->Croogo->adminRowAction(
					'',
					array('controller' => 'links', 'action' => 'index',	'?' => array('menu_id' => $menu['Etapa']['id'])),
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
                                array('controller'=>'Stages','action'=>'view',$etapa['Stage']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Stages','action'=>'edit',$etapa['Stage']['id']),
				array('title'=>'Editar este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Editar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));		
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
