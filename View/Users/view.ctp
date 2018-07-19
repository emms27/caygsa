<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
  echo $this->Html->css(array('../cloudbits/css/Fancybox/2.1.5/jquery.fancybox.css?v=2.1.5'));
  echo $this->Html->script(array('../cloudbits/js/Fancybox/2.1.5/jquery.fancybox.js?v=2.1.5'));
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
         echo $this->Html->link('Personal', 
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
       <?php 
         echo $this->Html->link(
                $this->Html->image('uploads/user/filename/'.$foto, 
				   array("width"=>"200px","height"=>"200px","border"=>"0")),
				   '/img/uploads/user/filename/'.$foto,
				   array('title'=>'',"class"=>"fancybox-effects-d",'escape' => false));
      ?>
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
                              <td align="left" valign="top"><?php echo $personal['Personal']['globalarea_id']; ?></td>
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
