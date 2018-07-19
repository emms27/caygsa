<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
 
  echo $this->Html->css(array('radio'));
  $oestado=array('activo'=>'activo','desactivado'=>'desactivado');
  $aestado=array('legend'=>false,
 	         'label'=>false,
                 'id'=>'enable');
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Personal del Poder Judicial', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'User del Poder Judicial','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Editar', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Consulta','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%">
   <?php echo $this->Html->image("icons/icon_editar.jpg",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="28%"><h1>Alta Usuario</h1></td>
  <td width="68%">
  </td>
 </tr>
 <tr>
  <td colspan="3" class="arial11gris" align="left" style="padding-top:10px; padding-bottom:10px;">

  </td>
 </tr>
</table>

<table style="border:1px solid #DDD; width:90%"><tr><td>
<?php
echo $this->Form->create('User', array('action' => 'add'));
echo $this->Form->input('User.id', array('type'=> 'hidden'));
?>
 <table border="0" cellpadding="0" cellspacing="0" class="arial12gris">
                            <tr>
                              <td height="5" colspan="2"></td>
                            </tr>
               
                            <tr>
                              <td width="271" rowspan="18" align="center" valign="middle">
				<?php echo $this->Html->image('uploads/user/filename/user2.jpg',array("width"=>"180px","height"=>"250px","border"=>"0")); ?>
                              <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" bgcolor="#E5E5E5">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                             <td align="left" valign="top">
			     <?php echo $this->Form->input('User.globalemployee_id',
				array('type'=>'text','label'=> 'Matrícula','size'=>'15','maxlength'=>5)); ?>
			     </td>
                            </tr>
                            <tr>
                             <td align="left" valign="top">
			     <?php echo $this->Form->input('User.password',
				array('type'=>'password','label'=> 'Password','size'=>'15')); ?>
			     </td>
                            </tr>    
                            <tr>
                             <td align="left" valign="top">
			   <?php
      echo $this->Form->input('User.role_id', 
                                  array('type'=>'select',
                                        'label'=> 'Role', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
     ?>
			     </td>
                            </tr>      
                            <tr>
                             <td align="left" valign="top">
   
			     </td>
                            </tr>                   
                            <tr>
                              <td align="center" valign="middle">&nbsp;</td>
                              <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" valign="middle" bgcolor="#EEEEEE">&nbsp;</td>
                              <td align="left" valign="top" bgcolor="#EEEEEE">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top">&nbsp;</td>
                              <td align="left" valign="top">&nbsp;</td>
                            </tr>
                          </table>
<div align="center"><?php echo $this->Form->end('Guardar información'); ?><br><br></div>
</td></tr></table>
