<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Partes', 
                                array('controller'=>'Involucrados','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Alta', 
                                array('controller'=>'Involucrados','action'=>'alta'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br>
<?php
 echo $this->Form->create('Juzgado', array('action'=>'edit'));
 echo $this->Form->input('Juzgado.id',array('type'=>'hidden'));
?>


<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Juzgado'), '#menu-basic');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
		 <div id="menu-basic" class="tab-pane"><br>
          <?php
		 echo $this->Form->input('Juzgado.num2',
					 array('type'=>'text',
					       'value'=>$this->request->data['Juzgado']['id'],
					       'label'=>'Id',
				               'readonly'=>'readonly'
		 ));
                 echo $this->Form->input('Juzgado.organo_judicial',
				            array('label' => false,
						  'type'=>'text',
						  'style'=>'width:90%;',
						  'maxlength'=>'255',
				                  'placeholder'=>'Juzgado',
						  'autofocus'
						  )
                                        );

                echo $this->Form->input('Juzgado.globalmateria_id', 
                                  array('type'=>'select',
                                        'label'=> 'Materia', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );

                echo $this->Form->input('Juzgado.globalmunicipio_id', 
                                  array('type'=>'select',
                                        'label'=> 'Municipio', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );

	      ?>
			</div>
			<?php echo $this->Croogo->adminTabs(); ?>
		</div>
	</div>


<div class="span4">
 <div class="row-fluid">
  <div class="span12">
   <div class="box">
    <div class="box-title">
		<i class="icon-list"></i>
				Publishing
    </div>
    <div class="box-content  ">
<?php
echo			//$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply', 'class' => 'btn')) .
			$this->Form->button(__d('croogo', 'Save'), array('class' => 'btn btn-primary')) .
			$this->Html->link(__d('croogo', 'Cancel'), 
				array('action' => 'status',$this->request->data['Juzgado']['id']), 
			        array('class' => 'btn btn-danger'));
?>
    </div>
   </div>
  </div>
 </div>	
</div>
<!--
	<div class="span4">
		<?php
		echo $this->Html->beginBox('Publishing') .
			$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply', 'button' => 'default')) .
			$this->Form->button(__d('croogo', 'Save'), array('button' => 'default')) .
			$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
			$this->Html->endBox();

		$this->Croogo->adminBoxes();
		?>
	</div>
-->
</div>
<?php echo $this->Form->end(); ?>
