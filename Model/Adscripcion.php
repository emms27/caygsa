<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
class Adscripcion extends AppModel {
 public $useTable = 'globalassignments';
 var $actsAs = array('Logable');

 public $belongsTo = array(
  	'Location' => array(            
		'className'    => 'Location',
		'foreignKey'   => 'globallocation_id'
         )
  ); 

  
 public $hasOne = array(        
  	'Personal' => array(            
		'className'    => 'Personal',
		'foreignKey'   => 'globalassignment_id'
         )
 ); 
			         
   
   
	
}

?>
