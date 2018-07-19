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
                                            'tablas',
		                            'fuentes',
					    'iconos',
					    'square',
             	                            'paginacion',
                                            'ui/jquery-ui-1.8.4.custom',
					    'menu/SpryMenuBarHorizontal',
			                    'jboesch-gritter/jquery.gritter',
					    'http://fonts.googleapis.com/css?family=Amaranth',
		                            'http://fonts.googleapis.com/css?family=Linden Hill',
					    'http://fonts.googleapis.com/css?family=Tangerine',
					    'http://fonts.googleapis.com/css?family=Handlee',
					    'http://fonts.googleapis.com/css?family=Great Vibes',
					    'http://fonts.googleapis.com/css?family=Mate SC',
			      		    'http://fonts.googleapis.com/css?family=Italianno',
					    'http://fonts.googleapis.com/css?family=IM Fell English SC',
					    'http://fonts.googleapis.com/css?family=Judson',
					    'http://fonts.googleapis.com/css?family=Montaga',
					    'http://fonts.googleapis.com/css?family=Pompiere'
                                            )
                                       );
		echo $this->Html->script(array(
                                               //'jquery-1.7.1',
                                               'ui-lightness/jquery-1.8.0', 
				               'ui-lightness/jquery-ui-1.8.23.custom.min',
				               'ui/i18n/jquery.ui.datepicker-es',
					       'menu/SpryMenuBar',
					       'menu/AC_RunActiveContent',
		                               'jquery.gritter',
		                               'jquery.gritter.min',
                                               'ckeditor/ckeditor'
                                              )
                                         );
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                echo $this->Html->scriptBlock('var webroot="'.$this->webroot.'";');
?>
</head>
<body>
<center>
 <header>
  <div class="tool">
   <div id="bartool" class="arial10blanco">
    <?php echo 'Bienvenido(a)  '.$userid['username'];  ?>
    <?php echo $this->Html->image("icons/icon-tools.gif", array("width"=>"184","height"=>"22","border"=>"0","usemap"=>"#MapTools")); ?>
   </div>
  </div>
  <div id="title">
   <?php echo $this->Html->image("title/09.jpg", 
		                 array("width"=>"1055px",
				       "height"=>"180px"
		                 )); 
   ?>
  </div>
<map name="MapTools" id="MapTools">
  <area shape="rect" coords="1,0,28,22" href="<?php echo $this->base; ?>" title="Inicio" />
  <area shape="rect" coords="32,0,59,22" href="#" title="Mapa del Sitio" />
  <area shape="rect" coords="63,1,90,22" href="#" title="Herramientas" />
  <area shape="rect" coords="94,1,121,22" href="mailto:esanchez@htsjpuebla.gob.mx" title="Contacto" />
  <area shape="rect" coords="125,1,152,22" href="<?php echo $this->base.'/Users/logout'; ?>" title="Cerrar Sesión" />
  <area shape="rect" coords="156,1,183,22" href="#" title="Configuración" />
