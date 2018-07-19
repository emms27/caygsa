<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
class TipoCredito extends AppModel {
 public $useTable = 'cbtipocreditos';
 public $name = 'Credito'; 
 public $displayField = 'tipo';
 public $order = "TipoCredito.tipo ASC";	
 var $actsAs = array('Logable');

 /*public $hasOne = array(
   	'User' => array( 
		'className'    => 'User',
		'foreignKey'   => 'cbemployee_id'
	)
 );*/

 function beforeSave(){
  $modelo='TipoCredito';
  $campo='id';
  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]=="")
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  return true;
 }

 public $validate = array(
 	'tipo' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                        'message' => 'Faltó el tipo de Crédito'
	         )
         ) 	 
 );
	
	
}

?>
