<?php 
		echo $this->Html->script(array(
//			'/croogo/js/html5',
			//'/croogo/js/jquery/jquery.min',
			//'/croogo/js/jquery/jquery-ui.min',
			'JqueryUI/js/jquery-1.9.1',
			'JqueryUI/js/jquery-ui-1.10.3.custom',

//			'JqueryUI/js/jquery-ui-1.10.3.custom',
                        'ckeditor/ckeditor'
		));


                echo $this->Html->scriptBlock('var webroot="'.$this->webroot.'";');
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
 $this->layout = 'ajax';
 $datetoday = $this->Helpers->load('Dates');
?>
      <?php echo $this->Form->input('search', array('label'=>'',
						    'placeholder'=>'Busca un expediente',
		 			            'type'=>'search',
		                                    'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                                                    'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on"
						     
            )); 
       ?>

<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Dashboard', 
                                array('controller'=>'pages','action'=>'dashboard'),
				array('title'=>'dashboard','escape' => false));
       ?>
</div><br><br>

<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="55%"><h1>Dashboard<h1></td>
 </tr>
</table>



<h6 style="float:right;"><?php echo $datetoday->fechaActual(); ?></h6>
<table border="0" class="dashboard">
 <tr><th>Acerca de...</th></tr>
 <tr>
  <td>
    <p>Autor:&nbsp;&nbsp;&nbsp;&nbsp;<span>L.I. Emmanuel Sánchez Carreón</span></p>
    <p>Email:&nbsp;&nbsp;&nbsp;<span>esanchez@htsjpuebla.gob.mx | carreon.emmanuel@gmail.com</span></p>
    <p>Creado:&nbsp;<span>Febrero de 2013</span></p>
    <p>Licencia:<span>Copyright © 2013 Honorable Tribunal Superior de Justicia del Estado de Puebla</span></p><br><br>
  </td>
 </tr>
 <tr><th>Contenido</th></tr>
 <tr>
  <td>
   <table border="0">
    <tr>
     <td width="25%" align="center">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/add_expediente.jpg", 
				   array("width"=>"26px","height"=>"32px","border"=>"0")),
                                   array('controller'=>'Expedientes','action'=>'index'),
				   array('title'=>'Expedientes','escape' => false));
          ?><br>
Expedientes</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/icon_partes.gif", 
				   array("width"=>"32px","height"=>"33px","border"=>"0")),
                                   array('controller'=>'Involucrados','action'=>'index'),
				   array('title'=>'Partes Involucradas','escape' => false));
          ?><br>Partes</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/add_ficha.jpg", 
				   array("width"=>"39px","height"=>"25px","border"=>"0")),
                                   array('controller'=>'Depositos','action'=>'index'),
				   array('title'=>'Fichas o Depósitos','escape' => false));
          ?><br>Fichas</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/icon_add.png", 
				   array("width"=>"35px","height"=>"35px","border"=>"0")),
                                   array('controller'=>'OrdenPagos','action'=>'index'),
				   array('title'=>'Orden de Pagos','escape' => false));
          ?><br>Orden de Pagos</td>
    </tr>
    <tr>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/add_money.png", 
				   array("width"=>"32px","height"=>"32px","border"=>"0")),
                                   array('controller'=>'OrdenPagos','action'=>'index'),
				   array('title'=>'Pagos','escape' => false));
          ?><br>Pagos</td>
    </tr>
   </table><br><br>
  </td>
 </tr>
 <tr><th>Personas</th></tr>
 <tr>
  <td>
   <table border="0">
    <tr>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/icon_users.gif", 
				   array("width"=>"26px","height"=>"32px","border"=>"0")),
                                   array('controller'=>'Users','action'=>'index'),
				   array('title'=>'Permisos de Usuarios','escape' => false));
          ?><br>Usuarios</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/icon_permisos.png", 
				   array("width"=>"28px","height"=>"28px","border"=>"0")),
                                   array('controller'=>'Users','action'=>'index'),
				   array('title'=>'Permisos de Usuarios','escape' => false));
          ?><br>Permisos</td>
     <td width="25%"></td>
     <td width="25%"></td>
    </tr>
   </table><br><br>
  </td>
 </tr>
 <tr><th>Herramientas</th></tr>
 <tr>
  <td>
   <table border="0">
    <tr>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/icon_notificacion.png", 
				   array("width"=>"28px","height"=>"28px","border"=>"0")),
                                   array('controller'=>'OrdenPagos','action'=>'notificacion'),
				   array('title'=>'Notificaciones','escape' => false));
          ?><br>Notificaciones</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/message.png", 
				   array("width"=>"32px","height"=>"32px","border"=>"0")),
                                   array('controller'=>'Contactenos','action'=>'notificacion'),
				   array('title'=>'Mensajes','escape' => false));
          ?><br>Mensajes</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/oclock.png", 
				   array("width"=>"28px","height"=>"28px","border"=>"0")),
                                   array('controller'=>'Logs','action'=>'index'),
				   array('title'=>'Actividad del Sistema','escape' => false));
          ?><br>Actividades</td>
     <td width="25%">
      <?php 
 	echo $this->Html->link(
                $this->Html->image("icons/icon_help.png", 
				   array("width"=>"28px","height"=>"28px","border"=>"0")),
                                   '/pages/help',
				   array('title'=>'Ayuda','escape' => false));
          ?><br>Ayuda</td>
     <td width="25%"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
      <?php 
			echo $this->Html->script(array('/cloudbits/js/script'));
          ?>
