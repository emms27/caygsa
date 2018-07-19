<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

  echo $this->Html->css(array('radio'));
  $fdateupdate=explode(' ',$cliente['Parte']['fecha_update']);
  $fdatealta=explode(' ',$cliente['Parte']['fecha_registro']);
  $parteid=$cliente['Parte']['id'];
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Partes', 
                                array('controller'=>'Partes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Vista', 
                                array('controller'=>'Partes','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="96%"><h1>Consulta de Partes</h1></td>
 </tr>
 <tr>
  <td colspan="2" class="arial11gris" align="left">
   La consulta de partes te muestran toda la informacion de la etapa seleccionada.<br><br>
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
     <td width="88%"><span align="left" class="arial14cafe2"></td>
     <td width="12%">


<div class="btn-group">
    <?php
         echo $this->Html->link('<i class="icon-edit"></i>',
				array('action' => 'add'),
		                array('escape' => false,"class"=>"btn"));

         echo $this->Html->link('<i class="icon-pencil"></i>',
				array('action' => 'edit', $cliente['Parte']['id']),
		                array('escape' => false,"class"=>"btn"));
     ?>
</div>


     </td>
    </tr>
   </table>
  </td>
 </tr>
 <tr><td>&nbsp;</td></tr>
 <tr>
  <td>
   <table border="0" class="accionvista">
   <tr>
     <th><span>Expediente:</span></th>
     <td><?php 
         echo $this->Html->link($cbexpediente['Expediente'],
				array('controller'=>'Expedientes',
				      'action' => 'view/'.$cliente['Parte']['cbexpediente_id']),
		                array('escape' => false));
          ?>
     </td>
   </tr>
   <tr>
     <th><span>Juzgado:</span></th>
     <td><?php echo $cbexpediente['Juzgado']; ?></td>
   </tr>
   <tr>
     <th><span>Tipo:</span></th>
     <td><?php echo h($cliente['Parte']['tipo']);  ?></td>
   </tr>
   <tr>
     <th><span>Nombre:</span></th>
     <td><?php echo h($cliente['Parte']['namefull']);  ?></td>
    </tr>
    <tr>
     <th><span>Edad:</span></th>
     <td><?php echo h($cliente['Parte']['edad']);  ?></td>
    </tr>
    <tr>
     <th><span>Genero:</span></th>
     <td><?php if ($cliente['Parte']['sexo']=='M') echo "Masculino"; else echo "Femenino";  ?></td>
    </tr>
     <th><span>Domicilio:</span></th>
     <td><?php echo h($cliente['Parte']['domicilio']);  ?></td>
    </tr>
    <tr>
     <th><span>Email:</span></th>
     <td><?php echo h($cliente['Parte']['email']);  ?></td>
    </tr>	
    <tr>
     <th><span>Teléfono:</span></th>
     <td><?php echo h($cliente['Parte']['telefono']);  ?></td>
    </tr>
    <tr>
     <th><span>Oficina:</span></th>
     <td><?php echo h($cliente['Parte']['oficina']);  ?></td>
    </tr>
    <tr>
     <th><span>Movil:</span></th>
     <td><?php echo h($cliente['Parte']['movil']);  ?></td>
    </tr>
    <tr>
     <th><span>Identificación:</span></th>
     <td><?php echo h($cliente['Parte']['tidentificacion']);  ?></td>
    </tr>
    <tr>
     <th><span>Núm. Identificación:</span></th>
     <td><?php echo h($cliente['Parte']['nidentificacion']);  ?></td>
    </tr>
    <tr>
     <th><span>Fecha de Regitro:</span></th>
     <td><?php  echo $this->Dates->FormatoCompletoFecha($fdatealta[0]).'&nbsp;&nbsp;'.$fdatealta[1]; ?></td>
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
