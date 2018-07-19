<?php
/**
 * Modelo Etapa
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 **/
class Etapa extends AppModel {
 public $useTable = 'cbetapas';
 public $name = 'Etapa'; 
 public $displayField = 'etapa';
 public $order = "Etapa.id ASC";
 var $actsAs = array('Logable');

  //var $name = 'htsjpexpedientes';
  //public $primaryKey= 'num_expediente';
  //public $uses = array('AsignarFicha', 'Juzgado'); //para agregar un modelo que este asociado con el actual


  public $hasOne = array(        
	'Stage' => array(            
		'className'     => 'Stage',
		'foreignKey'    => 'cbetapa_id'      
	)
  );
   

 function beforeValidate(){
 }
    
 function beforeSave(){
   $this->data['Etapa']['cbexpediente_id']=$this->data['Etapa']['globaljuzgado_id'].
                $this->data['Etapa']['num'].
                $this->data['Etapa']['anio'];
   $this->data['Etapa']['id']=$this->data['Etapa']['cbexpediente_id'].
                $this->data['Etapa']['cbstage_id'];

   $this->data['Etapa']['fecha_registro']=date('Y-m-d h:i:s');
   $this->data['Etapa']['cbuser_id']="1";
//debug($this->data);
  }

  function limitEtapa($data, $limit){
   //$field = array_pop(array_keys($data)); //key
   $data = array_pop(array_values($data)); //valor

   $idetapa=$this->data['Etapa']['globaljuzgado_id'].
                $this->data['Etapa']['num'].
                $this->data['Etapa']['anio'].$data;
  
   $expediente_count = $this->find('count', array('conditions' => array('Etapa.id' => $idetapa), 
                                                                'recursive' => -1) );        
   return $expediente_count < $limit;    
  }
     
  function limitInexistente($data, $limit){
   //$field = array_pop(array_keys($data)); //key
   $data = array_pop(array_values($data)); //valor 
   $idexpediente=$this->data['Etapa']['globaljuzgado_id'].$data.$this->data['Etapa']['anio'];  
   $expediente_count = $this->Expediente->find( 'count', array('conditions' => array('Expediente.id' => $idexpediente), 
                                                                'recursive' => -1) );        
   return $expediente_count == $limit;    
  }

   	
 public $validate = array(
 	'num' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el expediente'
                ),
	        'pk_expediente' => array(            	
	 		'rule' => array('limitInexistente',1),            
			'message' => 'Este expediente no existe'
		),
	       'minLenght-' => array(
	       		'rule'    => array('minLength', 4),
		        'message' => 'El Expediente debe tener 4 digitos. 0001'
		),
	       'maxLenght-' => array(
		        'rule'    => array('maxLength', 4),
		        'message' => 'El Expediente debe tener 4 digitos. 0001'
	        ),
	       'numerico' => array(
			'rule' => 'numeric',          
			'message' => 'El Expediente debe ser numerico'    
	        ),
	       'number' => array(
		        'rule'    => array('range', 0, 10000),
		        'message' => 'Un numero entre 1 al 9999'
                )
       ),
       'anio' => array(
       		'Vacio' => array(
        		'rule' => 'notEmpty',
			'message' => 'Faltó el año'
                ),
        	'Rango' => array(
			'rule' => array('validarAnio',1),            
			'message' => 'Año fuera del rango. (1980- Actual)'
		)       
       ),	
       'cbstage_id' => array(
      		'Vacio' => array(
        		'rule' => 'notEmpty',
			'message' => 'Faltó la etapa'
                ),
	        'fk_etapa' => array(            	
	 		'rule' => array('limitEtapa',1),            
			'message' => 'La etapa ya fue creada en el expediente'
		)
       ),			
       'globaljuzgado_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                       	'message' => 'Seleccione un juzgado'
                )
       )
  );
	
}

?>
