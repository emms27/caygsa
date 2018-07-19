<?php  
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *

	echo $this->Html->script(array(
		'../cloudbits/js/easytabs/jquery.hashchange.min',
		'../cloudbits/js/easytabs/jquery.easytabs.min'
	));
<style>
    .etabs { margin: 0; padding: 0; }
    .tab { display: inline-block; zoom:1; *display:inline; background: #eee; border: solid 1px #999; border-bottom: none; -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; }
    .tab a { font-size: 14px; line-height: 2em; display: block; padding: 0 10px; outline: none; }
    .tab a:hover { text-decoration: underline; }
    .tab.active { background: #fff; padding-top: 6px; position: relative; top: 1px; border-color: #666; }
    .tab a.active { font-weight: bold; }
    .tab-container .panel-container { background: #fff; border: solid #666 1px; padding: 10px; -moz-border-radius: 0 4px 4px 4px; -webkit-border-radius: 0 4px 4px 4px; }
    .panel-container { margin-bottom: 10px; }
  </style>
*/

     $partes= $this->Html->tableHeaders(array('',
		    '<i class="icon-user"></i> Nombre', 
   		    '<i class="icon-envelope-alt"></i> Email', 
  		    '<i class="icon-phone"></i> Teléfono', 
	 	    '<i class="icon-mobile-phone"></i> Movil', 
		    '<i class="icon-phone"></i> Oficina', 
		    'Tipo',
		    'Acci&oacute;n'),
		    array(''));

     $eventos=$this->Html->tableHeaders(array('',
       'Título',
       'Tipo de Evento',
	'<i class="icon-time"></i> Inicio',
	'<i class="icon-time"></i> Fin',
	'All Day',
	'Estado',
	'Status',
	'Acci&oacute;n'),
        array(''));  

     $etapas=$this->Html->tableHeaders(
                array('#', 
                      '<i class="icon-file-alt"></i> Etapa',
                      '<i class="icon-calendar"></i> Acuerdo',
		      '<i class="icon-calendar"></i> Notificación',
		      '<i class="icon-calendar"></i> Registro',
		      '<i class="icon-calendar"></i> Terminación',
		      'Acci&oacute;n'),
	              array('')); 

     $pagos= $this->Html->tableHeaders(array('',
        '<i class=""></i> ID',
	'<i class="icon-money"></i> Monto', 
	'<i class="icon-time"></i> Fecha Registro', 
	'<i class="icon-time"></i> Última Actualización', 
	'<i class=""></i> Status', 'Acci&oacute;n'),
		    array('')); 
?>
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
         echo $this->Html->link('Vista', 
                                array('controller'=>'Expedientes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>


<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="96%"><h1>Consulta Detalle Expediente</h1></td>
 </tr>
 <tr>
  <td colspan="2" class="arial11gris" align="left">
   La consulta de dellate expediente te muestran el saldo que cuenta el expediente y el estado que guarda cada proceso.
  </td>
 </tr>
</table><br>

<table border="0" class="estado">
 <tr>
  <td>
   <table border="0" width="100%">
    <tr>
     <td width="87%"><span align="left" class="arial14cafe2">ESTADO DEL EXPEDIENTE</span></td>
     <td width="13%">

 <div class="btn-group">
    <?php
         echo $this->Html->link('<i class="icon-edit"></i>',
				array('action' => 'add'),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Html->link('<i class="icon-pencil"></i>',
				array('action' => 'edit', $expediente['Expediente']['id']),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Html->link('<i class="icon-print"></i>',
				array('action' => 'pdf',$expediente['Expediente']['id']),
		                array('escape' => false,"class"=>"btn"));

     ?>
<!--
  <div class="btn-group">
   <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    <i class="icon-download-alt"> </i>
    <span class="icon-caret-down"></span>
   </a>
   <ul class="dropdown-menu">
    <li>
     <?php
         echo $this->Html->link('<i class="icon-download-alt"></i> Excel',
				array('action' => 'pdf',$expediente['Expediente']['id']),
		                array('escape' => false));
     ?>
    </li>
    <li>
     <?php
         echo $this->Html->link('<i class="icon-download-alt"></i> Texto Plano',
				array('action' => 'expediente_pdf',$expediente['Expediente']['id']),
		                array('escape' => false));
     ?>
    </li>
   </ul>
  </div>
-->
 </div>

     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td><br>
   <table border="0" >
    <tr>
     <td width="50%">
     <table border="0" cellspacing="7">
       <tr>    
        <td width="15%" class="arial10gris"><div align="right">Exp:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['expediente']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Juzgado:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Juzgado']['organo_judicial']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Materia:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Materia']['descripcion']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Tipo de Crédito:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['TipoCredito']['tipo']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Núm. Crédito:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['num_credito']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Fecha de Registro:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['fecha_registro']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Fecha de Terminación:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['fecha_terminacion']; ?></td>
       </tr>
      </table>
     </td>
     <td width="50%" valign="top">
      <table border="0" cellspacing="7">
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Cliente:</div></td>
        <td width="35%" class="arial12magenta">
        <?php        echo $this->Html->link($expediente['Cliente']['namefull'],
                                array('controller'=>'Clientes','action'=>'view',$expediente['Cliente']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         )); ?>
        </td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">CIS:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['cis']; ?></td>
       </tr>
       <tr>    
        <td width="15%" class="arial10gris"><div align="right">Gravamen:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['tipo_gravamen']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Tipo de Juicio:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $tipojuicio; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Cuantia del Juicio:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $this->Number->currency($expediente['Expediente']['cuantia_juicio'], '$'); ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Garantía:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $expediente['Expediente']['garantia']; ?></td>
       </tr>
       <tr>
        <td width="15%" class="arial10gris"><div align="right">Valor de la Garantía:</div></td>
        <td width="35%" class="arial12magenta"><?php echo $this->Number->currency($expediente['Expediente']['valor_garantia'], '$'); ?></td>
       </tr>
      </table>
     </td>
    </tr>
   </table><br><br>
<center>
 <div style="width:90%;">
  <?php

      echo $this->Form->textarea('Expediente.notas',
	                       array('rows' => '5', 
	 		   	     'class'=>'ckeditor',
		                     'cols' => '5',
				     'default'=>$comentarios
		              ));
  
   ?>
 </div>
</center><br><br><br>

<div class="row-fluid">
 <div class="span8" style="width:100%;">
	<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Etapas'), '#menu-basic');
			echo $this->Croogo->adminTab(__d('croogo', 'Eventos'), '#menu-demandado');
			echo $this->Croogo->adminTab(__d('croogo', 'Pagos'), '#menu-note');
			echo $this->Croogo->adminTab(__d('croogo', 'Partes'), '#menu-x');
			echo $this->Croogo->adminTabs();
		?>
	</ul>
  <div class="tab-content">
   <div id="menu-basic" class="tab-pane"><br>
 <h2>Etapas</h2>
   <table border="0" class="testgrid" >
     <?php
       echo $etapas; 
       $p=1; foreach ($stage as $stage): 
     ?>
     <tr>
      <td><?php echo $p; ?></td>
      <td><?php echo $stage['Etapa']['etapa']; ?></td>
      <td><?php echo $stage['Stage']['fecha_acuerdo']; ?></td>
      <td><?php echo $stage['Stage']['fecha_notificacion']; ?></td>
      <td><?php echo $stage['Stage']['fecha_registro']; ?></td>
      <td><?php echo $stage['Stage']['fecha_terminacion']; ?></td>
      <td>
<div class="item-actions">
<?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Stages','action'=>'view',$stage['Stage']['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Stages','action'=>'edit',$stage['Stage']['id']),
				array('title'=>'Editar este elemento',
				      'escape' => false,
				      'class'=>'edit',
				      'data-title'=>'Editar este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));
/*
	 echo $this->Form->postLink(_(''),
          array('action' => 'delete',$stage['Stage']['id']),
	  array('class'=>'icon-trash icon-large',
		'title'=>'Eliminar este elemento',
	        'data-title'=>"Eliminar este elemento",
	        'rel'=>"tooltip"),
		 __('¿Realmente desea hacer copiar de la orden %s?',$stage['Stage']['id'])
         );*/		 
      ?>
    </div>
      </td>
     </tr>
       <?php $p++; endforeach; ?>
      </table>
   </div>
   <div id="menu-demandado" class="tab-pane"><br>
  <h2>Eventos</h2>

    <table border="0" class="testgrid" >
       <?php
	echo $eventos;
        $d=1; foreach ($expediente['Event'] as $ficha):
       ?>
     <tr>
      <td><?php echo $d; ?></td>
      <td><?php echo $ficha['title']; ?></td>
      <td><?php echo $ficha['cbeventtype_id']; ?></td>
      <td><?php echo $ficha['start']; ?></td>
      <td><?php echo $ficha['end']; ?></td>
      <td><?php echo $ficha['all_day']; ?></td>
      <td><?php echo $ficha['status']; ?></td>
      <td><?php echo $ficha['active']; ?></td>
      <td>
       <div class="item-actions">
  <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('plugin'=>'full_calendar','controller'=>'Events','action'=>'view',$ficha['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('plugin'=>'full_calendar','controller'=>'Events','action'=>'edit',$ficha['id']),
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
       <?php $d++; endforeach;  ?>
      </table>
   </div>
   <div id="menu-note" class="tab-pane"><br>
   <h2>Pagos</h2>
<!--  <code>  <pre>.etabs { margin: 0; padding: 0; }   </pre>  </code> -->

  <table border="0" class="testgrid" >
       <?php
	echo $pagos;
        $s=1; foreach ($expediente['Pago'] as $spei):
       ?>
     <tr>
      <td><?php echo $s; ?></td>
      <td><?php echo $spei['id']; ?></td>
      <td><?php echo $this->Number->currency($spei['importe'], '$'); ?></td>
      <td><?php echo $spei['fecha_registro']; ?></td>
      <td><?php echo $spei['fecha_update']; ?></td>
      <td><?php echo $spei['ver']; ?></td>
      <td><center>
        <div class="item-actions">
  <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Pagos','action'=>'view',$spei['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Pagos','action'=>'edit',$spei['id']),
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
       <?php $s++; endforeach;  ?>
      </table>
   </div>
   <div id="menu-x" class="tab-pane"><br>
  <h2>Partes</h2>

<table border=0 class="testgrid">
 <?php
   echo $partes; $o=1;foreach ($expediente['Parte'] as $orden):  ?>
     <tr>
      <td><?php echo $o; ?></td>
      <td><?php echo $orden['namefull']; ?></td>
      <td><?php echo $orden['email']; ?></td>
      <td><?php echo $orden['telefono']; ?></td>
      <td><?php echo $orden['movil']; ?></td>
      <td><?php echo $orden['oficina']; ?></td>
      <td><?php echo $orden['tipo']; ?></td>
      <td>
      <div class="item-actions">
  <?php
         echo $this->Html->link('<i class="icon-search icon-large"></i>',
                                array('controller'=>'Partes','action'=>'view',$orden['id']),
				array('title'=>'Ver este elemento',
				      'escape' => false,
				      'class'=>'view',
				      'data-title'=>'Ver este elemento',
				      'rel'=>"tooltip",
				      'data-placement'=>"top",
				      'data-trigger'=>"hover"
         ));

         echo $this->Html->link('<i class="icon-pencil icon-large"></i>',
                                array('controller'=>'Partes','action'=>'edit',$orden['id']),
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
    <?php $o++; endforeach; ?>	
</table>
   </div>
</div>
</div>
</div>

<!--
<div id="tab-container" class='tab-container' style="width:90%; ">
 <ul class='etabs'>
        <li class='tab'><a href="#tabs1-html">Etapas</a></li>
        <li class='tab'><a href="#tabs1-js">Eventos</a></li>
        <li class='tab'><a href="#tabs1-css">Pagos</a></li>
        <li class='tab'><a href="#tabs1-xs">Partes</a></li>
 </ul>
 <div class='panel-container'>
  <div id="tabs1-html">
  
  </div>
   <div id="tabs1-js">
 
  </div>
  <div id="tabs1-css">

  </div>
  <div id="tabs1-xs">
 
  </div>
 </div>
</div>
-->


  </td>
 </tr>
</table><br><br>
