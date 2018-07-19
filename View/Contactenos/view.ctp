<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
  $fdateupdate=explode(' ',$involucrado['Contacteno']['fecha_update']);
  $fdatealta=explode(' ',$involucrado['Contacteno']['fecha_registro']);
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Contactenos', 
                                array('controller'=>'Contactenos','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Vista', 
                                array('controller'=>'Contactenos','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="96%"><h1>Consulta Mensaje</h1></td>
 </tr>
 <tr>
  <td colspan="2" class="arial11gris" align="left">
   La consulta de mensajes te muestran el detalle del mensaje seleccionado.<br><br>
  </td>
 </tr>
 <tr>
  <td colspan="2">

  </td>
 </tr>
</table>


<!--  Informacion General -->       
<table border="0" class="estado">
 <tr>
  <td>
   <table border="0" width="100%">
    <tr>
     <td width="88%"><span align="left" class="arial14cafe2">MENSAJE</td>
     <td width="12%">
      <ul class="actions-tools">
       <li>
       <?php /*
	echo $this->Html->link(__('Imprimir'), 
	  	array('action' => 'inscripcion_pdf',$involucrado['Contacteno']['id']),
		array('class'=>'pdf','title'=>'Imprimir')
               );
*/
       ?>
        </li></ul>
     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr><td><hr color="#CC9933"></td></tr>
 <tr>
  <td><br><br><br>
  </td>
 </tr>
 <tr>
  <td>
   <table border="0" class="accionvista">
    <tr>
     <th><span>Nombre:</span></th>
     <td><?php echo h($personal['Personal']['namefull']);  ?></td>
    </tr>
    <tr>
     <th><span>Email:</span></th>
     <td><?php echo h($personal['Personal']['email']);  ?></td>
    </tr>
    <tr>
    <tr>
     <th><span>Estado:</span></th>
     <td><?php echo h($involucrado['Contacteno']['estado']);  ?></td>
    </tr>
    <tr>
     <th><span>Asunto:</span></th>
     <td><?php echo h($involucrado['Contacteno']['asunto']);  ?></td>
    </tr>
    <tr>
     <th><span>Mensaje:</span></th>
     <td><?php echo h($involucrado['Contacteno']['mensaje']);  ?></td>
    </tr>
     <th><span>Fecha de Envio:</span></th>
     <td>  <?php  echo $this->Dates->FormatoCompletoFecha($fdatealta[0]).'&nbsp;&nbsp;'.$fdatealta[1]; ?></td>
    </tr>
   </table> <br><br>
  </td>
 </tr>
</table><!-- FIN Informacion General -->   
<p align="center" class="arial11grisclaro" >
 <em><strong>Última Actualización:</strong>
  <?php  echo $this->Dates->FormatoCompletoFecha($fdateupdate[0]).'&nbsp;&nbsp;'.$fdateupdate[1]; ?>
 </em>
</p>
