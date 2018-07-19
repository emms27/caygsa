<?php
/**
 * Layout principal
 * @version 1.0
 * @author L.I. Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
  	  <?php //echo $this->Html->charset(); ?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?> | <?php echo __('SIDFM'); ?></title>
	<?php
		echo $this->Html->meta('icon');
echo $this->Html->css(array(
			'/croogo/css/croogo-bootstrap',
			'/croogo/css/croogo-bootstrap-responsive',
		));
		echo $this->Html->script(array('html5'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
	<body class="admin-login">
		<div id="wrap">
			<header class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid">
		 <?php //echo $this->Html->image("logos/SIDDFM.png",array("width"=>"221px","height"=>"32px","border"=>"0")); ?>
                                        </div>
				</div>
			</header>
			<div id="push"></div>
			<div id="content-container" class="container-fluid">
				<div class="row-fluid">
					<div id="admin-login">
					<?php
						echo $this->Session->flash();
						echo $this->fetch('content');
					?>
					</div>
				</div>
			</div>

		</div>
		<?php echo $this->element('admin/footer'); ?>
   <?php 
	echo $this->element('sql_dump'); 
//	echo $this->Js->writeBuffer(); // Write cached scripts  
   ?>
	</body>
</html>