</map>
   <nav>
   <table border="0" align="center">
    <tr>
     <td> 
     <table width="80" border="0" cellpadding="0" cellspacing="0">
     <tr>  <!-- Expediente -->
      <td bgcolor="#999999">
       <ul class=MenuBarHorizontal Estilo1 id="MenuBar1"> 
        <li><a class="MenuBarItemSubmenu" href="#">Expediente</a> 
         <ul>
          <li><a href="#" class="MenuBarItemSubmenu">Consulta</a>
           <ul>
            <li><a href="<?php echo $this->base.'/Expedientes/'; ?>">Expediente</a></li>
            <li><a href="<?php echo $this->base.'/Expedientes/detalle_general'; ?>">General Detallada</a></li>
            <li><a href="<?php echo $this->base.'/Expedientes/cvs'; ?>">CVS</a></li>
           </ul>
          </li>
         </ul>
        </li>
       </ul>
      </td>
      <!-- FIN Expediente -->
      <td bgcolor="#999999">  <!-- Involucrados -->
       <ul class=MenuBarHorizontal Estilo1 id="MenuBar2"> 
        <li><a class="MenuBarItemSubmenu" href="#">Involucrados</a> 
         <ul>
          <li><a href="<?php echo $this->base.'/Involucrados/alta'; ?>" >Alta</a></li>
          <li><a href="<?php echo $this->base.'/Involucrados/'; ?>" >Consulta</a></li>
         </ul>
        </li>
       </ul>
      </td> 
      <!-- FIN Involucrados -->
      <td bgcolor="#999999">  <!-- Depositos -->
       <ul class=MenuBarHorizontal Estilo1 id="MenuBar3"> 
        <li><a class="MenuBarItemSubmenu" href="#">Depósitos</a> 
         <ul>
          <li><a href="javascript:void(0)" class="MenuBarItemSubmenu">Alta</a>
           <ul>
            <li><a href="<?php echo $this->base.'/Expedientes/alta_ficha'; ?>">Depósito y Partes</a></li>
            <li><a href="<?php echo $this->base.'/Depositos/alta'; ?>" >Depósito</a></li>
           </ul>
          </li>
          <li><a href="javascript:void(0)" class="MenuBarItemSubmenu">Consulta</a>
           <ul>
            <li><a href="<?php echo $this->base.'/Depositos/'; ?>" >Depósitos</a></li>
           </ul>
          </li>
         </ul>
        </li>
       </ul>
      </td> 
      <!-- FIN Depositos -->
      <td bgcolor="#999999">  <!-- Ordend de Pago -->
       <ul class=MenuBarHorizontal Estilo1 id="MenuBar4"> 
        <li><a class="MenuBarItemSubmenu" href="#">Orden de Pago</a> 
         <ul>
          <li><a href="<?php echo $this->base.'/OrdenPagos/alta'; ?>" >Alta</a></li>
          <li><a href="<?php echo $this->base.'/OrdenPagos/'; ?>" >Consulta</a></li>
         </ul>
        </li>
       </ul>
      </td> 
      <!-- FIN Ordend de Pago -->
      <td bgcolor="#999999"><!-- Pagos -->
       <ul class=MenuBarHorizontal Estilo1 id="MenuBar5"> 
        <li><a class="MenuBarItemSubmenu" href="#">Pagos</a> 
         <ul>
          <li><a href="#" class="MenuBarItemSubmenu">Alta</a>
           <ul>
            <li><a href="<?php echo $this->base.'/Cheques/alta'; ?>">Cheques</a></li>
            <li><a href="<?php echo $this->base.'/Daps/alta'; ?>">Daps</a></li>
            <li><a href="<?php echo $this->base.'/Plasticos/alta'; ?>">Plasticos</a></li>
           </ul>
          </li>
          <li><a href="#" class="MenuBarItemSubmenu">Consulta</a>
           <ul>
            <li><a href="<?php echo $this->base.'/Cheques/'; ?>">Cheques</a></li>
            <li><a href="<?php echo $this->base.'/Daps/'; ?>">Daps</a></li>
            <li><a href="<?php echo $this->base.'/Plasticos/'; ?>">Plasticos</a></li>
           </ul>
          </li>
         </ul>
        </li>
       </ul>
      </td>
      <!-- FIN Pagos -->
      <td bgcolor="#999999">  <!-- Ordend de Pago -->
       <ul class=MenuBarHorizontal Estilo1 id="MenuBar6"> 
        <li><a  href="">    </a> </li>
       </ul>
      </td> 
     </tr>
    </table>

</td> 
     </tr>
    </table>

  </nav>
      <script type=text/javascript> 
       var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1");
       var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2");
       var MenuBar3 = new Spry.Widget.MenuBar("MenuBar3");
       var MenuBar4 = new Spry.Widget.MenuBar("MenuBar4");
       var MenuBar5 = new Spry.Widget.MenuBar("MenuBar5");  
      </script>   
</header>

 <div class="wrapper_all">
  <section class="content">
   <section id="render">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
   </section>
  </section>
 </div>
 <footer>

<!-- 
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
    <td width="11%"></td>
    <td width="89%" height="30">
     <div align="center">©2010 Honorable Tribunal Superior de Justicia del Estado de Puebla. | Poder Judicial del Estado de Puebla. | Departamento de Depósitos, Fianzas y Multas.</div>
    </td>
   </tr>
  </table>
-->
  <div>
      <?php echo $this->Html->image("html5.png", 
				   array('width'=>'215px',
				         'height'=>'56px'
				  )); ?>
  </div><div>
   Copyright © 2011 Honorable Tribunal Superior de Justicia del Estado de Puebla.</div>
 </footer>
   <?php echo $this->element('sql_dump'); echo $this->Js->writeBuffer(); // Write cached scripts  ?>
</center>
</body>
</html>
