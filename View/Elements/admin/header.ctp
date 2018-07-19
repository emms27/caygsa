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
<header class="navbar navbar-inverse navbar-fixed-top">

<div class="navbar-inner remove-radius remove-box-shadow">
<div class="container">
<a href="http://www.cloudbits.org.mx" target="_blank">
 <?php echo $this->Html->image("http://www.cloudbits.org.mx/img/57-cdbit.png",
 array("width"=>"40px","height"=>"40px","border"=>"0","class"=>"brand")); ?>
</a>
 <div class="nav-collapse collapse navbar-responsive-collapse2">
  <ul class="nav pull-right">
   <li>
      <?php 
	   echo $this->Form->input('search', array('label'=>'',
						    'placeholder'=>'Busca un expediente',
		 			            'type'=>'search',
		                                    'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                                                    'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on"
						     
            )); 
       ?>
   </li>
   <li class="divider-vertical"></li>
<li class="dropdown">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li>
<?php
         echo $this->Html->link(' Refresh', 
                                array('plugin'=>false,
				      'controller'=>'pages',
				      'action' => 'home'),
				array('escape' => false,'class'=>'icon-refresh'));  
?>
</li>
<li class="divider"></li>
<li>
<?php
         echo $this->Html->link(' Editar Perfil', 
                                array('plugin'=>false,
				      'controller'=>'Users',
				      'action'=>'edit/'.$this->Session->read('Auth.User.id')),
				array('escape' => false,'class'=>'icon-user'));  
?>
</li>
<li>
<?php
         echo $this->Html->link(' App Settings', 
                                array('plugin'=>false,'controller'=>'pages','action'=>'home'),
				array('escape' => false,'class'=>'icon-wrench'));  
?>
</li>
<li class="divider"></li>
<li>
<?php
         echo $this->Html->link(' Log out', 
                                array('plugin'=>false,'controller'=>'Users','action' => 'logout'),
				array('escape' => false,'class'=>'icon-lock'));  
?>
</li>
<!--
<li class="divider"></li>
<li class="nav-header">Extra</li>
<li><a href="javascript:void(0)">First Link</a></li>
<li><a href="javascript:void(0)">Second Link</a></li>
-->
</ul>
</li>
</ul>
</div>
</div>
</div>
</header>

<!--
	<div class="navbar-inner">
   	  <div class="nav-collapse collapse">
	   <ul class="nav" style="padding:3px;">
 	    <li>
             
	   </ul>
	   <?php if ($this->Session->read('Auth.User.id')): ?>
    	   <ul class="nav pull-right">
	    <li>
	     <a href="#">
		<?php echo sprintf(__d('croogo', "You are logged in as: %s"), $this->Session->rea('Auth.User.username')); ?>
  	     </a>
  	    </li>
	    <li>
	 <?php echo $this->Html->link(__d('croogo', "Log out"), array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')); ?>
	    </li>
  	   </ul>
	<?php endif; ?>
  </div>
 </div>
-->


