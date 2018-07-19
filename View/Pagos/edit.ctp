<?php
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

 $osexo=array('F'=>'Femenino','M'=>'Masculino');
 $asexo=array('legend'=>false,
	      'label'=>false
	     // 'hidden'=>true
              //'value'=>''
             );
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Pagos', 
                                array('controller'=>'Pagos','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Edit', 
                                array('controller'=>'Pagos','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br>
<?php
 echo $this->Form->create('Pago', array('action'=>'edit'));
 echo $this->Form->input('Pago.id',array('type'=>'hidden'));
?>


<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Pago'), '#menu-basic');
			echo $this->Croogo->adminTab(__d('croogo', 'Notas'), '#menu-note');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
 <div id="menu-basic" class="tab-pane"><br>
<!--  Informacion de las Pagos -->      
<table border="0" class="form">
 <tr>
  <td width="50%"><!-- Informacion del Depositante -->
   <div class="square3_Externo">
    <b class="square3_1"><!--&nbsp;--></b>
    <b class="square3_2"><!--&nbsp;--></b>
    <b class="square3_3"><!--&nbsp;--></b>
    <b class="square3_4"><!--&nbsp;--></b>
    <div class="square3_Interno">  
     <div align="left">  
     <table border="0">
       <tr>
        <td width="33%">
         <?php echo $this->Form->input('cbexpediente_id',
                            array('label' => 'Expediente',
				  'type'=>'text',
				  'size'=>'10',
			          'maxlength'=>'4',
                                  'placeholder'=>'0001',
				  'autofocus'));
          ?>
        </td>
        <td width="33%">
         <?php      
       echo $this->Form->input('anio',
                            array('type'  => 'text',
				  'label' => 'Año',
				  'size'=>'10',
			          'maxlength'=>'4',
			          'placeholder'=>date('Y')
			      ));
     ?>
        </td>
        <td width="33%"><!-- Identificacion -->        
        <?php      echo $this->Form->input('globaljuzgado_id', 
                                  array('type'=>'select',
                                        'label'=> 'Juzgados', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
	 ?>
        </td>
       </tr>
      </table>    
      <?php
          echo $this->Form->input('importe',array('label'=> 'Importe'));
     ?>
    </div>
   </div>
	  <b class="square3_4b"></b>
	  <b class="square3_3b"></b>
	  <b class="square3_2b"></b>
  	<b class="square3_1b">
     </b></div>      
    </td><!-- FIN Informacion del Depositante -->
   </tr>
  </table><!-- FIN Informacion de las Pagos -->

			</div>


			<div id="menu-note" class="tab-pane"> <br>

     <?php
       echo $this->Form->textarea('notas',
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
echo			$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply', 'class' => 'btn')) .
			$this->Form->button(__d('croogo', 'Save'), array('class' => 'btn btn-primary')) .
			$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('class' => 'btn btn-danger'));
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

<div id="radio">
    <input type="radio" id="radio1" name="radio" /><label for="radio1">Choice 1</label>
    <input type="radio" id="radio2" name="radio" checked="checked" /><label for="radio2">Choice 2</label>
    <input type="radio" id="radio3" name="radio" /><label for="radio3">Choice 3</label>
  </div>
-->
</div>


<?php echo $this->Form->end(); ?>
