<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */
    $tableHeaders = $this->Html->tableHeaders(array('',
		    $this->Paginator->sort('Parte.cbexpediente_id', '<i class="icon-file-alt"></i> Expediente', array('escape' => false)),
		    $this->Paginator->sort('Parte.nombre', '<i class="icon-user"></i> Nombre', array('escape' => false)),
   		    $this->Paginator->sort('Parte.email', '<i class="icon-envelope-alt"></i> Email', array('escape' => false)),
  		    $this->Paginator->sort('Parte.telefono', '<i class="icon-phone"></i> Teléfono', array('escape' => false)),
	 	    $this->Paginator->sort('Parte.movil', '<i class="icon-mobile-phone"></i> Movil', array('escape' => false)),
		    $this->Paginator->sort('Parte.oficina', '<i class="icon-phone"></i> Oficina', array('escape' => false)),
		    $this->Paginator->sort('Parte.tipo', 'Tipo'),
		    'Acci&oacute;n'),
		    array('class'=>'encabezado')
                   ); 

   $ptipo=array('Autor'=>'Autor','Demandado'=>'Demandado');  
   $options = array(
    'label' => 'Buscar',
    'class'=>'btn',
    'div' => array('class' => 'input submit'));
?>
<div id="breadcrumb">
      <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Partes',  '/Partes'); 
              $this->Html->addCrumb('Consulta' ,  '/Partes' , array('class' => 'breadcrumblast')); 
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
         echo $this->Html->link('New Parte', 
                                array('controller'=>'Partes','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>

 <div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Parte',array('action'=>'index','class'=>'form-inline'));  
  echo $this->Form->input('tparte', 
                               array('options' => $ptipo,
 	 			     'label'=>false,
				     'empty' => 'all'
                                  ));
?>
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
                                array('controller'=>'Partes','action'=>'index'),
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
    <?php $p=1; foreach ($parte as $parte):  ?>
    <tr>
     <td><?php echo $p; ?></td>
     <td>
      <?php 
         echo $this->Html->link($parte['Expediente']['expediente'],
				array('controller'=>'Expedientes',
				      'action' => 'view/'.$parte['Parte']['cbexpediente_id']),
		                array('escape' => false));
      ?>
     </td>
     <td><?php echo $parte['Parte']['namefull']; ?> </td>
     <td><?php echo $parte['Parte']['email']; ?></td>
     <td><?php echo $parte['Parte']['telefono']; ?></td>
     <td><?php echo $parte['Parte']['movil']; ?></td>
     <td><?php echo $parte['Parte']['oficina']; ?></td>
     <td><?php echo $parte['Parte']['tipo']; ?></td>
     <td>
      <div class="item-actions">
      <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Partes','action'=>'view',$parte['Parte']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Partes','action'=>'edit',$parte['Parte']['id']),
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
