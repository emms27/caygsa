<?php
/**
 * Modelo Expediente
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 **/
class Cliente extends AppModel {
 public $useTable = 'cbclientes'; //tabla que exista en la base de datos
 public $name = 'Cliente';
 public $virtualFields = array('namefull' => 'CONCAT(Cliente.nombre, " ",Cliente.apepat, " ",Cliente.apemat)');
 public $displayField = 'namefull';
 var $actsAs = array('Logable');

 function beforeSave(){
  $modelo='Cliente';
  $campo='id';

  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  }
  return true;
 }

 public $validate = array(
        'sexo' => array(
   		'allowedChoice' => array(
        		'rule' => array('inList', array('F','M')),
			'message' => 'Seleccione un género'          
		)
	),
 	'nombre' => array(
	     'Vacio' => array(
              'rule' => 'notEmpty',
			'message' => 'Faltó el nombre'
			             ),
	     'maximo-40' => array(
              'rule'    => array('maxLength', 50),
              'message' => 'El Nombre debe tener menos de 51 caracteres'
                                )
	    ),
	'apepat' => array(
	     'Vacio' => array(
              'rule' => 'notEmpty',
	      'message' => 'Faltó el apellido paterno'
			             ),
	     'maximo-40' => array(
              'rule'    => array('maxLength', 50),
              'message' => 'El Apellido Paterno debe tener menos de 51 caracteres'
                                )
		 ),
	 'apemat' => array(
	   	'Vacio' => array(
               		'rule' => 'notEmpty',
	       		'message' => 'Faltó el apellido materno'
                 ),
	        'maximo-40' => array(
                	'rule'    => array('maxLength', 50),
                        'message' => 'El Apellido Materno debe tener menos de 51 caracteres'
                 ),
	         'alphaNumeric' => array(
              	 	'rule'     => 'alphaNumeric',
           	 	'message'  => 'El nombre solo acepta caracteristicas'
	         )
            ),
	 'domicilio' => array(
	   	'Vacio' => array(
               		'rule' => 'notEmpty',
	       		'message' => 'Faltó el domicilio'
                 )
            ),/*
	 'email' => array(
		  'rule' => 'email',
  		  'message' => 'Correo electrónico incorrecto.'
		 ),*/
 	'rfc' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó el RFC'
	        )
    	)	 
    );	
}
?>
