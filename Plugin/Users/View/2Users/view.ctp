<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
  $fdate=explode(' ',$personal['User']['fecha_update']); 
  if (($personal['User']['filename']=='') || ($personal['User']['filename']==NULL)) $foto='user.jpg'; 
  else $foto=$personal['User']['filename'];
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
         echo $this->Html->link('Consulta', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Consulta','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Vista', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Consulta','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="28%"><h1>Consulta del Perfil</h1></td>
  <td width="68%">
  </td>
 </tr>
 <tr>
  <td colspan="3" class="arial11gris" align="left" style="padding-top:10px; padding-bottom:10px;">

  </td>
 </tr>
</table>

<table style="border:1px solid #DDD; width:90%"><tr><td>
 <table border="0" cellpadding="0" cellspacing="0" class="arial12gris">
  <tr><td colspan="2" class="encabezados"><?php echo $personal['Personal']['namefull']; ?></td></tr>
                            <tr>
                              <td height="5" colspan="2"></td>
                            </tr>
                            <tr>
                              <td height="5" colspan="2" bgcolor="#E5E5E5"></td>
                            </tr>
                            <tr>
                              <td width="271" rowspan="18" align="center" valign="middle">
				<?php echo $this->Html->image('uploads/user/filename/'.$foto,array("width"=>"180px","height"=>"180px","border"=>"0")); ?>
                              <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="364" align="left"><strong>Adscripción</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $personal['Adscripcion']['adscripcion']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><strong>&Aacute;rea</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $personal['Personal']['htsjparea_id']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><strong>Cargo</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $personal['Personal']['puesto']; ?></td>
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
                              <td align="left" valign="top"><strong>Ubicaci&oacute;n</strong></td>
                            </tr>
                            <tr>
                           <td align="left" valign="top"><?php echo $location['Location']['ubicacion']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><strong>Direcci&oacute;n</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $location['Location']['domicilio']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><strong>Colonia</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $location['Location']['col']; ?></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><strong>C&oacute;digo postal</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $location['Location']['cp']; ?></td>
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
                            <tr>
                              <td align="left" valign="top"><strong>Tel&eacute;fono</strong></td>
                              <td align="left" valign="top"><strong>Conmutador</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php echo $personal['Personal']['telefono']; ?></td>
                              <td align="left" valign="middle">No disponible</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><strong>Email</strong></td>
                              <td align="left" valign="top"><strong>Extensi&oacute;n</strong></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><?php
         echo $this->Html->link($personal['Personal']['email'],
                                'mailto:esanchez@htsjpuebla.gob.mx',
			        array('title'=>'email','escape' => false));
                              ?></td>
                              <td align="left" valign="top">No disponible</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr><td colspan="2" align="center" valign="top" class="arial10gris">&nbsp;</td></tr>
                          </table>
                        </td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
</td></tr></table>
<p align="center" class="arial11grisclaro" >
 <em><strong>Última Acceso:</strong>
  <?php  echo $this->Dates->FormatoCompletoFecha($fdate[0]).'&nbsp;&nbsp;'.$fdate[1]; ?>
 </em>
</p>
