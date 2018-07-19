<?php echo $this->Form->create('User', array('action' => 'login'));   ?>
<div class="box">
	<div class="box-content">
	<?php
		$this->Form->inputDefaults(array(
			'label' => false,
		));
		echo $this->Form->input('username', array(
			'placeholder' => __('Username'),
			'before' => '<span class="add-on"><i class="icon-user"></i></span>',
			'div' => 'input-prepend text',
			'class' => 'span11',
			'autofocus'
		));
		echo $this->Form->input('password', array(
 		        'type'=>'password',
			'placeholder' => 'Password',
			'before' => '<span class="add-on"><i class="icon-key"></i></span>',
			'div' => 'input-prepend password',
			'class' => 'span11',
		));
		echo $this->Form->button(__('Iniciar sesión'));
		echo $this->Html->link(__('Olvidó su password?'), 
				       array(
					     'admin' => false,
					     'controller' => 'users',
					     'action' => 'forgot',
				       ), array('class' => 'forgot'));
	?>
	</div>
</div>
<?php    echo $this->Form->end(); ?>
