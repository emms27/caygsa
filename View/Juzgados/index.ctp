<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

   $options = array(
    'label' => 'Buscar',
    'class'=>'btn',
    'div' => array('class' => 'input submit'));

    $tableHeaders = $this->Html->tableHeaders(array('',
		    $this->Paginator->sort('Juzgado.ocupacion', '<i class="icon-legal"></i> Organo Judicial', array('escape' => false)),
		    $this->Paginator->sort('Juzgado.globalmateria', '<i class="icon-file-alt"></i> Materia', array('escape' => false)),
		    $this->Paginator->sort('Juzgado.globalmunicipio', '<i class="icon-tasks"></i> Municipio', array('escape' => false)),
   		    $this->Paginator->sort('Juzgado.fecha_registro', '<i class="icon-time"></i>  Fecha Registro', array('escape' => false)),
  		    $this->Paginator->sort('Juzgado.fecha_update', '<i class="icon-time"></i>  Última Actualización', array('escape' => false)),
  		    $this->Paginator->sort('Juzgado.ver', 'Status', array('escape' => false)),
		    'Acci&oacute;n'),
		    array('class'=>'encabezado')
                   ); 
?>
<div id="breadcrumb">
        <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Catálogos',  '/Juzgados'); 
              $this->Html->addCrumb('Juzgados',  '/Juzgados'); 
              $this->Html->addCrumb('Consulta' ,  '/Juzgados' , array('class' => 'breadcrumblast')); 
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
         echo $this->Html->link('New Juzgado', 
                                array('controller'=>'Juzgados','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>


<div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Juzgado',array('action'=>'index','class'=>'form-inline'));  ?>
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
                                array('controller'=>'Juzgados','action'=>'index'),
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
    <?php $p=1; foreach ($juzgados as $cliente):  ?>
    <tr>
     <td><?php echo $p; ?></td>
     <td><?php echo $cliente['Juzgado']['organo_judicial']; ?> </td>
     <td><?php echo $cliente['Materia']['descripcion']; ?> </td>
     <td><?php echo $cliente['Municipio']['municipio']; ?> </td>
     <td><?php echo $cliente['Juzgado']['fecha_registro']; ?></td>
     <td><?php echo $cliente['Juzgado']['fecha_update']; ?></td>
     <td>
      <?php
       if ($cliente['Juzgado']['ver']==0) $sclass="icon-remove red ajax-toggle";
       else $sclass="icon-ok green ajax-toggle";

         echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Juzgados','action'=>'status',$cliente['Juzgado']['id']),
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
         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Juzgados','action'=>'edit',$cliente['Juzgado']['id']),
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
