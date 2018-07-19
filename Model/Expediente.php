<?php
/**
 * Modelo Expediente
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 **/
class Expediente extends AppModel {
 public $useTable = 'cbexpedientes';
 public $name = 'Expediente'; 
 // public $displayField = 'materia';
 public $order = "Expediente.expediente ASC";
 var $actsAs = array('Logable');

  //var $name = 'htsjpexpedientes';
  //public $primaryKey= 'num_expediente';
  //public $uses = array('AsignarFicha', 'Juzgado'); //para agregar un modelo que este asociado con el actual


  public $belongsTo = array(              //Modelo actual tiene la llave FK 
  	'Juzgado' => array( 
        	'className'    => 'Juzgado',
				  'foreignKey'   => 'globaljuzgado_id'
	),
	'Materia' => array( 
		'className'    => 'Materia', //'nombre de la clase a relacionar',
	        'foreignKey'   => 'globalmateria_id'//,
		//'conditions' => array('Materia.approved' => '1'),
	        //'order'      => 'Recipe.created DESC'
		//'fields'       => 'materia'   //campos a utilizar		 
	),
	'Cliente' => array( 
		'className'    => 'Cliente',
	        'foreignKey'   => 'cbcliente_id'
	),
	'TipoCredito' => array( 
		'className'    => 'TipoCredito',
	        'foreignKey'   => 'cbtipocredito_id'
	),
  );
 
  public $hasMany = array(        
	'Parte' => array(            
		'className'     => 'Parte',
		'foreignKey'    => 'cbexpediente_id'      
	),
	'Event' => array(            
		'className'     => 'FullCalendar.Event',
		'foreignKey'    => 'cbexpediente_id'      
	),
	'Pago' => array(            
		'className'     => 'Pago',
		'foreignKey'    => 'cbexpediente_id'      
	),
	'Stage' => array(            
		'className'     => 'Stage',
		'foreignKey'    => 'cbexpediente_id'      
	)
  );  
   

 function beforeValidate(){
 }
 
     
  function beforeSave(){
   $modelo="Expediente";
   $campo="id";
   $valor=date('Y');
   if ($this->data['Expediente']['id']=="" && $this->data['Expediente']['id']==NULL){
    /*  $this->data['Expediente']['expediente']=$this->data['Expediente']['globaljuzgado_id'].
                $this->data['Expediente']['num'].
                $this->data['Expediente']['anio'];
    */
    $this->data['Expediente']['id']=$this->IDNewExp($modelo,$campo,$valor);
    $this->data['Expediente']['fecha_registro']=date('Y-m-d h:i:s');
    $this->data['Expediente']['cbuser_id']="1";
   }else{
      $this->data['Expediente']['expediente']=$this->data['Expediente']['globaljuzgado_id'].
                $this->data['Expediente']['num'].
                $this->data['Expediente']['anio'];
    
   }
   return true;
  }
 
 function limitDuplicates($data, $limit){ 
  $idexpediente=$this->data['Expediente']['globaljuzgado_id'].$data['num'].$this->data['Expediente']['anio'];
  $id_count = $this->find('count',array('conditions' => array('Expediente.expediente'=>$idexpediente),'recursive' => -1));         

  if ($this->data['Expediente']['id']!="" && $this->data['Expediente']['id']!=NULL){ 
   $this->recursive=-1;
   $this->id = $this->data['Expediente']['id'];
   $expedienteid=$this->field('expediente');
   if ($idexpediente == $expedienteid) $id_count=0;
  }

  return $id_count < $limit;    
 }

     
  function limitInexistente($data, $limit){
   //$field = array_pop(array_keys($data)); //key
   $data = array_pop(array_values($data)); //valor      
   $expediente_count = $this->Expediente->find( 'count', array('conditions' => array('Expediente.id' => $data), 
                                                                'recursive' => -1) );        
   return $expediente_count > $limit;    
  }

  function JuzgadoConcepto($data, $limit){  
   $data = array_pop(array_values($data));
   $juzgado = $this->Juzgado->find('first',
		   		  array('conditions' => array('Juzgado.id' => $data), 
				        'recursive'  => -1, 
                         		'fields' => array('Juzgado.htsjpmateria_id')
                                       )
                                   );
   $idmateria=$juzgado['Juzgado']['htsjpmateria_id'];
   $idconcepto=$this->data['Ficha'][0]['htsjpconcepto_id'];

   if ($idmateria==11) $cconceptos=1;
   else{
    $cconceptos = $this->Ficha->Concepto->find('count',
	 				       array(
				                     'conditions' => array('Concepto.htsjpmateria_id'=> $idmateria,
						      		           'Concepto.id'=> $idconcepto
                                                      ),
					             'recursive'  => -1
     ));
   }

   return $cconceptos >= $limit;    
  }

  function JuzgadoCuenta($data, $limit){  
   $data = array_pop(array_values($data)); 
   $juzgado = $this->Juzgado->find('first',
		   		   array('conditions' => array('Juzgado.id' => $data), 
				         'recursive'  => -1, 
                         		 'fields' => array('Juzgado.htsjpmateria_id')
   ));

   $idmateria=$juzgado['Juzgado']['htsjpmateria_id'];
   $idcuenta=$this->data['Ficha'][0]['htsjpcuenta_id'];

    if ($idmateria==11){$ccuentas=1;}
    else{
     $ccuentas = $this->Ficha->Cuenta->find('count',
					    array(
				                  'conditions' => array('Cuenta.htsjpmateria_id'=> $idmateria,
								        'Cuenta.id'=> $idcuenta
                                                                        ),
					           'recursive'  => -1
     ));
    }

    return $ccuentas >= $limit;    
   }

   	
 public $validate = array(
 	'num' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el expediente'
                ),

	        'pk_expediente' => array(            	
	 		'rule' => array('limitDuplicates',1),            
			'message' => 'Este expediente ya existe'
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
   	'cbcliente_id' => array('rule' => 'notEmpty',
    			      'message' => 'Faltó el cliente'
    	),		
   	'globalmateria_id' => array('rule' => 'notEmpty',
    			      'message' => 'Faltó la materia'
    	),		
 	'globaljuzgado_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                       	'message' => 'Faltó el juzgado'
                )
         ),
	'globaltipojuicio_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                       	'message' => 'Seleccione un tipo de juicio'
                )
         ),
   'cuantia_juicio' => array(
 		  'Vacio' => array(
                        'rule' => 'notEmpty',
			'message' => 'Faltó la cuantía del juicio'
	          ),
		  'Dinero' => array(
            		'rule'    => array('decimal', 2),
            		'message' => 'Monto incorrecto.'
                  ),
		  'Money' => array(
	                           'rule' => array('comparison','>', 0),        
                            	   'message' => 'El monto debe ser mayor a 0.'
                  )
   ),
   'cbtipocredito_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                       	'message' => 'Seleccione un tipo de crédito'
                )
         ),
 	'tipo_gravament' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
                       	'message' => 'Faltó el tipo de gravament'
                )
         )
  );
	
}

?>
