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
         echo $this->Html->link('Eventos', 
                                array('plugin'=>'full_calendar','controller'=>'Events','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Edit', 
                                array('plugin'=>'full_calendar','controller'=>'Events','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br>
<?php
 echo $this->Form->create('Event', array('action'=>'edit'));
 echo $this->Form->input('id',array('type'=>'hidden'));
?>


<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Evento'), '#menu-basic');
			echo $this->Croogo->adminTab(__d('croogo', 'Programar Fecha'), '#menu-note');
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
     <div align="left">                                       
     <?php 
      echo $this->Form->input('cbexpediente_id', 
                                  array('type'=>'text',
                                        'label'=> 'Expediente',
				        'readonly'=>'readonly'
                                       )
                            );
          echo $this->Form->input('cbeventtype_id', 
                                  array('type'=>'select',
                                        'label'=> 'Tipo de Evento', 
                                        'empty' => 'Por favor, seleccione...'
                                       )
                            );


		echo $this->Form->input('title',array('label'=>'Título'));

	      echo $this->Form->input('details', 
                                  array('type'=>'textarea',
                                        'label'=> 'Detalles',
				 	'style'=>'width:450px;',
				        'rows' => '5', 'cols' => '5',
				        'placeholder'=>'16 sept. 33'
                                       )
                            );
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
  </table><!-- FIN Informacion de las Partes -->

			</div>


<div id="menu-note" class="tab-pane"> <br>
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
     <div align="left">                                       
      <?php
	echo $this->Form->input('start');
	echo $this->Form->input('end');
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
       if ($this->request->data['Event']['active']==0){
	$sclass="icon-ok";
	$sclassname=" Activar";
	$sbutton="btn btn-success";
       }else{
	$sclass="icon-ban-circle";
	$sclassname=" Desactivar";
	$sbutton="btn btn-danger";
       }

	echo		$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply', 'class' => 'btn')) .
			$this->Form->button(__d('croogo', '<i class="icon-save"> Save</i>'), array('class' => 'btn btn-primary')).
		        $this->Html->link('<i class="'.$sclass.'">'.$sclassname.'</i>',
                                array('controller'=>'Events','action'=>'status',$this->request->data['Event']['id']),
				array('escape' => false,'class'=>$sbutton));


	echo "<br><br>".
	     $this->Form->input('all_day', array('checked' => 'checked')).
             $this->Form->input('status', array('options' => array(
					'Scheduled' => 'Scheduled','Confirmed' => 'Confirmed','In Progress' => 'In Progress',
					'Rescheduled' => 'Rescheduled','Completed' => 'Completed'
	)));
?>
    </div>
   </div>
  </div>
 </div>	
</div>
</div>
<?php echo $this->Form->end(); ?>
