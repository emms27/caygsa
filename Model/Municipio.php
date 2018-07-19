<?php
class Municipio extends AppModel {
  public $useTable = 'globalmunicipios';
  public $name = 'Municipio';
  public $displayField = 'municipio';
  public $order = "Municipio.municipio ASC";
 var $actsAs = array('Logable');

  public $belongsTo = array(           
             'Estado' => array(            
			'className'     => 'Estado',
			'foreignKey'    => 'globalestado_id'
              )
  ); 

  public $hasMany = array(
  	'Juzgado' => array( 
		'className'    => 'Juzgado',
		'foreignKey'   => 'globalmunicipio_id'
	)
  );

/* function limitDuplicates($data, $limit){  
   $idcount = $this->find('count',array('conditions' => $data, 
			                  'recursive' => -1
   ));         
   return $idcount < $limit;    
  }
*/

 function beforeSave(){
  $modelo='Municipio';
  $campo='id';
  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  } 
 }    

 public $validate = array(

	'globalestado_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el estado'
		)
        ),
	'municipio' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el Municipio'
    		)
        )
 );   
	
}


?>
