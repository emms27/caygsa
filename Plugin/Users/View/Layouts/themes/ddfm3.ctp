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
					    'square',
             	                            'paginacion',
					    'actions-tools/style',
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
    <?php echo $this->Html->image("icons/icon-tools.gif", array("width"=>"184","height"=>"22","border"=>"0","usemap"=>"#MapTools")); ?>
    <p><?php echo 'Bienvenido(a)  '.$userid['username'];  ?></p>
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
 <div id="contenedorfooter"><?php echo $this->element("footer");?></div>
 <hr style="width:100%;text-align:center;height:1px;border:1px;color:#e2e2e2;background-color:#e2e2e2;" />
 <div id="footerfin">   Copyright © 2011 Honorable Tribunal Superior de Justicia del Estado de Puebla.</div>
</footer>
   <?php 
	echo $this->element('sql_dump'); 
	echo $this->Js->writeBuffer(); // Write cached scripts  
   ?>
</center>
</body>
</html>
