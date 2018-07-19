<?php
/**
 * Modelo Expediente
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email2 carreon.emmanuel@gmail.com
 **/
class Ocupacione extends AppModel {
   public $useTable = 'globalocupaciones'; //tabla que exista en la base de datos
   public $name = 'Ocupacion';
   public $order = "Ocupacione.ocupacion ASC";
 var $actsAs = array('Logable');
   //public $primaryKey= 'id_juzgado';
/*   
   public $hasOne = array(        
   	'User' => array( 
        	'className'    => 'User',
		'foreignKey'    => 'htsjpjuzgado_id'
        )
   );  
*/
   

   public $hasMany = array(        
             'Cliente' => array(            
				'className'     => 'Cliente',
				'foreignKey'    => 'globalocupacione_id',      
              ),
             'Parte' => array(            
				'className'     => 'Parte',
				'foreignKey'    => 'globalocupacione_id',      
              )
    );  

 function beforeSave(){
   $this->data['Ocupacione']['fecha_registro']=date('Y-m-d h:i:s');
  }  
   

 public $validate = array(
	'ocupacion' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el expediente'
                )
/*
	        'pk_expediente' => array(            	
	 		'rule' => array('limitDuplicates',1),            
			'message' => 'Esta ocupacion ya existe'
		)
*/
       )
 );
   
   
	
}


?>
