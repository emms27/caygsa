<?php
/**
 * Controller para crud de los involucrados.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email2 carreon.emmanuel@gmail.com
 */
class MateriasController extends AppController {
 public $helpers = array('Html', 'Form','Javascript', 'Ajax'
 	//,'Dates'
 );


 public function index() {
  $this->set('title_for_layout', 'Materias - Consulta');
  $this->Materia->recursive = -1; 

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Materia']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Materia']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Materia.descripcion LIKE '=> '%'.$palabra.'%'));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'recursive' =>-1
   ); 
  } 


  //$this->Involucrado->unbindModel(array('belongsTo' => array('Expediente','Estado')));
  $materias = $this->paginate('Materia');    
//debug($parte);
   if ($this->request->is('requested')) {return $materias;} else { $this->set(compact('materias')); }
 }


 public function add() {
  $this->set('title_for_layout', 'Materia - Alta');
  if (!empty($this->data)):
   if ($this->Materia->save($this->data)) {
    $this->Session->setFlash('La materia '.$this->data['Materia']['id'].' fue guardada correctamente.');
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar la Materia.", "flash_error");
  endif;
 }

 public function status($id = null) {
  $this->Materia->id = $id;
  $this->Materia->recursive=-1;
  $existe=$this->Materia->findById($id);
  //debug($existe);
  if ($existe['Materia']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['Materia']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpjuzgado_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Materia']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   $this->Materia->save($data);
   $this->Session->setFlash('Se ha modificadio el status',"flash_add");
   $this->redirect(array('action' => 'index'));
 }

 public function asunto($id = null) {
  $this->Materia->id = $id;
  $this->Materia->recursive=-1;
  $existe=$this->Materia->findById($id);
  //debug($existe);
  if ($existe['Materia']['asunto']==0) $ever=1; else $ever=0;
  $data = array('id' => $id, 'asunto' => $ever);//,'estado' => 'Cancelada');
  $this->Materia->save($data);
  $this->Session->setFlash('Se ha modificadio el asunto',"flash_add");
  $this->redirect(array('action' => 'index'));
 }

 public function juicio($id = null) {
  $this->Materia->id = $id;
  $this->Materia->recursive=-1;
  $existe=$this->Materia->findById($id);
  //debug($existe);
  if ($existe['Materia']['juicio']==0) $ever=1; else $ever=0;
  $data = array('id' => $id, 'juicio' => $ever);//,'estado' => 'Cancelada');
  $this->Materia->save($data);
  $this->Session->setFlash('Se ha modificadio el juicio',"flash_add");
  $this->redirect(array('action' => 'index'));
 }

 public function juzgado($id = null) {
  $this->Materia->id = $id;
  $this->Materia->recursive=-1;
  $existe=$this->Materia->findById($id);
  //debug($existe);
  if ($existe['Materia']['juzgado']==0) $ever=1; else $ever=0;
  $data = array('id' => $id, 'juzgado' => $ever);//,'estado' => 'Cancelada');
  $this->Materia->save($data);
  $this->Session->setFlash('Se ha modificadio el juzgado',"flash_add");
  $this->redirect(array('action' => 'index'));
 }

	
}
?>
