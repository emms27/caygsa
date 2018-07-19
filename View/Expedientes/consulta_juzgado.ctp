<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

   $ptipo=array('T'=>'Terminados');  


?>
<div id="breadcrumb">
  <?php
    $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
    $this->Html->addCrumb('Expediente',  '/Expedientes'); 
    $this->Html->addCrumb('Consulta' ,  '/Expedientes' , array('class' => 'breadcrumblast')); 
    //echo $this->Html->getCrumbs('  > ', 'Home');
  ?>
</div><br>

<table border="0">
 <tr>
  <td width="3%">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="97%"><h1>Reporte por Juzgado</h1></td>
 </tr>
</table>

 <div class="row-fluid">
  <div class="span12">
   <div class="blocks filter row-fluid" style="text-align:right;">
    <?php 
      echo $this->Form->create('Expediente',array('action'=>'consulta_juzgado','class'=>'form-inline')); 
      echo $this->Form->input('globaljuzgado_id', 
                                  array('type'=>'select',
                                        'label'=> 'Juzgado',
					'empty' => 'all'
                                       )
                            );

      echo $this->Form->input('status', 
                               array('options' => $ptipo,
 	 			     'label'=>false,
				     'empty' => 'all'
                                  ));

          echo $this->Form->input('from',array( 'label'=>false,
						'id' => 'from',
						'size' => '10',
					       	'type' => 'search',
					        'placeholder'=>'Fecha inicial..',
						'readonly'=>'readonly'
          ));

    ?>
    <div class="input-append">
         <?php      
             echo $this->Form->input('to',array( 'label'=>false,
					      'id' => 'to',
   					      'size'=>'10',
					      'type' => 'search',
					      'placeholder'=>'Fecha final..',
					      'readonly'=>'readonly'
          ));
     ?>
      <button class="btn btn-success"><i class="icon-search"></i></button>
    </div>
    <?php
      echo '<div class="input submit">';
      echo $this->Html->link('<i class="icon-repeat"></i>',
                                array('controller'=>'Expedientes','action'=>'consulta_juzgado'),
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
<?php
  if ((isset($this->data['Expediente']['from'])) && 
      (isset($this->data['Expediente']['to'])) &&
      (isset($this->data['Expediente']['status'])) &&  
      (isset($this->data['Expediente']['globaljuzgado_id']))){

/*
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
*/

  $tableHeaders=$this->Html->tableHeaders(
                array('#', 
                      '<i class="icon-file-alt"></i> Expediente',
                      '<i class="icon-legal"></i> Juzgado',
		      '<i class="icon-task"></i> Asunto',
		      'CIS',
		      'Núm. Crédito',
		      '<i class="icon-time"></i> Registro',
		      '<i class="icon-time"></i> Terminación',
		      'Acci&oacute;n'),
	              array('')); 
?>
<style>
div .barra{
background: -moz-linear-gradient(left,  rgba(188,188,188,0.65) 0%, rgba(188,188,188,0.42) 35%, rgba(0,0,0,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(188,188,188,0.65)), color-stop(35%,rgba(188,188,188,0.42)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  rgba(188,188,188,0.65) 0%,rgba(188,188,188,0.42) 35%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  rgba(188,188,188,0.65) 0%,rgba(188,188,188,0.42) 35%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  rgba(188,188,188,0.65) 0%,rgba(188,188,188,0.42) 35%,rgba(0,0,0,0) 100%); /* IE10+ */
background: linear-gradient(to right,  rgba(188,188,188,0.65) 0%,rgba(188,188,188,0.42) 35%,rgba(0,0,0,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6bcbcbc', endColorstr='#00000000',GradientType=1 ); /* IE6-9 */


}
</style>

<div style="text-align:right;" class="barra">
 <div class="btn-group">
    <?php
         echo $this->Html->link('<i class="icon-download-alt"></i> Excel',
		       array('controller' => 'Expedientes',
		             'action' => 'excel_juzgado',1,'?' => array('fecini' => $this->data['Expediente']['from'],
								   'fecfin' => $this->data['Expediente']['to'],
								   's' => $this->data['Expediente']['status'],
								   'j' => $this->data['Expediente']['globaljuzgado_id']
				)),
		                array('class'=>'btn',
				      'target'=>'_blank',
				      'title'=>'Imprimir',
				      'target'=>'_blank',
				      'escape' => false));    

        ?>
 </div>
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



<?php
  }
?>






<script>$(function(){$("#tabs").tabs();}); </script>

<?php 
  if ((isset($this->data['Expediente']['from'])) && 
        (isset($this->data['Expediente']['to'])) && 
        (isset($this->data['Expediente']['htsjpjuzgado_id']))){
?>
<table border="0" class="estado">
 <tr>
  <td>
   <table border="0" width="100%">
    <tr>
     <td width="95%"><span align="left" class="arial14cafe2">ESTADO POR JUZGADO</span></td>
     <td width="5%">
      <ul class="actions-tools">
       <li>
        <?php
         echo $this->Html->link(__('Imprimir'),
				array('controller' => 'Expedientes',
		       'action' => 'reporte_juzgado',1,'?' => array('fecini' => $this->data['Expediente']['from'],
								   'fecfin' => $this->data['Expediente']['to'],
								   'j' => $this->data['Expediente']['htsjpjuzgado_id']
				)),
				array('class'=>'pdf',
				      'target'=>'_blank',
				      'title'=>'Reporte por Juzgado',
				      'target'=>'_blank',
				      'escape' => false));    

        ?>
       </li>
      </ul>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr><td><hr color="#CC9933"></td></tr>
 <tr>
  <td><br>
   <table border="0" >
    <tr>
     <td width="60%">
	<p><strong>Resúmen de Pagos:</strong></p>
	<table cellspacing="7">
	 <tr><td width="25%" align="right">Cheque:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Cheque'], '$'); ?></td>
         </tr>
	 <tr><td width="25%" align="right">DAP:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Dap'], '$'); ?></td>
         </tr>
	 <tr><td width="25%" align="right">Plastico:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Plastico'], '$'); ?></td>
         </tr>
	 <tr><td width="25%" align="right">Traspaso:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Traspaso'], '$'); ?></td>
         </tr>
	 <tr><td width="25%" align="right">TOTAL:</td>
             <td><strong><?php echo $this->Number->currency($saldo['SaldoNuevo']['Pagado'], '$'); ?></strong></td>
         </tr>
	</table>
     </td>
     <td width="40%">
      <table border="0" cellspacing="7">
       <tr>    
        <td width="8%" class="arial10gris"><div align="right">Juzgado:</div></td>
        <td width="27%" class="arial12magenta"><?php echo $descjuzgado['Juzgado']['descripcion']; ?></td>
       </tr>
       <tr>
        <td width="8%" class="arial10gris"><div align="right">Depósitos:</div></td>
        <td width="27%" class="arial12magenta"><?php echo $this->Number->currency($saldo['SaldoNuevo']['Deposito'], '$'); ?></td>
       </tr>
       <tr>
        <td width="8%" class="arial10gris"><div align="right">Pagos:</div></td>
        <td width="27%" class="arial12magenta"><?php echo $this->Number->currency($saldo['SaldoNuevo']['Pagado'], '$'); ?></td>
       </tr>
      </table>
     </td>
    </tr>
   </table><br><br>	
   <p><strong>Transacciónes:</strong></p>
   <table>
    <tr>
     <td ><!-- TAB -->
      <div id="tabs">
       <ul>
        <li><a href="#tabs-1">Depósitos</a></li>
        <li><a href="#tabs-2">Cheques</a></li>
        <li><a href="#tabs-3">DAPs</a></li>
        <li><a href="#tabs-4">Plasticos</a></li>
        <li><a href="#tabs-5">Traspasos</a></li>
       </ul>
    <div id="tabs-1">
      <table border="0" class="testgrid" >
  	      <?php
	       echo $this->Html->tableHeaders(
                array('#', 
                      'Referencia',
                      'Cuenta',
		      'Depósito',
		      'Status',
		      'Monto',
		      'Acci&oacute;n'),
	              array('')); 
                $d=1; foreach ($saldo['MovimientosSaldo']['Deposito'] as $ficha):
	     ?>
    <tr>
     <td><?php echo $d; ?></td>
     <td><?php echo $ficha['Ficha']['id']; ?></td>
     <td><?php echo $ficha['Ficha']['htsjpcuenta_id']; ?></td>
     <td><?php echo $ficha['Ficha']['fecha_deposito']; ?></td>
     <td><?php echo $ficha['Ficha']['estado']; ?></td>
     <td><?php echo $this->Number->currency($ficha['Ficha']['importe'], '$'); ?> </td>
     <td><center>
      <ul class="actions-tools">
       <li>
       <?php
	echo $this->Html->link(__('Ver'), 
	        array('controller'=>'Depositos','action' => 'view', $ficha['Ficha']['id']), 
		array('class'=>'view','title'=>'Ver más')
               );

       ?> 
       </li>
      </ul></center>
     </td>
    </tr><?php $d++; endforeach;  ?>
    </table>
    </div>
    <div id="tabs-2">
<table border=0 class="testgrid">
 <?php
   echo $this->Html->tableHeaders(
       array('#', 
             'Cheque',
             'Orden',
             'Cuenta',
             'Oficio',
             'Status',
             'Monto',
	     'Acci&oacute;n'
            )
	   ); 
 ?>
 <?php $o=1;foreach ($saldo['MovimientosSaldo']['Cheque'] as $orden):  ?>
     <tr>
      <td><?php echo $o; ?></td>
      <td><?php echo $orden['Cheque']['num_cheque']; ?></td>
      <td><?php 
            echo $this->Html->link($orden['OrdenPago']['id'],    	  	                   
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('escape' => false)); 
          ?>
      </td>
      <td><?php echo $orden['OrdenPago']['htsjpcuenta_id']; ?></td>
      <td><?php echo $orden['OrdenPago']['num_oficio']; ?></td>
      <td><?php echo $orden['Cheque']['estado']; ?></td>
      <td><?php echo $this->Number->currency($orden['OrdenPago']['importe'], '$'); ?> </td>
      <td><center>
       <ul class="actions-tools">
        <li>
         <?php 
	  echo $this->Html->link(__('Ver'), 
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('class'=>'view','title'=>'Ver más')
          );
         ?>
        </li>
       </ul></center>
      </td>
    </tr>
    <?php $o++; endforeach; ?>	
</table>
    </div>
    <div id="tabs-3">
<table border=0 class="testgrid">
 <?php
   echo $this->Html->tableHeaders(
       array('#', 
             'Dap',
             'Orden',
             'Cuenta',
             'Oficio',
             'Status',
             'Monto',
	     'Acci&oacute;n'
            )
	   ); 
 ?>
 <?php $o=1;foreach ($saldo['MovimientosSaldo']['Dap'] as $orden):  ?>
     <tr>
      <td><?php echo $o; ?></td>
      <td><?php echo $orden['Dap']['id']; ?></td>
      <td><?php 
            echo $this->Html->link($orden['OrdenPago']['id'],    	  	                   
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('escape' => false)); 
          ?>
      </td>
      <td><?php echo $orden['OrdenPago']['htsjpcuenta_id']; ?></td>
      <td><?php echo $orden['OrdenPago']['num_oficio']; ?></td>
      <td><?php echo $orden['Dap']['estado']; ?></td>
      <td><?php echo $this->Number->currency($orden['OrdenPago']['importe'], '$'); ?> </td>
      <td><center>
       <ul class="actions-tools">
        <li>
         <?php 
	  echo $this->Html->link(__('Ver'), 
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('class'=>'view','title'=>'Ver más')
          );
         ?>
        </li>
       </ul></center>
      </td>
    </tr>
    <?php $o++; endforeach; ?>	
</table>
    </div>
    <div id="tabs-4">
<table border=0 class="testgrid">
 <?php
   echo $this->Html->tableHeaders(
       array('#', 
             'Plastico',
             'Orden',
             'Cuenta',
             'Oficio',
             'Status',
             'Monto',
	     'Acci&oacute;n'
            )
	   ); 
 ?>
 <?php $o=1;foreach ($saldo['MovimientosSaldo']['Plastico'] as $orden):  ?>
     <tr>
      <td><?php echo $o; ?></td>
      <td><?php echo $orden['Plastico']['num_plastico']; ?></td>
      <td><?php 
            echo $this->Html->link($orden['OrdenPago']['id'],    	  	                   
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('escape' => false)); 
          ?>
      </td>
      <td><?php echo $orden['OrdenPago']['htsjpcuenta_id']; ?></td>
      <td><?php echo $orden['OrdenPago']['num_oficio']; ?></td>
      <td><?php echo $orden['Plastico']['estado']; ?></td>
      <td><?php echo $this->Number->currency($orden['OrdenPago']['importe'], '$'); ?> </td>
      <td><center>
       <ul class="actions-tools">
        <li>
         <?php 
	  echo $this->Html->link(__('Ver'), 
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('class'=>'view','title'=>'Ver más')
          );
         ?>
        </li>
       </ul></center>
      </td>
    </tr>
    <?php $o++; endforeach; ?>	
</table>
    </div>
    <div id="tabs-5">
<table border=0 class="testgrid">
 <?php
   echo $this->Html->tableHeaders(
       array('#', 
             'Traspaso',
             'Orden',
             'Cuenta',
             'Oficio',
             'Status',
             'Monto',
	     'Acci&oacute;n'
            )
	   ); 
 ?>
 <?php $o=1;foreach ($saldo['MovimientosSaldo']['Traspaso'] as $orden):  ?>
     <tr>
      <td><?php echo $o; ?></td>
      <td><?php echo $orden['Traspaso']['folio']; ?></td>
      <td><?php 
            echo $this->Html->link($orden['OrdenPago']['id'],    	  	                   
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('escape' => false)); 
          ?>
      </td>
      <td><?php echo $orden['OrdenPago']['htsjpcuenta_id']; ?></td>
      <td><?php echo $orden['OrdenPago']['num_oficio']; ?></td>
      <td><?php echo $orden['Traspaso']['estado']; ?></td>
      <td><?php echo $this->Number->currency($orden['OrdenPago']['importe'], '$'); ?> </td>
      <td><center>
       <ul class="actions-tools">
        <li>
         <?php 
	  echo $this->Html->link(__('Ver'), 
	        array('controller'=>'OrdenPagos','action' => 'view', $orden['OrdenPago']['id']),  
		array('class'=>'view','title'=>'Ver más')
          );
         ?>
        </li>
       </ul></center>
      </td>
    </tr>
    <?php $o++; endforeach; ?>	
</table>
    </div>
   </div>
   <!-- FIN TAB --> 
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table><br>
<?php } ?>


<script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 2,
      showAnim:"drop",
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage: webroot + "img/icons/icon_calendar.png",
      buttonText: "Abrir calendario",
      //buttonImageOnly: true,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showAnim:"drop",
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage: webroot + "img/icons/icon_calendar.png",
      buttonText: "Abrir calendario",
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
 </script>

