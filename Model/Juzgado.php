<?php
/**
 * Modelo Expediente
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 **/
class Juzgado extends AppModel {
 public $useTable = 'globaljuzgados'; //tabla que exista en la base de datos
 public $name = 'Juzgados';
 public $displayField = 'organo_judicial';
 public $order = "Juzgado.organo_judicial ASC";
 var $actsAs = array('Logable');
   //public $primaryKey= 'id_juzgado';
/*   
   public $hasOne = array(        
   	'User' => array( 
        	'className'    => 'User',
		'foreignKey'    => 'htsjpjuzgado_id'
        )
   );  
*/

 public $belongsTo = array(           
             'Municipio' => array(            
			'className'     => 'Municipio',
			'foreignKey'    => 'globalmunicipio_id'
              ),
             'Materia' => array(            
			'className'     => 'Materia',
			'foreignKey'    => 'globalmateria_id'//, 
//		        'conditions' => array('Materia.ver' => 1,'Materia.juzgado' => 1)    
              )    
 ); 
   

   public $hasMany = array(        
	     /*'AsignarFichas' => array(            
				'className'     => 'AsignarFicha',
				'foreignKey'    => 'juzgado_clave',      
				                 ),    
             */
             'Expediente' => array(            
				'className'     => 'Expediente',
				'foreignKey'    => 'globaljuzgado_id',      
				                 )    
			           );  

 function beforeSave(){
  $modelo="Juzgado";
  $campo="id";
  if ($this->data[$modelo]['num']!="" && $this->data[$modelo]['num']!=NULL){
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
   $this->data[$modelo][$campo]=$this->data[$modelo]['num'];
  }
 }

 function limitDuplicates($data, $limit){  
   $idcount = $this->find('count',array('conditions' => array('Juzgado.id'=>$data['num']),'recursive' => -1));         
   debug($idcount);
   return $idcount < $limit;    
 }
   
 public $validate = array(
 	'num' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó la clave del juzgado'
                ),

	        'pk_expediente' => array(            	
	 		'rule' => array('limitDuplicates',1),            
			'message' => 'Esta clave ya existe'
		),

	       'minLenght-' => array(
	       		'rule'    => array('minLength', 4),
		        'message' => 'La Clave debe tener 4 dígitos. 0001'
		),
	       'maxLenght-' => array(
		        'rule'    => array('maxLength', 4),
		        'message' => 'La Clave debe tener 4 dígitos. 0001'
	        ),
	       'numerico' => array(
			'rule' => 'numeric',          
			'message' => 'La Clave debe ser numerico'    
	        ),
	       'number' => array(
		        'rule'    => array('range', 0, 10000),
		        'message' => 'Un numero entre 1 al 9999'
                )
        ),
	'globalmunicipio_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el municipio'
		)
        ),
	'globalmateria_id' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó la materia'
    		)
        ),
	'organo_judicial' => array(
        	'Vacio' => array(
                	'rule' => 'notEmpty',
			'message' => 'Faltó el juzgado'
		)
        ),
 );   
	
}


?>
