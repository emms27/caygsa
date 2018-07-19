<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

    $tableHeaders = $this->Html->tableHeaders(array('',
		    $this->Paginator->sort('Escolaridade.escolaridad', 'Escolaridad'),
   		    $this->Paginator->sort('Escolaridade.fecha_registro', 'Fecha Registro'),
  		    $this->Paginator->sort('Escolaridade.fecha_update', 'Última Actualización'),
  		    $this->Paginator->sort('Escolaridade.ver', 'Status'),
		    'Acci&oacute;n'),
		    array('class'=>'encabezado')
                   ); 
?>
<div id="breadcrumb">
        <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Catálogos',  '/Escolaridades'); 
              $this->Html->addCrumb('Escolaridad',  '/Escolaridades'); 
              $this->Html->addCrumb('Consulta' ,  '/Escolaridades' , array('class' => 'breadcrumblast')); 
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
         echo $this->Html->link('New Escolaridad', 
                                array('controller'=>'Escolaridades','action'=>'add'),
				array('title'=>'Inicio','escape' => false,"class"=>"btn btn-success"));
        ?>
    </li>
   </ul>
  </div>
 </div>

<div class="blocks filter row-fluid">
<form action="/croogo-1.5.1/admin/blocks" class="form-inline" novalidate="novalidate" id="BlockAdminIndexForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/><input type="hidden" name="data[_Token][key]" value="586c5c10406c328e729bb72a9b1ee5b373511850" id="Token1316321049"/></div><input type="hidden" name="data[Block][chooser]" id="BlockChooser"/><div class="input select"><label for="BlockRegionId">Region</label><select name="data[Block][region_id]" id="BlockRegionId">
<option value=""></option>
<option value="3">none</option>
<option value="4">right</option>
<option value="6">left</option>
<option value="7">header</option>
<option value="8">footer</option>
<option value="9">region1</option>
<option value="10">region2</option>
<option value="11">region3</option>
<option value="12">region4</option>
<option value="13">region5</option>
<option value="14">region6</option>
<option value="15">region7</option>
<option value="16">region8</option>
<option value="17">region9</option>
</select></div><div class="input text required"><label for="BlockTitle">Cliente</label>
<?php  

      echo $this->Form->input('sparte', array('label'=>'',
	 			              'type'=>'search',
  			   		      'id'=>'sdeposito',
					      'maxlength'=>"100",
					      'placeholder'=>'Busca un cliente',
					      'style'=>'border:1px solid gray;',
		                                    'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                                                    'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on" 
            )); 
          ?>
</div>
<div class="input submit"><input  class="btn" type="submit" value="Filter"/></div><div style="display:none;"><input type="hidden" name="data[_Token][fields]" value="da49e80f94a645efd684386ec60ccea700ace91a%3ABlock.chooser" id="TokenFields186310057"/><input type="hidden" name="data[_Token][unlocked]" value="region_id%7Ctitle" id="TokenUnlocked499122678"/>
</div></form></div>
 <form action="/croogo-1.5.1/admin/blocks/blocks/process" id="BlockAdminIndexForm" method="post" accept-charset="utf-8">

<br>
 <div class="row-fluid">
  <div class="span12">
   <table class="table table-striped">
    <thead><?php echo $tableHeaders; ?></thead>
    <?php $p=1; foreach ($escolaridades as $cliente):  ?>
    <tr>
     <td><?php echo $p; ?></td>
     <td><?php echo $cliente['Escolaridade']['escolaridad']; ?> </td>
     <td><?php echo $cliente['Escolaridade']['fecha_registro']; ?></td>
     <td><?php echo $cliente['Escolaridade']['fecha_update']; ?></td>
     <td>
      <?php
       if ($cliente['Escolaridade']['ver']==0) $sclass="icon-remove red ajax-toggle";
       else $sclass="icon-ok green ajax-toggle";

         echo $this->Html->link('<i class="'.$sclass.'"></i>',
                                array('controller'=>'Escolaridades','action'=>'status',$cliente['Escolaridade']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
/*
	 echo $this->Form->postLink(_(''),
		array('controller'=>'Escolaridades','action'=>'status',$cliente['Escolaridade']['id']),
                //array('action' => 'status',$cliente['Escolaridade']['id']),
		array('class'=>$sclass,'title'=>'Cancelar'), __('¿Realmente desea modificar el status %s?',$cliente['Escolaridade']['id'])
         );	
*/

	?>
     </td>
     <td>
      <div class="item-actions">
  <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Clientes','action'=>'edit',$cliente['Escolaridade']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Clientes','action'=>'edit',$cliente['Escolaridade']['id']),
				array('title'=>'Editar este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Editar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

	 echo $this->Form->postLink(_(''),
          array('action' => 'delete',$cliente['Escolaridade']['id']),
	  array('class'=>'icon-trash icon-large',
		'title'=>'Eliminar este elemento',
	        'data-title'=>"Eliminar este elemento",
	        'rel'=>"tooltip"),
		 __('¿Realmente desea hacer copiar de la orden %s?',$cliente['Escolaridade']['id'])
         );		 ?>
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
