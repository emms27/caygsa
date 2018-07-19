<?php
/**
 * Model
 * CakePHP Full Calendar Plugin
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
 
class Event extends FullCalendarAppModel {
  public $useTable = 'cbcitas'; //tabla que exista en la base de datos
  public $name = 'Agenda';
  //public $virtualFields = array('namefull' => 'CONCAT(Cliente.nombre, " ",Cliente.apepat, " ",Cliente.apemat)');
  public $displayField = 'title';
  public $order = "Event.title ASC";
 var $actsAs = array('Logable');

  var $belongsTo = array(
	'EventType' => array(
			'className' => 'FullCalendar.EventType',
			'foreignKey' => 'cbeventtype_id'
	),
	'Expediente' => array(            
		'className'     => 'Expediente',
		'foreignKey'    => 'cbexpediente_id'      
	)
  );

 function beforeSave(){
  $modelo='Event';
  $campo='id';

  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]=="") {

    $expediente = $this->data[$modelo]['globaljuzgado_id'].
                  $this->data[$modelo]['num'].
                  $this->data[$modelo]['anio'];

    $ex=$this->Expediente->find('first',array('conditions'=>array('expediente'=>$expediente),
					       'recursive'=>-1,
				               'fields' => array('id','expediente')));

    $this->data[$modelo][$campo]=$this->IDExpedienteNew($modelo,$campo,$ex['Expediente']['id']);
    $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
    $this->data[$modelo]['cbexpediente_id']=$ex['Expediente']['id'];
  }else {
  }
  return true;
 }	


  function DuplicatesExpediente($data, $limit){
   $lenexp=strlen($data['num']);
   if ($lenexp<12){
    $idexpediente=$this->data['Event']['globaljuzgado_id'].
                  $data['num'].                  
                  $this->data['Event']['anio'];
   } else $idexpediente=$data['cbexpediente_id'];

    $expedienteid = $this->Expediente->find('count', 
                               array('conditions'=> array('Expediente.expediente' => $idexpediente), 
                                     'recursive' => -1
    )); 

    return $expedienteid >= $limit;    
  }

 
   var $validate = array(
    	'num' => array(
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
	'title' => array(
		'notempty' => array(
			'rule' => array('notempty'),
			'message' => 'Faltó el título'
		)
	),
	'cbeventtype_id' => array(
		'notempty' => array(
				'rule' => array('notempty'),
				'message'=>'Faltó el Evento'
		),
	),
	'start' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
	)
   );

}
?>
