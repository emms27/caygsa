<?php
/**
 * Layout principal
 * @version 1.0
 * @author L.I. Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
?>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('admin/reset',
				            'admin/style',
                                            'admin/forms', 
                                            'admin/fenix',
                                            'menu/fixedMenu_style2',
                                            'tablas',
		                            'fuentes', //gfonts',
					    'iconos',
             	                            'paginacion',
		                            'ui-lightness/jquery-ui-1.8.23.custom',
					    'http://fonts.googleapis.com/css?family=Amaranth',
		                            'http://fonts.googleapis.com/css?family=Linden Hill',
					    'http://fonts.googleapis.com/css?family=Tangerine',
					    'http://fonts.googleapis.com/css?family=Handlee',
					    'http://fonts.googleapis.com/css?family=Great Vibes',
					    'http://fonts.googleapis.com/css?family=Mate SC',
			      		    'http://fonts.googleapis.com/css?family=Italianno',
					    'http://fonts.googleapis.com/css?family=IM Fell English SC',
					    'http://fonts.googleapis.com/css?family=Judson',
					    'http://fonts.googleapis.com/css?family=Montaga'
                                            )
                                       );
		echo $this->Html->script(array(
                 			       //'jquery-1.8.0.min',
                                               'jquery-1.7.1',
                 		               //'jquery-ui-1.8.23.custom.min',                                         
				               //'jquery-1.4.2.min',
                 		               'jquery.fixedMenu',
                                               'ckeditor/ckeditor'
                                              )
                                         );
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
?>
<script>
        $('document').ready(function(){
            $('.menu').fixedMenu();
        });
</script>
</head>
<body>
 <header>
  <h1>Sistema Virtual de DDFM</h1>
<!--
  <nav>

                  <ul class="MenuBarHorizontal" id="MenuBar3">
                   <li><a class="MenuBarItemSubmenu" href="javascript:void(0)">Catalogo</a> 
                    <ul>
                       <li><a href="secciones/Catalogo/depen.php" target="main2">Dependencias</a></li>
                        <li><a href="secciones/Catalogo/lic_cons.php" target="main2">Licenciados</a></li>
                        <li><a href="secciones/Catalogo/ocupacion.php" target="main2">Ocupaci&oacute;n</a></li>
                        <li><a href="secciones/Catalogo/tera_cons.php" target="main2">Terapeutas</a></li>                
                        <li><a href="secciones/Catalogo/concepto.php" target="main2">Conceptos</a></li>
                    </ul>
                   </li>
                  </ul>

			<ul>
				<li><a href="#">Nacional</a></li>
				<li><a href="#">Internacional</a></li>
				<li><a href="#">Política</a></li>
				<li><a href="#">Ciencia</a></li>
				<li><a href="#">Medio Ambiente</a></li>
				<li><a href="#">Aviso Oportuno</a></li>
			</ul>
   </nav>	
-->
   <div class="menu" >
  <?php
   echo $this->CssMenu->menu(array('Expedientes'=> array('Alta'=> $this->base.'/Expedientes/alta_ficha',
                                                         'Consulta'=> $this->base.'/Expedientes/',
                                                   'Cosulta Detalle'=> $this->base.'/Expedientes/detalle_general',
                                                         'Exportacion CVS'=> $this->base.'/Expedientes/cvs'
                                                        )
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Involucrados'=> array('Alta'=> $this->base.'/Involucrados/alta',
                                                          'Consulta'=> $this->base.'/Involucrados/'
                                                          )
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Depositos'=> array(
						       'Alta'=> $this->base.'/Depositos/alta',
                                                       'Consulta'=> $this->base.'/Depositos/'
                                                        )
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Orden de Pago'=> array('Alta'=> $this->base.'/OrdenPagos/alta',
                                                           'Consulta'=> $this->base.'/OrdenPagos/'
                                                          )
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Cheques'=> array('Alta'=> $this->base.'/Cheques/alta',
                                                     'Consulta'=> $this->base.'/Cheques/'
                                                    )
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Daps'=> array('Alta'=> $this->base.'/Daps/alta',
                                                  'Consulta'=> $this->base.'/Daps/'
                                                 )
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Plastico'=> array('')
                                  ),
                             'down'
                             );
  ?>
  <?php
   echo $this->CssMenu->menu(array('Cerrar Sesion'=> $this->base.'/Users/logout'),
                             'down'
                             );
  ?>
</div>     
 </header>
 <div class="wrapper_all">
   <section class="content">
    <section id="noticia-principal"></section>
   </section>
   <section class="content">
    <section id="render">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
    </section>
    <section id="noticia-principal"></section>
   </section>

 </div>
 <div class="footer">
  <table border="0">
   <tr>
    <td colspan="2" width="89%" height="5"></td>
   </tr>
   <tr>
    <td width="11%">
     <?php echo $this->Html->image("logo_pj.jpg", 
				   array("title" => "Poder Judicial del Estado de Puebla",
				         'width'=>'100px',
				         'height'=>'88px'
				  )); ?>
    </td>
    <td width="89%">
     <table border="0">
      <tr>
       <td width="50%"><h2>CIUDAD JUDICIAL SIGLO XXI</h2></td>
       <td width="50%"><h2>PALACIO DE JUSTICIA</h2></td>
      </tr>
      <tr>
       <td width="50%">  

  <table border="0">
   <tr>
    <td width="7%"  valign="top" class="footpage">
     <div align="justify"><strong> Dirección:</strong></div>
    </td>
    <td valign="top" class="footpage">
     <div align="justify"> Periférico Arco Sur s/n San Andrés Cholula.</div>
    </td>
   </tr>
   <tr>
    <td  valign="top" class="footpage">
     <div align="justify"><strong>  Teléfono:</strong></div>
    </td>
    <td  valign="top" class="footpage">
     <div align="justify">   (222) 223 84 00</div>
    </td>
   </tr>
  </table>
 
       </td>
       <td width="50%">

  <table border="0">
   <tr>
    <td width="7%"  valign="top" class="footpage">
     <div align="justify"><strong> Dirección:</strong></div>
    </td>
    <td valign="top" class="footpage">
     <div align="justify"> 5 Oriente número 9 Colonia:Centro Histórico</div>
    </td>
   </tr>
   <tr>
    <td  valign="top" class="footpage">
     <div align="justify"><strong>  Teléfono:</strong></div>
    </td>
    <td  valign="top" class="footpage">
     <div align="justify">  (222) 229-66-00</div>
    </td>
   </tr>
   <tr>
    <td width="7%" valign="top" class="footpage">
     <div align="justify"><strong> C.P:</strong></div>
    </td>
    <td  valign="top" class="footpage">
     <div align="justify"> 72000</div>
    </td>
   </tr>
  </table>

       </td>
       </tr>
     </table>
    </td>
   </tr>
   <tr>
    <td width="11%">

    </td>
    <td width="89%" height="30">
     <div align="center">©2010 Honorable Tribunal Superior de Justicia del Estado de Puebla. | Poder Judicial del Estado de Puebla. | Departamento de Depósitos, Fianzas y Multas.</div>
    </td>
   </tr>
  </table>

  </div>
<section class="content">
  <section id="noticia-principal">
   <?php echo $this->element('sql_dump'); echo $this->Js->writeBuffer(); // Write cached scripts  ?>
  </section>  </section>


</body>
</html>
