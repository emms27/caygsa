<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
	echo $this->Html->css(array('jgritter/jquery.gritter'));
	echo $this->Html->script(array('jgritter/jquery.gritter','jgritter/jquery.gritter.min'));

?>
<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Contacto', 
                                array('controller'=>'Contactenos','action'=>'mensaje'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Mensaje', 
                                array('controller'=>'Contactenos','action'=>'mensaje'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>
<h1>Mensaje Contácto</h1><br>
<br><br>
<?php  echo $this->Form->create('Contacteno',array('action'=>'messages')); 
       echo $this->Form->input('id',array('type'=>'hidden'));    
       echo $this->Form->input('ddfmuser2_id',array('type'=>'hidden','value'=>$userid['id']));
?>

<h3>INFORMACIÓN DEL CONTACTO </h3>
<table border="0">
 <tr>
  <td><!--  Informacion del Expediente -->       
   <div class="square3_Externo">
    <b class="square3_1"><!--&nbsp;--></b>
    <b class="square3_2"><!--&nbsp;--></b>
    <b class="square3_3"><!--&nbsp;--></b>
    <b class="square3_4"><!--&nbsp;--></b>
    <div class="square3_Interno">                                                                                  
<table border="0" >
 <tr>
  <td valign="top">
   <table border="0" >
    <tr>
     <td valign="top"><!-- Informacion de la Parte -->                                           
             <?php
                 echo $this->Form->input('ddfmuser_id',
		                                        array('type'=>'select',
		                                              'label'=> 'Para', 
		                                              'empty' => 'Por favor, seleccione...'
                                                              )
                                    );
	      ?>
    </td>
   </tr>
   <tr>
    <td>
        <?php
	 echo $this->Form->input('asunto', 
			    array('label' => 'Asunto',
		            	  'type'=> 'text',
				  'size'=>'50',
				  'maxlength'=>'255',
		                  'placeholder'=>'Escriba el asunto'
		                 )
         );
        ?>
    </td>
   </tr>
  </table>
 </td>
 <td valign="top" style="border-left:2px solid #e2e2e2; padding-left:14px;">
        <?php
	 echo $this->Form->input('mensaje', 
		            array('type'=> 'textarea',
				  'label' => 'Mensaje',
				  'rows'=>"10",
		                  'placeholder'=>'Escriba sus comentarios, sugerencias o peticiones'
		                 )
         );
        ?>
  </td>
 </tr>
 <tr><td colspan="2" align="right"><br><br><?php  echo $this->Form->end('Enviar');  ?></td></tr>
 </table>
  </div>
  <b class="square3_4b"></b>
  <b class="square3_3b"></b>
  <b class="square3_2b"></b>
  <b class="square3_1b"></b>
  </div>      
  </td>
 </tr>
</table>
