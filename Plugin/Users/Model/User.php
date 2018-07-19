<?php
/**
 * Model
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
App::uses('UsersAppModel', 'Users.Model');

class User extends UsersAppModel {
 public $useTable = 'cbusers';	
 //public $name = 'ddfmusers';
 //public $virtualFields = array('nombre' => 'CONCAT(User.nombre, " ",User.apepat, " ",User.apemat)');
 //public $displayField = 'nombre';

 public $actsAs = array(
        'Acl' => array('type' => 'requester'),
 	//'Logable',
        //'MeioUpload' => array('filename')
 );

/* public $belongsTo = array(  
   	'Personal' => array( 
        	'className'    => 'Personal',
		'foreignKey'    => 'cbemployee_id'
        ),
   	'Group' => array( 
        	'className'    => 'Group',
		'foreignKey'    => 'cbgroup_id'
        )
 );
*/
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
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['cbgroup_id'])) {
            $groupId = $this->data['User']['cbgroup_id'];
        } else {
            $groupId = $this->field('cbgroup_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
 }



 function beforeSave(){
    $modelo='User';
    $campo='id';
 
   if ((isset($this->data['User']['passwordactual'])) && 
       (isset($this->data['User']['passwordnew'])) &&
       (isset($this->data['User']['confirmpassword']))) 
   	$this->data[$modelo]['password']= AuthComponent::password($this->data[$modelo]['passwordnew']);

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

	
 public $validate = array(
 	'username' => array(
		'Vacio' => array(
            		'rule' => 'notEmpty',
			'message' => 'Faltó el nombre de usuario'
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
         )      
 );
     
}

?>
