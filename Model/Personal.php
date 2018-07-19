<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
class Personal extends AppModel {
 public $useTable = 'globalemployees';	
 public $virtualFields = array('namefull' => 'CONCAT(Personal.nombre, " ",Personal.apepat, " ",Personal.apemat)');
 public $displayField = 'namefull';
 var $actsAs = array('Logable');

 public $belongsTo = array(
  	'Adscripcion' => array(            
		'className'    => 'Adscripcion',
		'foreignKey'   => 'globalassignment_id'
         )
  );

 public $hasOne = array(
   	'User' => array( 
		'className'    => 'User',
		'foreignKey'   => 'globalemployee_id'
	)
 );

}

?>
