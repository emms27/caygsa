<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
class User extends AppModel {
 public $useTable = 'cbusers';	
 //public $virtualFields = array('nombre' => 'CONCAT(User.nombre, " ",User.apepat, " ",User.apemat)');
 //public $displayField = 'nombre';

 public $actsAs = array(
        'Acl' => array('type' => 'requester'),
 	'Logable',
        'MeioUpload' => array(
		'filename'=>array(
			'allowedMime' => array('image/jpeg', 'image/pjpeg'),
			'allowedExt' => array('.jpg', '.jpeg')
        )));

 public $belongsTo = array(  
   	'Personal' => array( 
        	'className'    => 'Personal',
		'foreignKey'    => 'globalemployee_id'
        ),
   	'Role' => array( 
        	'className'    => 'Role',
		'foreignKey'    => 'role_id'
        )
 );
 public $hasMany = array(
   	'Log' => array( 
		'className'    => 'Log',
		'foreignKey'   => 'cbuser_id'
	)/*,
   	'Contacteno' => array( 
		'className'    => 'Contacteno',
		'foreignKey'   => 'ddfmuser_id'
	)*/
 );

 public function parentNode() {
  if (!$this->id && empty($this->data)) return null;
  if (isset($this->data['User']['role_id'])) $groupId = $this->data['User']['role_id'];
  else $groupId = $this->field('role_id');
  if (!$groupId) return null;
  else return array('Role' => array('id' => $groupId));
 }

 function beforeSave(){
  $modelo='User';
  $campo='id';
  if ($this->data[$modelo][$campo]==NULL || $this->data[$modelo][$campo]==""){
   $this->data[$modelo]['password']=AuthComponent::password($this->data[$modelo]['password']);
   $this->data[$modelo]['username']=$this->data[$modelo]['globalemployee_id'];
   $this->data[$modelo]['fecha_registro']=date('Y-m-d h:i:s');
  }else{
   if ((isset($this->data['User']['passwordactual'])) && 
       (isset($this->data['User']['passwordnew'])) &&
       (isset($this->data['User']['confirmpassword']))) 
   	$this->data[$modelo]['password']= AuthComponent::password($this->data[$modelo]['passwordnew']);
  }
  return true;
 }


 function MatchPassword($data, $limit){
   $confpass = array_pop(array_values($data));
   $pass=$this->data['User']['passwordnew'];

   if ($pass==$confpass) return true;
   else return false;
 }

 function DuplicatesPass($data, $limit){
   $actualpass = array_pop(array_values($data));
   $actualpass=AuthComponent::password($actualpass);
   $userid=$this->data['User']['id'];
   $passexiste = $this->find('count', 
                             array('conditions'=> array('User.id'=>$userid,'User.password'=>$actualpass), 
                                   'recursive' => -1));
   return $passexiste >= $limit;    
  }

  function DuplicatesEmpleado($data, $limit){
    $expedienteid = $this->find('count', 
                                array('conditions'=> array('globalemployee_id' => $data['globalemployee_id']), 
                                      'recursive' => -1
                                     ) 
                               ); 
    return $limit > $expedienteid;    
   }

   function DuplicatesNoEmpleado($data, $limit){
    $expedienteid = $this->Personal->find('count', 
                                array('conditions'=> array('Personal.id' => $data['globalemployee_id']), 
                                      'recursive' => -1
                                     ) 
                               ); 
     return $limit == $expedienteid;    
   }

	
 public $validate = array(
 	'username' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó el nombre de usuario'
		)
         ),
	'globalemployee_id' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó la matrícula'
		),
                'pk_empleado' => array(            
                      	  'rule' => array('DuplicatesEmpleado',1),            
                          'message' => 'La matrícula ya fue dada de alta.'
                ),
                'fk_empleado' => array(            
                      	  'rule' => array('DuplicatesNoEmpleado',1),            
                          'message' => 'La matrícula no existe en el sistema.'
                )
         ),
	'role_id' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó el role'
		)
         ),
 	'password' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó el password'
		),
	       'minLenght-' => array(
			     'rule'    => array('minLength', 4),
       			     'message' => 'Password, mínimo 4 dígitos.'
	    )
         ),
 	'passwordactual' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó el password'
		),
        	'pk_pass' => array(            
			'rule' => array('DuplicatesPass',1),            
	                'message' => 'Password incorrecto'
        	)
         ),
 	'passwordnew' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó el nuevo password'
		)
         ),
 	'confirmpassword' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó confirmar el password nuevo'
		),
		'Match' => array(
        	        'rule' => array('MatchPassword',1),
			'message' => 'Repita la misma contraseña'
		),
         ),
        'filename' => array('Empty' => array('check' => false))
 );
     
}

?>
