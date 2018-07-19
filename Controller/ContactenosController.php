<?php
class ContactenosController extends AppController {
	                                   
 public $helpers = array('Html','Form','Javascript','Ajax','Dates');
 public $components = array('Session');

/* function beforeFilter() {
  parent::beforeFilter();
  $this->Auth->allow('mensaje','view','notificacion');
 }
*/ 

/* public function index() {
   $this->set('title_for_layout', 'Contacto - Consulta');
   $this->Contacteno->recursive=-1; 
   // Para el funcionamiento del llamado asíncrono
   if ($this->request->is('requested')) {
    $this->paginate = array(
			    'limit' => 20,
			    'fields' => array('Contacteno.id','Contacteno.asunto'),
		            'order' => array('Contacteno.fecha_registro' => 'desc'),
			    'conditions' => array('Contacteno.estado !='=>'Leído','Contacteno.ver'=>'1'));
    $peticiones = $this->paginate('Contacteno');    
    return  $peticiones;
   } else {
    $this->paginate = array('conditions' => array('Contacteno.estado !='=>'Inactivo','Contacteno.ver'=>'1'));
    $peticiones = $this->paginate('Contacteno');    
    $this->set(compact('peticiones'));
   }
 }
*/

 public function view($id=null) {
  $this->Contacteno->id = $id;
  $this->Contacteno->bindModel(array(
	'belongsTo' => array(
		'User' => array(
	            'className'    => 'User',
		    'foreignKey' => 'ddfmuser2_id'
		 )
         )
  ));
  $involucrado=$this->Contacteno->read(null, $id);
  $this->Contacteno->User->Personal->recursive=-1;
  $personal=$this->Contacteno->User->Personal->findById($involucrado['User']['htsjpemployee_id']);
  if ((!$this->Contacteno->exists()) || (!$id)){
     $this->Session->setFlash('No se encontró el mensaje "'.$id.'" en el Sistema');
     $this->redirect(array('action'=>'index'), null, true);
  }else{
   $this->set('title_for_layout', 'Contacto - Detalle');
   $this->Contacteno->saveField('estado','Leído');
   $this->set(compact('involucrado','personal'));
  }
 }


 public function messages() {
  if (!empty($this->data)){ //$this->request->is('ficha')) {
   if ($this->Contacteno->save($this->data)) { 
    //$this->Contacteno->User->Personal->unbindModel(array('belongsTo' => array('Adscripcion')));
    $emisor=$this->Contacteno->User->Personal->find('first',
				   array('recursive'=>0,
					 'conditions'=>array('User.id'=>$this->data['Contacteno']['ddfmuser2_id'])
    ));
    $receptor=$this->Contacteno->User->Personal->find('first',
				   array('recursive'=>0,
					 'conditions'=>array('User.id'=>$this->data['Contacteno']['ddfmuser_id'])
    ));

    //debug($emisor);
    $destinatario=$receptor['Personal']['email'];
    $nombre=$emisor['Personal']['namefull'];
    $email=$emisor['Personal']['email'];
    $asunto=$this->data['Contacteno']['asunto'];
    $mensaje=nl2br($this->data['Contacteno']['mensaje']);
    $ip = $_SERVER['REMOTE_ADDR'];
    $body="<font face=Verdana><div align=left>  A quien corresponda: </div> <br><br> <div align=justify>"."Este mensaje, fue escrito y enviado de forma autom&aacute;tica, desde la secci&oacute;n de contacto del sistema 'CAYGSA' del Corportativo Yañez. Favor de atender y canalizar este mensaje con el &aacute;rea correspondiente para su pronta respuesta.</div><br><br><FIELDSET><LEGEND> Datos del usuario </LEGEND><b> Nombre: </b>".$nombre."<br><b>E-mail:</b> ".$email."<br><br><br> </FIELDSET> <FIELDSET><LEGEND> Mensaje </LEGEND> <br><b>Tema:</b> ".$asunto."<br><b>Comentario:</b> ".$mensaje."<br><br>IP:".$ip."</FIELDSET></font><br><HR><br><FIELDSET><br><p><small><div align=justify><em><font color=gray>"."La informaci&oacute;n transmitida en el presente mensaje tiene la intenci&oacute;n de estar dirigida &uacute;nicamente a la persona o entidad que se refiere y puede contener informaci&oacute;n privilegiada y/o confidencial. Cualquier revisi&oacute;n, retransmisi&oacute;n, diseminaci&oacute;n o cualquier uso impropio o relacionado con dicha informaci&oacute;n por persona alguna distinta a la que fue dirigido este mensaje queda estrictamente prohibida. Si Usted ha recibido este mensaje o sus anexos por error, favor de contactar al remitente y elimine el material de cualquier computadora."."</font></em></div></small></p> <p> <div align=center><small>Copyright © 2014 CAYGSA.</div></p></small></FIELDSET>";

    App::uses('CakeEmail', 'Network/Email');
    $email = new CakeEmail();
    $email->config('ct');
    $email->from(array('me@gmail.com' => 'Sistema SIDFM'));
    $email->to(array('carreon.emmanuel@gmail.com',$destinatario));
    $email->emailFormat('html');
    $email->subject('Contacto SIDFM');
    $email->send($body);
    $this->Session->setFlash('Se envió su comentario, sugerencia o petición correctamente');
    $this->redirect(array('action' => 'messages'));
   }else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para su comentario, sugerencia o petición", "flash_error");
  }
/*
  $conditions="";
  echo $user = $this->Auth->user();
  switch($user['Group']['id']){
   case 1:
   case 5:$conditions=array('User.ddfmgroup_id !='=>$user['Group']['id']);
   	  break;
   case 2:
   case 3:
   case 4:
   case 6:
   case 7:
 	  $conditions=array(
  			    'OR' => array(
					'User.ddfmgroup_id'=>1,
				        'User.ddfmgroup_id ='=>5
			     ),
			    'User.ddfmgroup_id !='=>$user['Group']['id']);
    	  break;
  }
*/


   $ddfmusers=$this->Contacteno->User->Personal->find('list',
				   array('recursive'=>2,
//					 'conditions'=>$conditions,
					 'order' =>'Personal.namefull ASC', 
					 'fields'=>array('User.id','Personal.namefull')
   ));
   $this->set(compact('ddfmusers'));     

 } 

 public function notificacion() {
  $user = $this->Auth->user();
  $FieldOrden = array('Contacteno.id',
		      'Contacteno.fecha_registro',
		      'Contacteno.estado',
		      'Contacteno.ddfmuser2_id',
		      'Contacteno.asunto',
		      'Contacteno.ddfmuser_id');
  
  $this->Contacteno->bindModel(array(
	'belongsTo' => array(
		'User' => array(
	            'className'    => 'User',
		    'foreignKey' => 'ddfmuser2_id'
		 )
         )
  ));
  $this->Contacteno->User->unbindModel(array('belongsTo' => array('Group','Juzgado','Log')));
  $this->Contacteno->User->unbindModel(array('hasMany' => array('Log')));
  $this->Contacteno->recursive=2; 
  $this->paginate = array('limit'=>50,
                           'fields'=>$FieldOrden,
		           'order' => array('Contacteno.fecha_registro' => 'desc'),
			   'conditions' =>array('Contacteno.estado' => 'Enviado',
					        'Contacteno.ddfmuser_id' =>  $user['id']));
  $mensajes = $this->paginate('Contacteno');
  if ($this->request->is('requested')) {return $mensajes;} else { $this->set(compact('mensajes'));}
 }

}
?>
