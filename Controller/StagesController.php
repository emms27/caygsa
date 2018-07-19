<?php
/**
 * Controller para los Expedientes.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

/*App::uses('ExpedientesAppController', 'Expedientes.Controller');
class ExpedientesController extends ExpedientesAppController {
*/

class StagesController extends AppController {
 //se agregaron en el Helper
 public $helpers = array('Html',
			 'Form',
		         'Javascript',
			 'Ajax',
			 'Csv'//,
			// 'Crumb'
//			  'Identificacion',
//			  'EstadoCivil',
 );

// public $layout = 'ajax';

 public $components = array('RequestHandler');
  //var $beforeFilter = array('requireLogin'=>array('only'=>array('add','edit','delete')));
  //var $beforeFilter = array('requireLogin'=>array('except'=>array('index')));


 public function index() {
  $this->set('title_for_layout', 'Etapa - Consulta');
  $this->Stage->recursive = 0; 

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Stage']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Stage']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Expediente.expediente LIKE '=> '%'.$palabra.'%'));//,
			                         //'Expediente.ver' => '1'));

  }else $this->paginate = array('limit' => 50,'page' =>1);


  $etapa = $this->paginate('Stage');
  //debug($etapa);    
  if ($this->request->is('requested')) {return $etapa;} else { $this->set(compact('etapa'));}
  


//  $user = $this->Auth->user();
   //debug($this->params['form']);
   //debug($this->params['pass']);
   //debug($this->params['url']);
   //debug($this->params['data']['sorden']);
   //debug($this->data['OrdenPago']['sorden']);
   //debug($this->passedArgs['from']);

/*
  $this->Expediente->unbindModel(array('hasMany' => array('Ficha','Deposito','Involucrado','OrdenPago')));
  if ((isset($this->passedArgs['sexpediente'])) || (isset($this->data['Expediente']['sexpediente']))){
   if ((isset($this->passedArgs['sexpediente'])) && ($this->passedArgs['sexpediente']!=NULL))
    $palabra=$this->passedArgs['sexpediente'];
   else $palabra=$this->data['Expediente']['sexpediente'];
   if ($user['Group']['id']==3){
    $this->paginate = array('limit' => 100,
                            'page' =>1,
		            'order' => array('Expediente.fecha_registro' => 'desc'),
			    'conditions' => array('Expediente.id LIKE' => '%' .$palabra. '%',
						  'Expediente.id LIKE '=>$user['htsjpjuzgado_id'].'%'
                            ));
   }else{
    $this->paginate = array('limit' => 100,
                            'page' =>1,
		            'order' => array('Expediente.fecha_registro' => 'desc'),
			    'conditions' => array('Expediente.id LIKE' => '%' .$palabra. '%'));
   }
  }else{
   if ($user['Group']['id']==3){
    $this->paginate = array('limit' => 100,
                            'page' =>1,
		            'order' => array('Expediente.fecha_registro' => 'desc'),
			    'conditions'=>array('Expediente.id LIKE '=>$user['htsjpjuzgado_id'].'%'));
   }else{
    $this->paginate = array('limit' => 100,
                            'page' =>1,
		            'order' => array('Expediente.fecha_registro' => 'desc'));
   }
  }
*/
 }

 public function add() {
   $this->set('title_for_layout', 'Expediente - Alta');
/*
   if ((isset($this->data['Expediente']['htsjpjuzgado_id'])) && 
       (isset($this->data['Expediente']['num'])) &&
       (isset($this->data['Expediente']['anio']))):
    $idexp=$this->data['Expediente']['htsjpjuzgado_id'].
            $this->data['Expediente']['num'].
            $this->data['Expediente']['anio'];
    $idparte=$idexp.'0003';
   endif;
*/
  //debug($this->data);
   if (!empty($this->data)) { 
    //if ($this->Expediente->saveAll($this->data, array('validate'=>'first'))) {
    if ($this->Stage->save($this->data)) {
     //$factual=date('Y-m-d h:i:s');
  /*   $sparte = "insert into ddfmpartes (id,htsjpexpediente_id,nombre,apepat,apemat,htsjpestado_id,tusuario,tidentificacion,nidentificacion,fecha_registro) VALUES ('$idparte','$idexp','H. Tribunal','Superior de Justicia','del Estado de Puebla','21','Beneficiario','Credencial de Elector','0101010101010','$factual')";
     $this->Expediente->Involucrado->query($sparte);
*/
     $this->Session->setFlash('La etapa fue guardado correctamente.',"flash_add");
     $this->redirect(array('controller'=>'Stages','action' => 'index'));
//    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para dar de alta la ficha", "flash_error");
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para dar de alta la etapa","flash_error");
   }

  //JUZGADOS
   $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
   $globaljuzgados = $this->Stage->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,						
						        'fields'=>$FiltroJuzgado
   ));

  if (isset($this->data['Stage']['globaljuzgado_id']) && isset($this->data['Stage']['num']) && isset($this->data['Stage']['anio'])) {
   $expe=$this->data['Stage']['globaljuzgado_id'].
         $this->data['Stage']['num'].
         $this->data['Stage']['anio'];


   $ec=$this->Stage->Expediente->find('count',array('recursive' => -1,'conditions'=>array('expediente'=>$expe)));
   $ex=$this->Stage->Expediente->find('first',array('conditions'=>array('expediente'=>$expe),
					       'recursive'=>-1,
				               'fields' => array('id','expediente')));

   if ($ec>0){
    $countetapas = $this->Stage->find('count',array('recursive' => -1,
						   'conditions'=>array('cbexpediente_id'=>$ex['Expediente']['id'])));
    $countetapas++;
    $cbetapas = $this->Stage->Etapa->find('list',
						  array(
							'recursive' => -1,
                                                        'conditions'=>array('Etapa.id'=>$countetapas),
                                                        'fields'=>array('Etapa.id','Etapa.etapa')
    ));
   }else $cbetapas=NULL;
   } else $cbetapas=NULL;


   //$this->loadModel('TipoJuicio');

    $this->set(compact('globaljuzgados','cbetapas'));

