<?php 
/**
 * View para el guardar informacion del Etapa, Ficha y las Partes Involucradas.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

 //echo $this->Html->css(array('radio/style'));
?> 

<div id="breadcrumb">
        <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Etapa',  '/Stages'); 
              $this->Html->addCrumb('Alta' ,  '/Stages/add' , array('class' => 'breadcrumblast')); 
//              echo $this->Html->getCrumbs('  > ', 'Home');

         ?>
</div><br>
<?php
 echo $this->Form->create('Stage',array('action'=>'add','id' => 'formulario','type' => 'file'));
 echo $this->Form->input('Stage.id',array('type'=>'hidden'));
?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Etapa'), '#menu-basic');
			echo $this->Croogo->adminTab(__d('croogo', 'Notas'), '#menu-note');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
			<div id="menu-basic" class="tab-pane"><br>
<table border="0" class="form">
 <tr>
  <td width="50%">
   <div class="square3_Externo">
    <b class="square3_1"><!--&nbsp;--></b>
    <b class="square3_2"><!--&nbsp;--></b>
    <b class="square3_3"><!--&nbsp;--></b>
    <b class="square3_4"><!--&nbsp;--></b>
    <div class="square3_Interno"><!-- Stage -->                                            
      <table border="0">
       <tr>
        <td width="30%">
         <?php echo $this->Form->input('Stage.num',
                            array('label' => 'Expediente',
				  'type'=>'text',
				  'size'=>'10',
			          'maxlength'=>'4',
                                  'placeholder'=>'0001',
				  'autofocus'));
          ?>
        </td>
        <td width="30%">
         <?php      
       echo $this->Form->input('Stage.anio',
                            array('type'  => 'text',
				  'label' => 'Año',
				  'size'=>'10',
			          'maxlength'=>'4',
			          'placeholder'=>date('Y')
			      ));
     ?>
        </td>
        <td width="30%"><!-- Identificacion -->        
        <?php      echo $this->Form->input('Stage.globaljuzgado_id', 
                                  array('type'=>'select',
                                        'label'=> 'Juzgados', 
                                        'empty' => 'Por favor, seleccione...',
				        'onchange' => 'this.form.submit()'
                                       )
                            );
	 ?>


        </td>
       </tr>
       <tr>
	<td>
<?php
          echo $this->Form->input('Stage.fecha_acuerdo',array('label' => 'Fecha de Acuerdo',
						        'id' => 'datepicker',
					                'type' => 'text',
						        'readonly'=>'readonly'
                                                       )
                                 );
?>
        </td>
	<td>
<?php
	 echo $this->Form->input('Stage.cbetapa_id', 
                                  array('type'=>'select',
                                        'label'=> 'Etapa', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
?>
	</td>
       </tr>
      </table>    
      <?php     

				echo $this->Form->input('Stage.filename', array('type' => 'file','label'=>false));
				echo $this->Form->input('Stage.dir', array('type' => 'hidden'));
				echo $this->Form->input('Stage.mimetype', array('type' => 'hidden'));
				echo $this->Form->input('Stage.filesize', array('type' => 'hidden'));
                                  
          ?>
       
   </div>
   <b class="square3_4b"></b>
   <b class="square3_3b"></b>
   <b class="square3_2b"></b>
   <b class="square3_1b">
   </b></div>      
  </td><!-- FIN Informacion del Depositante -->  
 </tr>
</table>

			</div>


			<div id="menu-note" class="tab-pane"> <br>
   <?php
    echo $this->Form->textarea('Stage.notas',
	                       array('rows' => '5', 
	 		   	     'class'=>'ckeditor',
		                     'cols' => '5',
		                     'placeholder'=>'Escriba una observacion si es necesario'
		              ));
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
//		echo $this->Html->beginBox('Publishing') .
echo			$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply', 'class' => 'btn')) .
			$this->Form->button(__d('croogo', 'Save'), array('class' => 'btn btn-primary')) .
			$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('class' => 'btn btn-danger'));
//			$this->Html->endBox();

//		$this->Croogo->adminBoxes();
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
<?php echo $this->Form->end(); 
 
echo $this->Ajax->datepicker('datepicker', array(
    'showButtonPanel' => true,
    'showWeek' => true,
    'showAnim' => 'clip',
    'changeMonth' => true,
    'changeYear' => true,
    'dateFormat' => 'yy-mm-dd',
    'altField'=>"#alternate",
    'altFormat'=>"DD, d MM, yy"
));
?>
