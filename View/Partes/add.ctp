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
              //'value'=>''
             );
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
 echo $this->Form->create('Parte', array('action'=>'add'));
 echo $this->Form->input('Parte.id',array('type'=>'hidden'));
?>

<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Parte'), '#menu-basic');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">
		 <div id="menu-basic" class="tab-pane"><br>
<!--  Informacion de las Partes -->      
<table border="0" class="form">
 <tr>
  <td width="50%"><!-- Informacion del Depositante -->
   <div class="square3_Externo">
    <b class="square3_1"><!--&nbsp;--></b>
    <b class="square3_2"><!--&nbsp;--></b>
    <b class="square3_3"><!--&nbsp;--></b>
    <b class="square3_4"><!--&nbsp;--></b>
    <div class="square3_Interno">                                         
     <table border="0">
      <tr>
       <td>  
      <table border="0">
       <tr>
        <td width="33%">
         <?php echo $this->Form->input('Parte.cbexpediente_id',
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
       echo $this->Form->input('Parte.anio',
                            array('type'  => 'text',
				  'label' => 'Año',
				  'size'=>'10',
			          'maxlength'=>'4',
			          'placeholder'=>date('Y')
			      ));
     ?>
        </td>
        <td width="33%"><!-- Identificacion -->        
        <?php      echo $this->Form->input('Parte.globaljuzgado_id', 
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
       <td>  <!-- Nombre Completo -->        
        <table border="0">
         <tr>
          <td width="33%">
           <?php
                 echo $this->Form->input('Parte.nombre',
				            array('label' => 'Nombre',
						  'type'=>'text',
						  'size'=>'12',
						  'maxlength'=>'50',
				                  'placeholder'=>'Emmanuel',
						  )
                                        );
	      ?>
          <td width="33%">
           <?php
                echo $this->Form->input('Parte.apepat',
				            array('label' => 'Apellido paterno',
						  'type'=>'text',
						  'size'=>'11',
						  'maxlength'=>'50',
				                  'placeholder'=>'Sanchez',
						  )
                                        );
	      ?>
           </td>
           <td width="33%">
 	      <?php
                 echo $this->Form->input('Parte.apemat',
				            array('label' => 'Apellido materno',
						  'type'=>'text',
						  'size'=>'11',
						  'maxlength'=>'50',
				                  'placeholder'=>'Carreon',
						  )
                                        );
	      ?>
          </td>
         </tr>
        </table>        
       </td><!-- FIN Nombre Completo -->
      </tr>
      <tr>
       <td>
        <table border="0" width="100%">
         <tr>
          <td>
      <div id="csexo">
        <input type="radio" id="csexo1" name="data[Parte][sexo]" value="F" required="required" />
        <label for="csexo1">Femenino</label>
        <input type="radio" id="csexo2" name="data[Parte][sexo]" value="M" required="required" />
	<label for="csexo2">Masculino</label>
     </div>
 <?php echo $this->Form->error('Parte.sexo'); ?>
          </td>
          <td>
      <div id="ctipo">
        <input type="radio" id="ctipo1" name="data[Parte][tipo]" value="Autor" required="required" />
        <label for="ctipo1">Actor</label>
        <input type="radio" id="ctipo2" name="data[Parte][tipo]" value="Demandado" required="required" />
	<label for="ctipo2">Demandado</label>
     </div>
 <?php echo $this->Form->error('Parte.tipo'); ?>
	  </td>
         </tr>
	</table>
       </td>
      </tr>
      <tr>
           <td>  <!-- Estado -->        
  	    <?php 
	      echo $this->Form->input('Parte.domicilio', 
                                  array('type'=>'textarea',
                                        'label'=> 'Domicilio',
				 	'style'=>'width:450px;',
				        'rows' => '5', 'cols' => '5',
				        'placeholder'=>'16 sept. 33'
                                       )
                            );
	   ?>
           </td>  <!-- FIN Estado -->        
      </tr>
   <tr>
       <td>  <!-- Nombre Completo -->        
        <table border="0">
         <tr>
          <td width="33%">
           <?php
                 echo $this->Form->input('Parte.telefono',
				            array('label' => 'Teléfono',
						  'type'=>'text',
						  'size'=>'12',
						  'maxlength'=>'50',
				                  'placeholder'=>'2305349',
						  )
                                        );
	      ?>
          <td width="33%">
           <?php
                echo $this->Form->input('Parte.movil',
				            array('label' => 'Movil',
						  'type'=>'text',
						  'size'=>'12',
						  'maxlength'=>'50',
				                  'placeholder'=>'2224025408',
						  )
                                        );
	      ?>
           </td>
           <td width="33%">
 	      <?php
                 echo $this->Form->input('Parte.oficina',
				            array('label' => 'Oficina (otro)',
						  'type'=>'text',
						  'size'=>'12',
						  'maxlength'=>'50',
				                  'placeholder'=>'2305348',
						  )
                                        );
	      ?>
           </td>
          </tr>
         </table>        
        </td><!-- FIN Nombre Completo -->
       </tr>
    
       <tr>
        <td>  <!-- email -->        
		 <?php 
		  echo $this->Form->input('Parte.email',
						    array('label' => 'Email',
					  'type'=>'text',
				 	  'style'=>'width:450px;',
					  'size'=>'40',
					  'maxlength'=>'255',
					  'placeholder'=>'contacto@cloudbits.mx'
					  )
		   );
		 ?>
     </td>  <!-- FIN email -->        
    </tr>
    <tr>
     <td>  <!-- Identificacion -->        
      <table border="0">
       <tr>
        <td width="50%">
<?php echo $this->Identificacion->ComboIdentificacion('Parte.tidentificacion','Identificacion',null,null); ?>   
        </td>
        <td width="50%">
	    <?php
                 echo $this->Form->input('Parte.nidentificacion',
				            array('label' => 'Núm. Identicación',
						  'type'=>'text',
						  'size'=>'18',
						  'maxlength'=>'13',
				                  'placeholder'=>'1234567890123',
						  )
                                        );
	      ?>
        </td>  
       </tr>
      </table>  
     </td>  <!-- FIN Identificacion -->        
    </tr>
   </table>
  </div>
  <b class="square3_4b"></b>
  <b class="square3_3b"></b>
  <b class="square3_2b"></b>
  <b class="square3_1b">
  </b></div>      
  </td><!-- FIN Informacion del Depositante -->
    
 </tr>
</table><!-- FIN Informacion de las Partes -->



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
    echo $this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply', 'class' => 'btn')) .
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
-->
</div>
<?php 
   echo $this->Form->end(); 
   echo $this->Ajax->buttonset('csexo');
   echo $this->Ajax->buttonset('ctipo');
?>