/*  $user = $this->Auth->user();
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.descripcion');
  if ($user['Group']['id']==3){
   $htsjpjuzgados = $this->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => 0,						
						        'fields'=>$FiltroJuzgado,
                                                        'conditions'=>array('id'=>$user['htsjpjuzgado_id'])
   ));
  }else if ($user['Group']['id']==1 || $user['Group']['id']==4 ){
   $htsjpjuzgados = $this->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => 0,						
						        'fields'=>$FiltroJuzgado
   ));
  }

  if (isset($this->data['Expediente']['htsjpjuzgado_id'])) $juzgadoid=$this->data['Expediente']['htsjpjuzgado_id'];
  else $juzgadoid=NULL;

     //Juzgado SELECCIONADO
  $juzgado = $this->Expediente->Juzgado->find('first',
		   array('conditions' => array('Juzgado.id' => $juzgadoid), 
                                               'recursive'  => -1, 
                                               'fields' => array('Juzgado.htsjpmateria_id')));

  $this->set('idmateria', $juzgado['Juzgado']['htsjpmateria_id']); 

  if ($juzgado['Juzgado']['htsjpmateria_id']==11){
     $htsjpconceptos = $this->Expediente->Ficha->Concepto->find('list',
							   array('order'  => 'Concepto.conceptos ASC', 
                                                                 'fields' => array('Concepto.id',
                                                                                   'Concepto.id',
										   'Concepto.conceptos'
           									   ),
 		    'conditions' => array('Concepto.ver' => 1)));
  } else{
     //CONCEPTOS
     $htsjpconceptos = $this->Expediente->Ficha->Concepto->find('list',
							   array('order'  => 'Concepto.conceptos ASC', 
                                                                 'fields' => array('Concepto.id',
                                                                                   'Concepto.id',
										   'Concepto.conceptos'
           									   ),
 		    'conditions' => array('Concepto.htsjpmateria_id'=> $juzgado['Juzgado']['htsjpmateria_id'],
                                          'Concepto.ver' => 1)));
  }

  if (isset($this->data['Ficha'][0]['htsjpconcepto_id'])) $conceptoid=$this->data['Ficha'][0]['htsjpconcepto_id'];
  else $conceptoid=NULL;

  //Concepto SELECCIONADO
  $concepto = $this->Expediente->Ficha->Concepto->find('first',
                             array('conditions' => array('Concepto.id' => $conceptoid,
                                                         'Concepto.ver' => 1
                                                   ), 
                                                   'recursive'  => -1, 
 			                           'fields'     => 'Concepto.htsjpmateria_id'));


     //CUENTAS
  $htsjpcuentas = $this->Expediente->Ficha->Cuenta->find('list',
			array(
 		              'conditions' => array('Cuenta.htsjpmateria_id'=> $concepto['Concepto']['htsjpmateria_id'],
                                                    'Cuenta.ver' => 1)));
  $htsjpestados = $this->Expediente->Involucrado->Estado->find('list',
						  array('order' =>'Estado.id ASC', 
							'recursive' => 0,						
						        'fields'=>'Estado.entidad'
                                                      )   					   
  );

    $this->set(compact('htsjpjuzgados','htsjpconceptos','htsjpcuentas','htsjpestados'));

 

    $this->set('ip', $this->RequestHandler->getClientIp());
    //$userinfo = $this->Auth->user();
    //debug($userinfo);
    //$this->set('userid', $userinfo);
*/
	
   } 

 function edit($id = null) {
  $this->Stage->recursive=0;
  $this->Stage->unbindModel(array('belongsTo' => array('Expediente'))); 
  $expedientes=$this->Stage->findById($id);
  if ($expedientes['Stage']['fecha_terminacion']!=NULL && 
      $expedientes['Stage']['fecha_terminacion']!="" &&
      $expedientes['Stage']['fecha_terminacion']!="0000-00-00"){
      $this->Session->setFlash('La Etapa "'.$expedientes['Etapa']['etapa'].'", no se puede actualizar por que fue finalizada.',"flash_error");
      $this->redirect(array('action' => 'index'));

  }else {
   $this->set('title_for_layout', 'Expediente - Editar');
   //$this->Expediente->id = $id;
   //$this->Expediente->recursive=-1;
   //$personal=$this->User->findById($id);
   //debug($personal);
   if ($this->request->is('get')) $this->request->data =$expedientes;
   else {
    if ($this->Stage->save($this->request->data)) {
     $this->Session->setFlash('El expediente fue actualizado',"flash_add");
    //$this->redirect(array('action' => 'view',$id));
     $this->redirect(array('action' => 'index'));
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el Expediente", "flash_error");
   }
  }

  /*$user = $this->Auth->user();
  if ((($user['Group']['id']!=1) && ($id!=$user['id'])) || (!$id)){
   $this->Session->setFlash('No tiene permiso para editar al usuario "'.$id.'"');
   $this->redirect(array('action'=>'edit',$user['id']));
  }else{
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
    $this->Session->setFlash('Se actualiz&oacute; el User '.$id);
    $this->redirect(array('action' => 'view',$id));
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el User", "flash_error");
   }
 */

 }


 public function status($id = null) {
  $this->Stage->id = $id;
  $this->Stage->recursive=-1;
  $existe=$this->Stage->findById($id);
  debug($existe);
  if ($existe['Stage']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['Stage']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpjuzgado_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Stage']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   $this->Stage->save($data);
   $this->Session->setFlash('Se ha modificadio el status',"flash_add");
   $this->redirect(array('action' => 'index'));
  }


 public function view($id = null) { 
  $this->Stage->id = $id;
  if ((!$this->Stage->exists()) || (!$id)){
   $this->Session->setFlash('No se encontró el Stage "'.$id.'" en el Sistema');
   $this->redirect(array('action'=>'index'), null, true);
  }else{          
   $this->set('title_for_layout', 'Stage - Consulta Detalle');

   //$this->Stage->unbindModel(array('belongsTo' => array('Materia')));
   //$this->Stage->unbindModel(array('hasMany' => array('Stage')));
   $stage=$this->Stage->read();
   $this->Stage->Expediente->Juzgado->id=$stage['Expediente']['globaljuzgado_id'];
   $this->Stage->Expediente->Juzgado->recursive = -1;
   $cbexpediente['Juzgado']=$this->Stage->Expediente->Juzgado->field('organo_judicial');
   //debug($stage);
   $this->set(compact('stage','cbexpediente'));
   $this->render();
  }
 }

	  	
  function autoCompletado() {
   $user = $this->Auth->user();
   if ($user['Group']['id']==3){
     $expedientes= $this->Expediente->find('all', 
			array('recursive' => -1,
			      'conditions' => array(
						'Expediente.id LIKE '=> '%'.$this->request->query['term'].'%',
						'Expediente.id LIKE '=>$user['htsjpjuzgado_id'].'%'),
  			      'fields'=> 'Expediente.id'));
    }else {
     $expedientes= $this->Expediente->find('all', 
			array('recursive' => -1,
			      'conditions' => array('Expediente.id LIKE '=> '%'.$this->request->query['term'].'%'),
  			      'fields'=> 'Expediente.id'));
    }

   $this->set(compact('expedientes'));
   //debug($expedientes);
   $this->layout = 'ajax';
  }
	
  function getData($id = null) {
   $user = $this->Auth->user();
   $this->Expediente->id = $id;
   $this->Expediente->recursive = 0;
   if(!$this->Expediente->exists()) throw new NotFoundException(__('No existe el expediente'));
   else{
    if ($user['Group']['id']==3){
     $expediente=$this->Expediente->find('first',
				    array('conditions'=>array(
						'Expediente.id LIKE' => $id,
						'Expediente.id LIKE '=>$user['htsjpjuzgado_id'].'%')));
    }else $expediente=$this->Expediente->findById($id);
   }
   $this->Expediente->unbindModel(array('hasMany' => array('Ficha','Deposito','Involucrado','OrdenPago')));
   $this->set(compact('expediente'));
   //debug($expediente);
   $this->layout = 'ajax';
  }
	
}
?>
