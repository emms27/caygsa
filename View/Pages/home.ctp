<?php
 $datetoday = $this->Helpers->load('Dates');
 $options=array('Expediente'=>'Expediente','Parte'=>'Parte'); 
 $attributes=array('legend'=>false);
 //$nordenes = $this->requestAction('OrdenPagos/notificacion/limit:20');
 echo $this->Form->create('X',array('action'=>NULL));
?>
<h1 style="float:right;">Bienvenido, <strong><?php echo $this->Session->read('Auth.User.Personal.namefull'); ?></strong>
</h1><br><br>
<h6 style="float:right;"><?php echo $datetoday->fechaActual(); ?></h6>

<table border="0">
 <tr>
  <td width="65%" aling="left">
   <table border="0">
    <tr>
     <td width="4%">
      <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"18px","height"=>"18px","border"=>"0")); ?>
     </td><td width="96%"><h2>Buscar Información:<h2></td>
    </tr>
   </table>
  </td>
  <td width="35%" aling="left">
  </td>
 </tr>
</table>

<table border="0">
 <tr>
  <td width="40%" valign="top">
   <div class="square3_Externo">
    <b class="square3_1"><!--&nbsp;--></b>
    <b class="square3_2"><!--&nbsp;--></b>
    <b class="square3_3"><!--&nbsp;--></b>
    <b class="square3_4"><!--&nbsp;--></b>
    <div class="square3_Interno">                                                                                  
       <div id="radio">
        <input type="radio" id="radio4" name="data[radio]" value="scliente" checked  />
        <label for="radio4">Clientes</label>
        <input type="radio" id="radio1" name="data[radio]" value="sexpediente" />
        <label for="radio1">Expediente</label>
        <input type="radio" id="radio3" name="data[radio]" value="spago" />
	<label for="radio3">Pagos</label>
        <input type="radio" id="radio2" name="data[radio]" value="sparte"  />
	<label for="radio2">Parte</label>
    </div>
    <div class="input-append">
     <?php      
      echo $this->Form->input('buscar', array(
 	                      	'label'=>false,
 			        'div' => false,
			      	'id'=>'buscar',
 		              	'type'=>'search',
		   	      	'placeholder'=>'buscar...',
				'autofocus',
			      	'style'=>'border:1px solid gray;',
                              	'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                              	'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on"

	));
      ?>
      <button class="btn btn-success"><i class="icon-search"></i></button>
    </div> <?php echo $this->Ajax->buttonset('radio'); echo $this->Form->end();  ?> </div>
      <b class="square3_4b"></b>
      <b class="square3_3b"></b>
      <b class="square3_2b"></b>
      <b class="square3_1b"></b>
      </div>
 </td>
  <td width="60%" valign="top">

  </td>
</tr>
</table><br>

 <script>  $(function() {$( "#accordion" ).accordion();});   </script>
<?php
  if (isset($this->data['radio']) && isset($this->data['X']['buscar'])){
   $dradio=$this->data['radio'];   
   $dsearch=$this->data['X']['buscar']; 
   if ($dradio=='scliente'){
                   $modelo="Cliente";
                   $titulo=$modelo.'s';
    		   $ordenes = $this->requestAction($titulo.'/index/'.$dradio.':'.$dsearch);
		   $tableHeaders=$this->Html->tableHeaders(
			       array('#', 
			             'ID',
			             'Nombre',
			             'Teléfono',
			             'Oficina',
			             'Movil',
			             'Email',
			             'RFC',
				     'Acci&oacute;n'
		   )); 
?>
<h2><?php echo $titulo; ?></h2>

   <table id="example-datatables3" class="table table-striped table-bordered table-hover">
    <thead><?php echo $tableHeaders; ?></thead>
    <?php $d=1; foreach ($ordenes as $ficha): ?>
    <tr>
      <td><?php echo $d; ?></td>
      <td><?php echo $ficha[$modelo]['id']; ?></td>
      <td><?php echo $ficha[$modelo]['namefull']; ?></td>
      <td><?php echo $ficha[$modelo]['telefono']; ?></td>
      <td><?php echo $ficha[$modelo]['oficina']; ?></td>
      <td><?php echo $ficha[$modelo]['movil']; ?></td>
      <td><?php echo $ficha[$modelo]['email']; ?></td>
      <td><?php echo $ficha[$modelo]['rfc']; ?></td>
      <td><div class="item-actions">
       <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>$titulo,'action'=>'view',$ficha[$modelo]['id']),
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
    </tr>
    <?php $d++; endforeach; ?>	
</table>
<?php } else if ($dradio=='spago'){ 
                   $modelo="Pago";
                   $titulo=$modelo.'s';
		   $ficha = $this->requestAction($titulo.'/index/'.$dradio.':'.$dsearch);
		   $tableHeaders=$this->Html->tableHeaders(
			       array('#', 
			             'ID',
			             'Expediente',
			             'Monto',
			             'Registro',
			             'Última Actualización',
				     'Acci&oacute;n'
		   )); 
?>
<h2><?php echo $titulo; ?></h2>
   <table id="example-datatables3" class="table table-striped table-bordered table-hover">
    <thead><?php echo $tableHeaders; ?></thead>
    <?php  $d=1; foreach ($ficha as $ficha): 
      $idestado='divestado_'.$ficha[$modelo]['id'];
      $iddeposito='editable'.$d;
    ?>
    <tr>
     <td><?php echo $d; ?></td>
     <td><?php echo $ficha[$modelo]['id'];  ?></td>
     <td>
          <?php 
            echo $this->Html->link($ficha[$modelo]['cbexpediente_id'],    	  	                   
                array('controller'=>'Expedientes','action' => 'view',$ficha[$modelo]['cbexpediente_id']), 
		array('escape' => false)); 
          ?>
     </td>
     <td><?php echo $this->Number->currency($ficha[$modelo]['importe'], '$'); ?></td>
     <td><?php echo $ficha[$modelo]['fecha_registro']; ?></td>
     <td><?php echo $ficha[$modelo]['fecha_update']; ?></td>
      <td><div class="item-actions">
       <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>$titulo,'action'=>'view',$ficha[$modelo]['id']),
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
    </tr>
    <?php $d++; endforeach; ?>
