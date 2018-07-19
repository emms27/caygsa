<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

    $tableHeaders = $this->Html->tableHeaders(array('',
        $this->Paginator->sort('Pago.id', '<i class=""></i> ID', array('escape' => false)),
        $this->Paginator->sort('Pago.cbexpediente_id', '<i class="icon-file-alt"></i> Expediente', array('escape' => false)),
	$this->Paginator->sort('Pago.importe', '<i class="icon-money"></i> Monto', array('escape' => false)),
	$this->Paginator->sort('Pago.fecha_registro', '<i class="icon-time"></i> Fecha Registro', array('escape' => false)),
	$this->Paginator->sort('Pago.fecha_update', '<i class="icon-time"></i> Última Actualización', array('escape' => false)),
	$this->Paginator->sort('Pago.ver', '<i class=""></i> Status', array('escape' => false)),
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
              $this->Html->addCrumb('Pagos',  '/Pagos'); 
              $this->Html->addCrumb('Consulta' ,  '/Pagos' , array('class' => 'breadcrumblast')); 
//              echo $this->Html->getCrumbs('  > ', 'Home');

       ?>
</div><br>

 <div class="arial11gris" align="left">
  La consulta de pagos te muestran una línea temporal de todas los pagos dadas de alta en el Sistema desde el principio de los tiempos.<br><br>
 </div>


 <div class="row-fluid">
  <div class="span12 actions">
   <ul class="nav-buttons">
    <li>
        <?php
         echo $this->Html->link('New Pago', 
                                array('controller'=>'Pagos','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>



 <div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php echo $this->Form->create('Pago',array('action'=>'index','class'=>'form-inline'));  ?>
    <div class="input-append">
         <?php      
     echo $this->Form->input('spago', array(
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
                                array('controller'=>'Pagos','action'=>'index'),
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
    <?php $p=1; foreach ($pago as $cliente):  ?>
    <tr>
     <td><?php echo $p; ?></td>
     <td><?php echo $cliente['Pago']['id']; ?> </td>
     <td>
      <?php 
         echo $this->Html->link($cliente['Expediente']['expediente'],
				array('controller'=>'Expedientes',
				      'action' => 'view/'.$cliente['Pago']['cbexpediente_id']),
		                array('escape' => false));
      ?>
     </td>
     <td><?php echo $cliente['Pago']['importe']; ?></td>
     <td><?php echo $cliente['Pago']['fecha_registro']; ?></td>
     <td><?php echo $cliente['Pago']['fecha_update']; ?></td>
     <td><?php 
       if ($cliente['Pago']['ver']==0) $sclass="icon-remove red ajax-toggle"; else $sclass="icon-ok green ajax-toggle";
       echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Pagos','action'=>'status',$cliente['Pago']['id']),
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
      <div class="item-actions">
  <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Pagos','action'=>'view',$cliente['Pago']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Pagos','action'=>'edit',$cliente['Pago']['id']),
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
    <?php $p++; endforeach; ?>
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
