<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
class Location extends AppModel {
  public $useTable = 'globallocations';
 var $actsAs = array('Logable');

  public $hasOne = array(        
  	'Adscripcion' => array(            
		'className'    => 'Adscripcion',
		'foreignKey'   => 'globallocation_id'
         )
  ); 

}
?>
