<?php 
/**
 * View para el guardar informacion del Expediente, Ficha y las Partes Involucradas.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email carreon.emmanuel@gmail.com
 */

 //echo $this->Html->css(array('radio/style'));
 $ogravament=array('Embargo'=>'Embargo','Hipoteca'=>'Hipoteca');
 $osexo=array('F'=>'Femenino','M'=>'Masculino');
 $attribe=array('legend'=>false);//,'disabled'=>false);//, 'label'=>false, 'checked'=> ($foo == "Aclarativos") ? FALSE : TRUE,);
?> 
<div id="breadcrumb">
        <?php
              $this->Html->addCrumb('',  '/',array('class' => 'icon-home')); 
              $this->Html->addCrumb('Expediente',  '/Expedientes'); 
              $this->Html->addCrumb('Alta' ,  '/Expedientes/add' , array('class' => 'breadcrumblast')); 
//              echo $this->Html->getCrumbs('  > ', 'Home');
         ?>
</div><br>
<?php
 echo $this->Form->create('Expediente', array('action'=>'add'));
 echo $this->Form->input('Expediente.id',array('type'=>'hidden'));
?>
<div class="row-fluid">
	<div class="span8">
		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Expediente'), '#menu-basic');
			echo $this->Croogo->adminTab(__d('croogo', 'Demandado'), '#menu-demandado');
			echo $this->Croogo->adminTab(__d('croogo', 'Notas'), '#menu-note');
			echo $this->Croogo->adminTabs();
		?>
		</ul>
		<div class="tab-content">
  <div id="menu-basic" class="tab-pane"><br>
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
        <td width="33%">
       <?php echo $this->Form->label('User.names','Tipo de Gravament:'); 
          echo '<div id="egravament">';
   	  echo $this->Form->radio('Expediente.tipo_gravament',  $ogravament,$attribe);
	  echo $this->Form->error('Expediente.tipo_gravament');  
          echo '</div>';
       ?>
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
        <?php //echo $this->Form->error('Expediente.cuantia_juicio');  ?>
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
        <td width="30%">
         <?php 
    echo $this->Form->input('Expediente.num_credito', array(
					'label' => false,
					'maxlength'=>'20',
					'label' =>'Número de Crédito'
				));
          ?>
        </td>
        <td width="33%">
         <?php 
          echo $this->Form->input('Expediente.cbtipocredito_id', 
                                  array('type'=>'select',
                                        'label'=> 'Tipo de Crédito', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );
          ?>
        </td>
        <td width="30%">
         <?php      
     echo $this->Form->input('Expediente.cis', array(
					'label' =>'CIS',
					'maxlength'=>'10'
				));
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
  <!-- FIN Informacion del Depositante -->  


			</div>
	<div id="menu-demandado" class="tab-pane"><br>
  <div class="square3_Externo">
    <b class="square3_1"><!--&nbsp;--></b>
    <b class="square3_2"><!--&nbsp;--></b>
    <b class="square3_3"><!--&nbsp;--></b>
    <b class="square3_4"><!--&nbsp;--></b>
    <div class="square3_Interno">                                         
     <table border="0">
   
      </tr>
      <tr>
       <td>  <!-- Nombre Completo -->        
        <table border="0">
         <tr>
          <td width="33%">
           <?php
                 echo $this->Form->input('Parte.0.nombre',
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
                echo $this->Form->input('Parte.0.apepat',
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
                 echo $this->Form->input('Parte.0.apemat',
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
       <?php echo $this->Form->label('User.names','Sexo:'); 
          echo '<div id="csexo">';
   	  echo $this->Form->radio('Parte.0.sexo',  $osexo,$attribe);
	  echo $this->Form->error('Parte.0.sexo');  
          echo '</div>';
       ?>
          </td>
         </tr>
	</table>
       </td>
      </tr>
      <tr>
           <td>  <!-- Estado -->        
  	    <?php 
	      echo $this->Form->input('Parte.0.domicilio', 
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
                 echo $this->Form->input('Parte.0.telefono',
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
                echo $this->Form->input('Parte.0.movil',
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
                 echo $this->Form->input('Parte.0.oficina',
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
		  echo $this->Form->input('Parte.0.email',
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
<?php echo $this->Identificacion->ComboIdentificacion('Parte.0.tidentificacion','Identificacion',null,null); ?>   
        </td>
        <td width="50%">
	    <?php
                 echo $this->Form->input('Parte.0.nidentificacion',
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
-->
</div>
<?php 
   echo $this->Form->end(); 
   echo $this->Ajax->buttonset('egravament');
   echo $this->Ajax->buttonset('csexo');
?>
