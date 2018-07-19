<?php
 echo $this->Form->create(NULL,array('action'=>NULL));
?>
<script>$(function(){$("#tabs").tabs();}); </script>
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
         echo $this->Html->link('Cuenta', 
                                array('controller'=>'Expedientes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="28%"><h1>Reporte por Cuenta</h1></td>
  <td width="68%">
   <?php echo $this->Form->create('Expediente',array('action'=>'consulta_cuenta')); ?>
   <table border="0">
    <tr valign="bottom">
     <td>de:</td>
     <td >
      <?php 
          echo $this->Form->input('from',array( 'label'=>'Rango de fechas:',
						'id' => 'from',
						'size' => '10',
					       	'type' => 'text',
					        'placeholder'=>'Inicio',
					        'style'=>'border:1px solid gray;',
						'readonly'=>'readonly'
          ));

      ?>
     </td> 
     <td>a:</td>
     <td>
      <?php 
          echo $this->Form->input('to',array( 'label'=>'&nbsp;',
					      'id' => 'to',
   					      'size'=>'10',
					      'type' => 'text',
					      'readonly'=>'readonly'
          ));
      ?>
     </td> 
     <td>
     <?php
      echo $this->Form->input('htsjpcuenta_id', 
                                  array('type'=>'select',
                                        'label'=> 'Cuentas'
                                       )
                            );
     ?>
     </td>
      <td><?php echo $this->Form->end('Buscar'); ?></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td colspan="3" class="arial11gris" align="left" style="padding-top:10px; padding-bottom:17px;">
   El reporte de <i>Cuentas</i> es una consulta según la cuenta y el rango de fechas (Fichas- fecha de deposito, Pagos - fecha de registro) dadas por el usuario; para mostrar una línea temporal de todos los movimientos en el Sistema .
  </td>
 </tr>
</table>
<?php 
   if ((isset($this->data['Expediente']['from'])) && 
        (isset($this->data['Expediente']['to'])) && 
        (isset($this->data['Expediente']['htsjpcuenta_id']))){
?>


<table border="0" class="estado">
 <tr>
  <td>
   <table border="0" width="100%">
    <tr>
     <td width="95%"><span align="left" class="arial14cafe2">ESTADO DE CUENTA</span></td>
     <td width="5%">
      <ul class="actions-tools">
       <li>
        <?php
         echo $this->Html->link(__('Imprimir'),
				array('controller' => 'Expedientes',
		       'action' => 'reporte_cuenta',1,'?' => array('fecini' => $this->data['Expediente']['from'],
								   'fecfin' => $this->data['Expediente']['to'],
								   'c' => $this->data['Expediente']['htsjpcuenta_id']
				)),
				array('class'=>'pdf',
				      'target'=>'_blank',
				      'title'=>'Reporte por Cuenta',
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
	<p><strong>Resúmen de Cuenta:</strong></p>
	<table cellspacing="7">
	 <tr><td width="25%" align="right">Cheque:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Cheque'], '$'); ?> </td>
         </tr>
	 <tr><td width="25%" align="right">Dap:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Dap'], '$'); ?> </td>
         </tr>
	 <tr><td width="25%" align="right">Plastico:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Plastico'], '$'); ?> </td>
         </tr>
         </tr>
	 <tr><td width="25%" align="right">Traspaso:</td>
             <td><?php echo $this->Number->currency($saldo['SaldoNuevo']['Traspaso'], '$'); ?> </td>
         </tr>
	 <tr><td width="25%" align="right"><strong>TOTAL:</strong></td>
             <td><strong><?php echo $this->Number->currency($saldo['SaldoNuevo']['Pagado'], '$'); ?></strong></td>
         </tr>
	</table>
     </td>
     <td width="40%">
      <table border="0" cellspacing="7">
       <tr>    
        <td width="8%" class="arial10gris"><div align="right">Cuenta:</div></td>
        <td width="27%" class="arial12magenta"><?php echo $this->data['Expediente']['htsjpcuenta_id']; ?></td>
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
        <td><?php echo $this->Number->currency($ficha['Ficha']['importe'], '$'); ?></td>
        <td><center>
         <ul class="actions-tools">
          <li>
       <?php
	
	echo $this->Html->link(__('Ver'), 
	  	array('controller'=>'Depositos','action' => 'view', $ficha['Ficha']['id']), 
		array('class'=>'view','title'=>'Ver más')
               );

       ?></li>
          </ul></center>
        </td>
       </tr>
       <?php $d++; endforeach;  ?>
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
                        array('controller'=>'OrdenPagos','action' => 'view',$orden['OrdenPago']['id']), 
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
                        array('controller'=>'OrdenPagos','action' => 'view',$orden['OrdenPago']['id']), 
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
                        array('controller'=>'OrdenPagos','action' => 'view',$orden['OrdenPago']['id']), 
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
