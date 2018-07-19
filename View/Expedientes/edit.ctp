<?php 
/**
 * View para el guardar informacion del Expediente, Ficha y las Expedientes Involucradas.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

 echo $this->Html->css(array('radio/style'));
 $osexo=array('Embargo'=>'Embargo','Hipoteca'=>'Hipoteca');
 $asexo=array('legend'=>false,
	      'label'=>false
              //'value'=>''
             );

?> 

<div id="breadcrumb">
        <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Expediente',  '/Expedientes'); 
              $this->Html->addCrumb('Edit' ,  '/Expedientes/' , array('class' => 'breadcrumblast')); 
//              echo $this->Html->getCrumbs('  > ', 'Home');

         ?>
</div><br>
<?php
 echo $this->Form->create('Expediente', array('action'=>'edit'));
 echo $this->Form->input('Expediente.id',array('type'=>'hidden'));
?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Expediente'), '#menu-basic');
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
    <div class="square3_Interno"><!-- Expediente -->                                           
     <table border="0">
      <tr>
       <td>  
      <table border="0">
       <tr>
        <td width="33%">
         <?php echo $this->Form->input('Expediente.num',
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
       echo $this->Form->input('Expediente.anio',
                            array('type'  => 'text',
				  'label' => 'Año',
				  'size'=>'10',
			          'maxlength'=>'4',
			          'placeholder'=>date('Y')
			      ));
     ?>
        </td>
        <td width="33%"><!-- Identificacion -->        
        <?php      echo $this->Form->input('Expediente.globaljuzgado_id', 
                                  array('type'=>'select',
                                        'label'=> 'Juzgados', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
	 ?>
        </td>
       </tr>
      </table>    
       </td> 
      </tr>
      <tr>
       <td>
     <table border="0">
       <tr>
        <td width="50%">
         <?php 
  echo $this->Form->input('Expediente.globalmateria_id', 
                                  array('type'=>'select',
                                        'label'=> 'Materia', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
          ?>
        </td>
        <td width="50%">
        <?php echo $this->Form->input('Expediente.cbcliente_id', 
                                  array('type'=>'select',
                                        'label'=> 'Cliente', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
	 ?>
        </td>
       </tr>
      </table>    
       </td>
      </tr>
      <tr>
	<td>
      <table border="0">
       <tr>
        <td width="33%">Gravamen
    <?php  if ($this->request->data['Expediente']['tipo_gravamen']=='Embargo'){ ?>
      <div id="csexo">
        <input type="radio" id="radio1" name="data[Expediente][tipo_gravamen]" value="Embargo" required="required" checked />
        <label for="radio1">Embargo</label>
        <input type="radio" id="radio2" name="data[Expediente][tipo_gravamen]" value="Hipoteca" required="required" />
	<label for="radio2">Hipoteca</label>
     </div>
    <?php }else{ ?>
      <div id="csexo">
        <input type="radio" id="radio1" name="data[Expediente][tipo_gravamen]" value="Embargo" required="required" />
        <label for="radio1">Embargo</label>
        <input type="radio" id="radio2" name="data[Expediente][tipo_gravamen]" value="Hipoteca" required="required" checked />
	<label for="radio2">Hipoteca</label>
     </div>

     <?php }  echo $this->Form->error('Expediente.tipo_gravamen'); ?>
        </td>
        <td width="33%">
         <?php 
          echo $this->Form->input('Expediente.globaltipojuicio_id', 
                                  array('type'=>'select',
                                        'label'=> 'Tipo de Juicio', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );

          ?>
        </td>
        <td width="33%">
<label for="example-input-preapppend">Cuantia del juicio</label>
<div class="input-prepend input-append">
<span class="add-on">$</span>
         <?php      
     echo $this->Form->input('Expediente.cuantia_juicio', array(
			     'type'=>'text',
			     'div' => false,
			     'label' => false,
			     'id'=>"example-input-preapppend",
			     'class'=>"input-mini text-right",
			     'placeholder'=>"12.27"

	));
     ?>
<!-- <span class="add-on">.00</span> -->
</div>
        </td>
       </tr>
      </table>
    </td>
    </tr>
    <tr><td>
      <table border="0">
       <tr>
        <td width="50%">
         <?php 
 echo $this->Form->input('Expediente.garantia', array(
					'label' =>'Garantía',
					'maxlength'=>'255'
				));
          ?>
        </td>
        <td width="50%">
<label for="example-input-preapppend">Valor Garantía</label>
<div class="input-prepend input-append">
<span class="add-on">$</span>
         <?php      
     echo $this->Form->input('Expediente.valor_garantia', array(
			     'type'=>'text',
			     'div' => false,
			     'label' => false,
			     'id'=>"example-input-preapppend",
			     'class'=>"input-mini text-right",
			     'placeholder'=>"12.27"

	));
     ?>
<!-- <span class="add-on">.00</span> -->
</div>
        </td>
       </tr>
      </table>    
	</td>
      </tr>
    <tr><td>
      <table border="0">
       <tr>
        <td width="33%">
         <?php 
    echo $this->Form->input('Expediente.num_credito', array(
					'label' => false,
					'label' => __d('croogo', 'Número de Credito'),
				));
          ?>
        </td>
        <td width="33%">
         <?php 
    echo $this->Form->input('Expediente.cis', array(
					'label' =>'CIS',
					'maxlength'=>'10'
				));
          ?>
        </td>
        <td width="33%">
     <?php
          echo $this->Form->input('Expediente.fecha_terminacion',array('label' => 'Fecha de Terminación',
						        'id' => 'datepicker',
					                'type' => 'text',
						        'readonly'=>'readonly'
                                                       )
                                 );
	?>
        </td>
       </tr>
      </table>    
	</td>
      </tr>
    </table> <!-- FIN Iden -->        
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
    echo $this->Form->textarea('Expediente.notas',
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
<?php 
   echo $this->Form->end(); 
   echo $this->Ajax->buttonset('csexo');
 
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
/*
'showAnim' =>show
'showAnim' =>slideDown
'showAnim' =>fadeIn
'showAnim' =>blind
'showAnim' =>bounce
'showAnim' =>clip
'showAnim' =>drop
'showAnim' =>fold
'showAnim' =>slide

echo $this->Form->input('ficha_id',array('type'=>'select','multiple' => true,'label'=> 'Fichas','empty' => 'Por favor, seleccione...'));
//Solo funciona con find(list) >
*/
?>
