<?php
/**
 * Modelo Expediente
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 **/
class Pago extends AppModel {
 public $useTable = 'cbpagos'; 
 public $name = 'Pagos';
 var $actsAs = array('Logable');

 public $belongsTo = array(           
             'Expediente' => array(            
				'className'     => 'Expediente',
				'foreignKey'    => 'cbexpediente_id',      
             )  
 );  

   function beforeValidate(){
   }

  function beforeSave(){
    $modelo='Pago';
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
     if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
      $this->data[$modelo][$campo]=$this->IDExpedienteNew($modelo,$campo,$ex['Expediente']['id']);
     }else{
     }

     $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
     $this->data[$modelo]['cbexpediente_id']=$ex['Expediente']['id'];
     return true;

    } else{
     return true;
    } 
    return false;
   }

 function DuplicatesExpediente($data, $limit){
   $idexpediente=$this->data['Pago']['globaljuzgado_id'].
                 $data['cbexpediente_id'].                  
                 $this->data['Pago']['anio'];

   $expedienteid = $this->Expediente->find('count', 
                                           array('conditions'=> array('Expediente.expediente'=>$idexpediente), 
                                                 'recursive' => -1
   )); 
   return $expedienteid >= $limit;    
 }


 public $validate = array(
   	'cbexpediente_id' => array(
   		'Vacio' => array(
   	     		'rule' => 'notEmpty',
             		'message' => 'Faltó el expediente'
        	),
        	'pk_expediente' => array(            
			'rule' => array('DuplicatesExpediente',1),            
	                'message' => 'Expediente no existe'
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
   	'importe' => array(
   		'Vacio' => array(
        		'rule' => 'notEmpty',
			'message' => 'Faltó el monto'
		),
		'Dinero' => array(
        		'rule'    => array('decimal', 2),
            		'message' => 'Monto incorrecto'
        	),
		'Money' => array(
			'rule' => array('comparison', '>', 0),        
        		'message' => 'El monto debe ser mayor a 0'
		)
   	 )
    );	
}
?>