</table>
<?php } else if ($dradio=='sparte'){ 
    		   $parte = $this->requestAction('Partes/index/'.$dradio.':'.$dsearch);
                   $modelo="Parte";
                   $titulo=$modelo.'s';
		   $tableHeaders=$this->Html->tableHeaders(
			       array('#', 
			             'Expediente',
			             'Nombre',
			             'Identificacion',
			             'Tipo',
				     'Acci&oacute;n'
		   )); 
?>
<h2><?php echo $titulo; ?></h2>

   <table id="example-datatables3" class="table table-striped table-bordered table-hover">
    <thead><?php echo $tableHeaders; ?></thead>
    <?php $p=1; foreach ($parte as $involucrado): ?>
    <tr>
   	<td><?php echo $p; ?></td>
        <td>
          <?php 
            echo $this->Html->link($involucrado[$modelo]['cbexpediente_id'],    	  	                   
                           array('controller'=>'Expedientes',
				 'action' => 'view',$involucrado[$modelo]['cbexpediente_id']
                                ), 
				array('escape' => false)); 
          ?>
        </td>
        <td><?php echo $involucrado[$modelo]['namefull']; ?> </td>
	<td><?php echo $involucrado[$modelo]['nidentificacion']; ?></td>
	<td><?php echo $involucrado[$modelo]['tipo']; ?></td>   
      <td><div class="item-actions">
       <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>$titulo,'action'=>'view',$involucrado[$modelo]['id']),
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
    </tr>
    <?php $p++; endforeach; ?>
</table>
<?php } else if ($dradio=='sexpediente'){ 
    		   $expediente = $this->requestAction('Expedientes/index/'.$dradio.':'.$dsearch);
                   $modelo="Expediente";
                   $titulo='Expedientes';
		   $tableHeaders=$this->Html->tableHeaders(
			       array('#', 
			             'Expediente',
			             'Exp. Procedente',
			             'Juzgado',
			             'Materia',
			             'Creación',
				     'Acci&oacute;n'
		            )); 

?>
<h2><?php echo $titulo; ?></h2>
   <table id="example-datatables3" class="table table-striped table-bordered table-hover">
    <thead><?php echo $tableHeaders; ?></thead>
    <?php  $e=1; foreach ($expediente as $expediente): ?>
    <tr>
   	<td><?php echo $e; ?></td>
   	<td><?php echo $expediente['Expediente']['expediente']; ?></td>
        <td><?php echo $expediente['Expediente']['cbexpediente_id'];  ?></td>
        <td><?php echo $expediente['Juzgado']['organo_judicial']; ?></td>
        <td><?php echo $expediente['Materia']['descripcion']; ?></td>
        <td><?php echo $expediente['Expediente']['fecha_update']; ?></td>
      <td><div class="item-actions">
       <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>$titulo,'action'=>'view',$expediente[$modelo]['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-print icon-large"></i>',
                                array('controller'=>$titulo,'action'=>'pdf',$expediente[$modelo]['id']),
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
    </tr>
    <?php $e++; endforeach; ?>
</table>
<?php }} ?>


