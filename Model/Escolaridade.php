<?php
/**
 * Modelo Expediente
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 **/
class Escolaridade extends AppModel {
  public $useTable = 'globalescolaridades'; //tabla que exista en la base de datos
  public $name = 'Escolaridad';
  public $order = "Escolaridade.escolaridad ASC";
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
				'foreignKey'    => 'globalescolaridade_id',      
	      ),
             'Parte' => array(            
				'className'     => 'Parte',
				'foreignKey'    => 'globalescolaridade_id',      
	      )        
    );  

 function beforeSave(){
  $modelo='Escolaridade';
  $campo='id';
  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  } 
 } 
   
	
}


?>
