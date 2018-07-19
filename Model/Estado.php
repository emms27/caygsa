<?php
class Estado extends AppModel {
 public $useTable = 'globalestados';
 public $name = 'Estado';
 public $displayField = 'entidad';
 public $order = "Estado.entidad ASC";
 var $actsAs = array('Logable');

  public $hasMany = array(
  	'Municipio' => array( 
		'className'    => 'Municipio',
		'foreignKey'   => 'globalestado_id'
	)
  );


}

?>
