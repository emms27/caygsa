<?php
class Contacteno extends AppModel {
 public $useTable = 'cbcontactenos';
 public $name = 'Correo';  
 var $actsAs = array('Logable');
  
 public $belongsTo = array(    							
	'User' => array( 
		  'className'    => 'User',
		  'foreignKey'   => 'ddfmuser_id',
 ));  


 function beforeSave(){ 
  $modelo='Contacteno';
  $campo='id';

  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]=="") {
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  }
 }
  	
 public $validate = array(		
           'ddfmuser_id' => array(
		  'rule' => 'notEmpty',
  		  'message' => 'Faltó el destinatario'
	    ),
           'asunto' => array(
		  'rule' => 'notEmpty',
  		  'message' => 'Faltó el asunto'
	    ),
           'mensaje' => array(
		  'rule' => 'notEmpty',
  		  'message' => 'Faltó el mensaje'
	    )        	
 );

	
}
?>
