<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

 class UsersController extends AppController {
  //public $layout = 'login';
  public $helpers = array('Html', 'Form','Javascript', 'Ajax');

 function beforeFilter() {
  parent::beforeFilter();
  $this->Auth->allow('login','logout');
 } 

/*
 function afterLogin() {
  App::uses('String', 'Utility');
  //$message = $this->User->find('new_message');

  $text = 'This is the song that never ends.';
  $result = String::wrap($text, 22);
  if (!empty($message)) {
            // notify user of new message
   $this->Session->setFlash(__('You have a new message: %s', String::truncate($message['Message']['body'], 255, array('html' => true))));
  }
  //$this->Session->setFlash(__('You have a new message: %s', $result));
  $this->Session->setFlash("asfasdfw2rwerwerwer");
 }
*/

 function login() {
   $this->layout = 'login';
   $this->set('title_for_layout', 'Iniciar Sesión');
   if ($this->request->is('post')) {
    if ($this->Auth->login()){ 
       $this->User->id = $this->Auth->user('id');
       $this->registrarActividad('se ha logueado');
       $this->User->saveField('fecha_update', date('Y-m-d H:i:s') );
       return $this->redirect($this->Auth->redirect());
    }
    else $this->Session->setFlash("Usuario o password incorrectos");
   }
 }

 function logout() {
   //$this->layout = 'login';
   $this->registrarActividad('se fue del sistema');
   $this->Session->setFlash('¡Regresa Pronto!');
   $this->redirect($this->Auth->logout());
 }

 public function index() {
  $this->set('title_for_layout', 'User - Consulta');
  if ((isset($this->passedArgs['suser'])) || (isset($this->data['User']['suser']))){
   if ((isset($this->passedArgs['suser'])) && ($this->passedArgs['suser']!=NULL)) $palabra=$this->passedArgs['suser'];
   else $palabra=$this->data['User']['suser'];

     $this->paginate = array('limit' => 50,
                            'page'  => 1,
			    'recursive'=>0,
		            'order' => array('User.id' => 'desc'),
 			    'conditions' => array('Personal.nombre LIKE '=> '%'.$palabra.'%'));

  }else{
    $this->paginate = array('limit' => 50,
                            'page'  => 1,
			    'recursive'=>0,
		            'order' => array('User.id' => 'desc'));

  }
  $user= $this->paginate('User');    
  //debug($user);
  if ($this->request->is('requested')) {return $user;} else {$this->set(compact('user'));}
 }

 function view($id=null) {
  $this->User->id=$id;
  $user = $this->Auth->user();
  //if ((!$id) || (!$this->User->exists())){
  if ((($user['Role']['id']!=1) && ($id!=$user['id'])) || (!$id)){
   $this->Session->setFlash('No tiene permiso para visualizar al usuario "'.$id.'"','flash_error');
   $this->redirect(array('action'=>'edit',$user['id']));
  }else{
   $this->set('title_for_layout', 'User - Consulta');

   $this->User->Personal->recursive=1;
   $this->User->Personal->unbindModel(array('hasOne' => array('User')));
   $personal=$this->User->Personal->findById($this->User->field('globalemployee_id'));
   $this->User->Personal->Adscripcion->Location->recursive=-1;
   $location=$this->User->Personal->Adscripcion->Location->findById($personal['Adscripcion']['globallocation_id']);

    
   //debug($personal);
   $this->set(compact('location','personal'));

  }
 }

 public function add() {
  $this->set('title_for_layout', 'User - add');
  if (!empty($this->data)):
   if ($this->User->save($this->data)) {
    $this->Session->setFlash('EL usuario fue guardado correctamente.', "flash_add");
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar la parte.", "flash_error");
  endif;


 //$user = $this->Auth->user();
 
  $roles = $this->User->Role->find('list',array('order' =>'id ASC','recursive' =>-1));

  $this->set(compact('personal','roles'));
 }

 public function edit($id = null) {
   //$this->set('title_for_layout', 'User - Editar');
  $this->User->id=$id;
  $this->User->recursive=-1;
  $foto=$this->User->field('filename');
  $update=$this->User->field('fecha_update');
  $this->User->Personal->recursive=-1;
  $personal=$this->User->Personal->findById($this->User->field('globalemployee_id'));
  $this->set(compact('foto','update','personal'));

  if (!$this->User->exists()) {
   $this->Session->setFlash('No se encontró el User "'.$id.'" en el Sistema','flash_error');
   $this->redirect(array('action'=>'index'), null, true);
  }else{
   $this->set('title_for_layout', 'User - Editar');
   if ($this->request->is('get')) {
    $this->request->data = $this->User->read();
   } else {
    if ($this->User->save($this->request->data)) {
     $this->Session->setFlash('El User "'.$id.'", se ha actualizado',"flash_add");
     $this->redirect(array('action' => 'view',$id));
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el User", "flash_error");
   }
  }
 }

/*
 function ActionProhibida()
 {
    $aro = new Aro();
    //Aquí tenemos la información de nuestros grupos en un array sobre el cual iteraremos luego
    $groups = array(
         14 => array(
	    'parent_id'=>'3', //juzgado o grupo
	    'model'=>'User',
	    'foreign_key'=>'14', //User
            'alias' => 'mediacion'
        ),
         1 => array(
	    'parent_id'=>'3',
	    'model'=>'User',
	    'foreign_key'=>'9',
            'alias' => 'juzgados'
        ),
         2 => array(
	    'parent_id'=>'3',
	    'model'=>'User',
	    'foreign_key'=>'10',
            'alias' => 'juzgados'
        ),
         3 => array(
	    'parent_id'=>'3',
	    'model'=>'User',
	    'foreign_key'=>'11',
            'alias' => 'juzgados'
        ),
         4 => array(
	    'parent_id'=>'3',
	    'model'=>'User',
	    'foreign_key'=>'12',
            'alias' => 'juzgados'
        ),
         5 => array(
	    'parent_id'=>'3',
	    'model'=>'User',
	    'foreign_key'=>'13',
            'alias' => 'juzgados'
        )
    );

    //Iterar para crear los ARO de los grupos
    foreach($groups as $data)
    {
        //Recuerda llamar a create() cuando estés guardando información dentro de bucles...
        $aro->create();

        //Guardar datos
        $aro->save($data);
    }
    //Aquí va otra lógica de la acción...
 }
*/

 function permisos($id = null) {
  $this->User->id=$id;
  $user = $this->Auth->user();
  if ((!$id) || (!$this->User->exists())){
   $this->Session->setFlash('El Usuario "'.$id.'", no se encontró en el Sistema','flash_error');
   $this->redirect(array('action'=>'index'));
  }
  $this->set('title_for_layout', 'User - Editar');
  $this->User->id = $id;
  $this->User->recursive=0;
  $personal=$this->User->findById($id);
  //debug($personal);
  if ($this->request->is('get')) {
   $this->User->recursive=-1;
   $this->request->data = $this->User->findById($id);
   //debug($this->request->data);
  } else {
   if ($this->User->save($this->request->data)) {
    $this->Session->setFlash('Se actualiz&oacute; el Usuario "'.$id.'"','flash_add');
    $this->redirect(array('action' => 'view',$id));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el User", "flash_error");
  }

  //$user = $this->Auth->user();
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.descripcion');
  $htsjpjuzgados = $this->User->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,						
						        'fields'=>$FiltroJuzgado,
    //                                                    'conditions'=>array('id'=>$user['htsjpjuzgado_id'])
   ));
  $ddfmgroups = $this->User->Group->find('list',array('order' =>'Group.id ASC','recursive' =>-1));

  $this->set(compact('personal','htsjpjuzgados','ddfmgroups'));
 }

 function registrarActividad($message){ 
       if ($usuario = $this->Auth->user()) {
          $message = $usuario['username'].' (id: '.$usuario['id'].') '.$message;
          parent::log($message, 'miLog');
       } 
 }

}
?>
