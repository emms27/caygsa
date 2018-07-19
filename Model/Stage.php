<?php
/**
 * Modelo Etapa
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 **/
class Stage extends AppModel {
 public $useTable = 'cbetapas_cbexpedientes';
 public $name = 'EtapaProcesal'; 
//  public $displayField = 'etapa';
 public $order = "Stage.id ASC";

 public $actsAs = array(
    'Logable',
    'MeioUpload' => array( 
    	'filename' => array(
		'dir' => 'files{DS}{ModelName}{DS}{fieldName}',
        	'create_directory' => true,
		'allowedMime' => array('application/pdf'),
	        'allowedExt' => array('.pdf')
        ) 
    ) 
 ); 

 public $belongsTo = array(        
  	'Expediente' => array( 
		 'className'    => 'Expediente',
		 'foreignKey'   => 'cbexpediente_id'
        ),
	'Etapa' => array(            
		'className'     => 'Etapa',
		'foreignKey'    => 'cbetapa_id'      
	)
 );  


 function beforeValidate(){

 }


 function beforeSave(){
    $modelo='Stage';
    $campo='id';
    $campo2='fecha_pago';


    if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]=="") {
     $valor[0]=$this->data[$modelo]['cbetapa_id'];
     $valor[1]=$this->data[$modelo]['globaljuzgado_id'].
               $this->data[$modelo]['num'].
               $this->data[$modelo]['anio'];
     $ex=$this->Expediente->find('first',array('conditions'=>array('expediente'=>$valor[1]),
					       'recursive'=>-1,
				               'fields' => array('id','expediente')));
     $this->data[$modelo][$campo]=$ex['Expediente']['id'].$valor[0]; 
     $this->data[$modelo]['cbexpediente_id']=$ex['Expediente']['id'];
     $this->data[$modelo]['fecha_registro']= date('Y-m-d h:i:s');
    }else {
    }
    return true;
 }	

 function limitDuplicates($data, $limit){  
  $idexpediente=$this->data['Stage']['globaljuzgado_id'].$data['num'].$this->data['Stage']['anio'];
  $id_count = $this->Expediente->find('count',array('conditions' => array('Expediente.expediente'=>$idexpediente), 
			                  'recursive' => -1
  ));        
  return $id_count >= $limit;    
 }

 function limitEtapa($data, $limit){  
  $modelo='Stage';
  $valor[0]=$this->data[$modelo]['cbetapa_id'];
  $valor[1]=$this->data[$modelo]['globaljuzgado_id'].
            $this->data[$modelo]['num'].
            $this->data[$modelo]['anio'];

  $ex=$this->Expediente->find('first',array('conditions'=>array('expediente'=>$valor[1]),
					       'recursive'=>-1,
				               'fields' => array('id','expediente')));

  $idetapa=$ex['Expediente']['id'].$valor[0]; 
  $id_count = $this->find('count',array('conditions' => array($modelo.'.id'=>$idetapa),'recursive' => -1));        
  return $id_count != $limit;    
 }


 public $validate = array(
 	'num' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el expediente'
                ),
	        'pk_expediente' => array(            	
	 		'rule' => array('limitDuplicates',1),            
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
 	'globaljuzgado_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                       	'message' => 'Seleccione un juzgado'
                )
         ),
   	'cbetapa_id' => array(
	        'Vacio' => array(            	
			'rule' => 'notEmpty',
			'message' => 'Faltó la etapa'
		),
	        'pk_expediente' => array(            	
	 		'rule' => array('limitEtapa',1),            
			'message' => 'Esta etapa ya existe'
		)
    	),				
       'fecha_acuerdo' => array(
		 'Vacio' => array(
                        'rule' => 'notEmpty',
			'message' => 'Faltó la fecha de acuerdo'
		  ),
		 'dateformat' => array(            
                       'rule'       => 'date', //date('Y-m-d h:i:s', strtotime('-1 year'));
        	       'message'    => 'Fecha incorrecta. formato YYYY-MM-DD.'
                  )
                                 
        ),
        'filename' => array('Empty' => array('check' => false))
  );
	
}

?>
