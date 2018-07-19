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
 <title><?php echo $title_for_layout; ?> | SIDFM</title>
 <link rel="apple-touch-icon" href="<?php echo $this->Html->url('/img/htsjp.png'); ?>"  />
  <?php
                echo $this->Html->meta('favicon.ico',$this->webroot.'img/icons/favicon.ico',array('type' => 'icon'));
		echo $this->Html->css(array(
					    'ddfm/reset',
				            'ddfm/style',
                                            'ddfm/forms', 
					    'ddfm/mapeo',
                                            'tablas',
		                            'fuentes',
					    'square',
             	                            'paginacion',
					    'actions-tools/style',
	                                    'ui-1.9.1/jquery-ui-1.9.1.custom',
                                            //'ui/jquery-ui-1.8.4.custom',
			                    'jgritter/jquery.gritter'
                                            )
                                       );
		echo $this->Html->script(array(
                                               'ui-lightness/jquery-1.8.2', 
				               'ui-lightness/jquery-ui-1.9.1.custom.min',
				               'ui-1.9.1/i18n/jquery.ui.datepicker-es',
		                               'jgritter/jquery.gritter',
		                               'jgritter/jquery.gritter.min',
					       'vTicker/jquery.vticker-min',
                                               'ckeditor/ckeditor'
                                              )
                                         );
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                echo $this->Html->scriptBlock('var webroot="'.$this->webroot.'";');
		$layout = $this->Helpers->load('Dates');
?>
</head>
<body>
<center>
<header>
 <div class="tool">
  <div class="bartool">
   <div class="header" align="left"> 
      <?php  echo$this->Html->image("logos/SIDDFM.png", array("width"=>"221px","height"=>"32px","border"=>"0"));  ?>
   </div>
   <div class="header" align="right"> </div>
   <div class="header" align="right"> 
      <?php echo $this->Form->input('search', array('label'=>'',
						    'placeholder'=>'Busca un expediente',
		 			            'type'=>'search',
		                                    'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                                                    'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on" 
            )); 
      ?>
   </div>
  </div>
 </div>
</header>
 <div class="wrapper_all">
  <section class="content_left"><?php echo $this->element("tools");?></section>
  <section class="content_right">
   <?php echo $this->Session->flash(); echo $this->Session->flash('auth'); ?>
   <div id="resultados"></div>
   <?php echo $this->fetch('content'); ?><br><br>
  </section>
 </div>
<?php	echo $this->Html->script(array('script')); ?>
<footer>
 <div id="contenedorfooter"><?php echo $this->element("footer");?></div>
 <div id="footerfin">Copyright © 2013 Honorable Tribunal Superior de Justicia del Estado de Puebla.</div>
</footer>
   <?php 
	//echo $this->element('sql_dump'); 
	//echo $this->Js->writeBuffer(); // Write cached scripts  
   ?>
</center>
</body>
</html>
