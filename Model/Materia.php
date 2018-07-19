<?php
 class Materia extends AppModel {
  public $useTable = 'globalmaterias'; //tabla que exista en la base de datos
  public $name = 'Asuntos'; 
  public $displayField = 'descripcion';
  public $order = "Materia.descripcion ASC";
 var $actsAs = array('Logable');

  public $hasMany = array(        
			'Expediente' => array(            
				'className'     => 'Expediente',
				'foreignKey'    => 'globalmateria_id'      
		        ),
			'Juzgado' => array(            
				'className'     => 'Juzgado',
				'foreignKey'    => 'globalmateria_id'      
	                 )
  ); 
			         

 function beforeSave(){
  $modelo='Materia';
  $campo='id';
  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  } 
 }    
   
	
}

?>
