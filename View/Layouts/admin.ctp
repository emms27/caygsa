<?php
/**
 * Header.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 * @copyright cloudbits.mx
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?>  |  cloudbits.mx</title>
		<?php
		echo $this->Html->css(array(
			'/cloudbits/css/croogo-bootstrap',
			'/cloudbits/css/font-awesome/font-awesome',
			'/cloudbits/css/style',
			//'bootstrap/css/bootstrap',
			//'bootstrap/css/bootstrap-responsive',
			//'/croogo/css/croogo-bootstrap-responsive',
			//'/croogo/css/thickbox',
			'JqueryUI/jquery-ui-1.10.3.custom',
                        //'JqueryUI/themes/base/jquery-ui',
			'paginacion',
			'tablas',
			'square'
			//'jgritter/jquery.gritter'
		));
		echo $this->Layout->js();
		echo $this->Html->script(array(
                        '../cloudbits/js/Editores/CKEditor/ckeditor4.2/ckeditor',
			//'/croogo/js/html5',
			//'/croogo/js/jquery/jquery.min',
			//'/croogo/js/jquery/jquery-ui.min',
			'JqueryUI/js/jquery-1.9.1',
			//'JqueryUI/js/jquery-ui-1.10.3.custom.min',
			'/croogo/js/jquery/jquery.slug',
			'/croogo/js/jquery/jquery.cookie',
			'/croogo/js/jquery/jquery.hoverIntent.minified',
			'/croogo/js/jquery/superfish',
			'/croogo/js/jquery/supersubs',
			'/croogo/js/jquery/jquery.tipsy',
			'/croogo/js/jquery/jquery.elastic-1.6.1',
			'/croogo/js/jquery/thickbox-compressed',
			'/croogo/js/underscore-min',
			'/croogo/js/admin',
			'/croogo/js/choose',
			'/croogo/js/theme',
			'/croogo/js/croogo-bootstrap',
			'JqueryUI/js/jquery-ui-1.10.3.custom'
                        //'jgritter/jquery.gritter',
                        //'jgritter/jquery.gritter.min',
                        //'ckeditor/ckeditor'
		));

		echo $this->fetch('script');
		echo $this->fetch('css');
                echo $this->Html->scriptBlock('var webroot="'.$this->webroot.'";');
		?>
	</head>
	<body>
	 <div id="wrap">
	  <?php 
	   echo $this->element('admin/header'); 
	   echo $this->element('admin/navigation'); 
          ?>
	  <div id="content-container" class="container-fluid">
	   <div class="row-fluid">
	    <div id="content" class="clearfix">
	     <?php echo $this->element('admin/breadcrumb'); ?>
	     <div id="inner-content" class="span12">
   	     <div id="resultado"></div>
	      <?php 
		echo $this->Session->flash(); echo $this->Session->flash('auth'); 
		echo $this->fetch('content'); 
              ?>
	     </div>
	    </div>&nbsp;
	   </div>
	  </div>
	 </div>
	 <?php	
	 	echo $this->Html->script(array('/cloudbits/js/script'));
	        echo $this->element('admin/footer');
		echo $this->Blocks->get('scriptBottom');
		//echo $this->element('sql_dump'); 
		echo $this->Js->writeBuffer();
	?>
       </body>
</html>
