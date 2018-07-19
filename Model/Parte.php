<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
class Parte extends AppModel {
  public $useTable = 'cbpartes';
  public $virtualFields = array('namefull' => 'CONCAT(Parte.nombre, " ",Parte.apepat, " ",Parte.apemat)');
  public $displayField = 'namefull';
 var $actsAs = array('Logable');

  public $belongsTo = array(
  	'Expediente' => array( 
		 'className'    => 'Expediente',
		 'foreignKey'   => 'cbexpediente_id'
        )/*
  	'Estado' => array( 
		'className'    => 'Estado',
		'foreignKey'   => 'htsjpestado_id'
	),
        'Escolaridade' => array(            
			'className'     => 'Escolaridade',
			'foreignKey'    => 'globalescolaridade_id',      
        ),
        'Ocupacione' => array(            
			'className'     => 'Ocupacione',
			'foreignKey'    => 'globalocupacione_id',      
        ) */   
 ); 

   function beforeValidate(){
   }
 
   function beforeSave(){
    $modelo='Parte';
    $campo='id';

    if (isset($this->data[$modelo]['anio']) && 
	isset($this->data[$modelo]['cbexpediente_id']) &&
        isset($this->data[$modelo]['globaljuzgado_id'])){
     $expediente = $this->data[$modelo]['globaljuzgado_id'].
		   $this->data[$modelo]['cbexpediente_id'].
		   $this->data[$modelo]['anio'];
     $ex=$this->Expediente->find('first',array('conditions'=>array('expediente'=>$expediente),
					       'recursive'=>-1,
				               'fields' => array('id','expediente')));
     //debug($ex);
     if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
      $this->data[$modelo][$campo]=$this->IDExpedienteNew($modelo,$campo,$ex['Expediente']['id']);
     }else{
     }

     $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
     $this->data[$modelo]['cbexpediente_id']=$ex['Expediente']['id'];
     return true;

    } else{
     if (isset($this->data[$modelo]['cbexpediente_id'])) $expediente=$this->data[$modelo]['cbexpediente_id'];
     else $expediente="";
     $lenexp=strlen($this->data[$modelo]['cbexpediente_id']);
     $this->data[$modelo][$campo]=$this->IDExpedienteNew($modelo,$campo,$this->data[$modelo]['cbexpediente_id']); 
     $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
     return true;
    } 
    return false;
   }
  

   function DuplicatesExpediente($data, $limit){
    $idexpediente=$this->data['Parte']['globaljuzgado_id'].
                  $data['cbexpediente_id'].                  
                  $this->data['Parte']['anio'];
    $expedienteid = $this->Expediente->find('count', 
                                array('conditions'=> array('Expediente.expediente' => $idexpediente),'recursive' => -1)); 
    return $expedienteid >= $limit;    
   }
	
			   
	
 public $validate = array(
    	'cbexpediente_id' => array(
                'Vacio' => array(
                	'rule' => 'notEmpty',
                        'message' => 'Faltó el expediente.'
	         ),
                'pk_expediente' => array(            
              	        'rule' => array('DuplicatesExpediente',1),            
                        'message' => 'El expediente no existe.'
                 )
        ),	
	'globaljuzgado_id' => array(
        	'rule' => 'notEmpty',
        	'message' => 'Faltó el juzgado'                                   
	),
 	'anio' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó el año.'
	        ),
	        'Rango' => array(
			'rule' => array('validarAnio',1),            
			'message' => 'Año fuera del rango. (1980- Actual)'
		)
    	),
        'tusuario' => array(
   		'allowedChoice' => array(
        		'rule' => array('inList', array('Depositante','Beneficiario')),
			'message' => 'Seleccione el tipo de parte'          
		)
	),
        'sexo' => array(
   		'allowedChoice' => array(
        		'rule' => array('inList', array('F','M')),
			'message' => 'Seleccione un género'          
		)
	),
        'edad' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó la edad.'
	        ),
	        'Mayor_Edad' => array(
	        	'rule' => array('comparison','>', 17),        
                	'message' => 'La edad no puede ser menor a 18'
	 	),
	        'Cienmas' => array(
	        	'rule' => array('comparison','<', 130),        
                	'message' => 'La edad no puede ser mayor a 130'
	 	),
	        'maxLenght-' => array(
			'rule'    => array('maxLength', 3),
		        'message' => 'La edad debe tener máximo 3 dígitos'
		),
		'numerico' => array(
			'rule' => 'numeric',          
			'message' => 'La edad debe ser numerico'    
		)
	),
         /*'id' => array(
	  'Vacio' => array('rule' => 'notEmpty',
			   'message' => 'ID Incorrecto.',
			  ),
 	     'isUnique' => array(	                 
		    'rule'    => 'isUnique',
            'message' => 'Esta Persona ya existe.'
			             ),
		 'pk_Parte' => array(            
			'rule' => array('limitDuplicates',1),            
			'message' => 'Esta Persona ya existe.'
			                       )
         ), 
	    'expediente_id' => array(
		  'Vacio' => array(						  
	        'rule' => 'notEmpty',
			'message' => 'Expediente Incorrecto.'
			              ),
		   'fk_expediente' => array(            
			'rule' => array('limitInexistente',0),            
			'message' => 'Este Expediente no existe.'
			                       )
        ),*/	
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
                 )/*,
	         'alphaNumeric' => array(
              	 	'rule'     => 'alphaNumeric',
           	 	'message'  => 'El nombre solo acepta caracteristicas'
	         )*/
            ),/*
	     'email' => array(
		  'rule' => 'email',
  		  'message' => 'Correo electronico incorrecto.'
		 ),*/

 	'estadocivil' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó el estado civil'
	        )
    	),
 	'globalescolaridade_id' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó la escolaridad'
	        )
    	),
 	'globalocupacione_id' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó la ocupación'
	        )
    	),
 	'htsjpestado_id' => array(
        	'Vacio' => array(
          		'rule' => 'notEmpty',
	  		'message' => 'Faltó el origen o estado'
	        )
    	),
	'tidentificacion' => array(
 	       'Vacio' => array('rule' => 'notEmpty',
	                        'message' => 'Faltó la Identificación'
		 	       )
				       ), 
    	'nidentificacion' => array(
  	                       'Vacio' => array('rule' => 'notEmpty',
	                                        'message' => 'Faltó el número de identificación'
			                       ),
			       'minLenght-' => array(
						     'rule'    => array('minLength', 13),
			       			     'message' => 'Número de identificación, mínimo 13 dígitos.'
						    ),
			       'maxLenght-' => array(
				                     'rule'    => array('maxLength', 13),
				                     'message' => 'Número de identificación, máximo 13 dígitos.'
						     ),
			       'numerico' => array(
				                    'rule' => 'numeric',          
				                    'message' => 'Número de identificación debe ser numerico.'    
			       )
         )  	 
    );
	
	
}

?>
