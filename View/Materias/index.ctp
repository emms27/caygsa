<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

    $tableHeaders = $this->Html->tableHeaders(array('',
		    $this->Paginator->sort('Materia.descripcion', 'Descipción'),
		    $this->Paginator->sort('Materia.asunto', 'Asunto'),
		    $this->Paginator->sort('Materia.juicio', 'Juicio'),
		    $this->Paginator->sort('Materia.juzgado', 'Juzgado'),
   		    $this->Paginator->sort('Materia.fecha_registro', 'Fecha Registro'),
  		    $this->Paginator->sort('Materia.fecha_update', 'Última Actualización'),
  		    $this->Paginator->sort('Materia.ver', 'Status')),
		    array('class'=>'encabezado')
                   ); 

   $ptipo=array('1'=>'Activas','0'=>'Inactivas');  
   $options = array(
    'label' => 'Buscar',
    'class'=>'btn',
    'div' => array('class' => 'input submit'));
?>
<div id="breadcrumb">
        <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Catálogos',  '/Materias'); 
              $this->Html->addCrumb('Materias',  '/Materias'); 
              $this->Html->addCrumb('Consulta' ,  '/Materias' , array('class' => 'breadcrumblast')); 
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
         echo $this->Html->link('New Juicio', 
                                array('controller'=>'Materias','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>



 <div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Materia',array('action'=>'index','class'=>'form-inline'));  ?>
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
                                array('controller'=>'Materias','action'=>'index'),
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
    <?php $p=1; foreach ($materias as $cliente):  ?>
    <tr>
     <td><?php echo $p; ?></td>
     <td><?php echo $cliente['Materia']['descripcion']; ?> </td>
     <td>
      <?php if ($cliente['Materia']['asunto']==0) $sclass="icon-remove red ajax-toggle"; else $sclass="icon-ok green ajax-toggle"; 
       echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Materias','action'=>'asunto',$cliente['Materia']['id']),
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
     <td> 
      <?php if ($cliente['Materia']['juicio']==0) $sclass="icon-remove red ajax-toggle"; else $sclass="icon-ok green ajax-toggle"; 
       echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Materias','action'=>'juicio',$cliente['Materia']['id']),
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
     <td> 
      <?php if ($cliente['Materia']['juzgado']==0) $sclass="icon-remove red ajax-toggle"; else $sclass="icon-ok green ajax-toggle"; 
       echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Materias','action'=>'juzgado',$cliente['Materia']['id']),
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
     <td><?php echo $cliente['Materia']['fecha_registro']; ?></td>
     <td><?php echo $cliente['Materia']['fecha_update']; ?></td>
     <td>
      <?php
       if ($cliente['Materia']['ver']==0) $sclass="icon-remove red ajax-toggle"; else $sclass="icon-ok green ajax-toggle";
       echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Materias','action'=>'status',$cliente['Materia']['id']),
				array('title'=>'Modificar este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Modificar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
/*
	 echo $this->Form->postLink(_(''),
		array('controller'=>'Materias','action'=>'status',$cliente['Materia']['id']),
                //array('action' => 'status',$cliente['Materia']['id']),
		array('class'=>$sclass,'title'=>'Cancelar'), __('¿Realmente desea modificar el status %s?',$cliente['Materia']['id'])
         );	
*/

	?>
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
