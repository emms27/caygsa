<?php
/**
 * Controller para crud de los involucrados.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email2 carreon.emmanuel@gmail.com
 */
class EscolaridadesController extends AppController {
 public $helpers = array('Html', 'Form','Javascript', 'Ajax'
 	//,'Dates'
 );

 public function index() {
  $this->set('title_for_layout', 'Escolaridades - Consulta');
  $this->Escolaridade->recursive = 1; 

  $this->paginate = array('limit' => 50,
                          'page' =>1,
			  'recursive' =>-1,
		          'order'  => array('Escolaridade.escolaridad' => 'asc')//,
			  //'conditions' => array('Escolaridade.ver' => '1')
  );

  //$this->Involucrado->unbindModel(array('belongsTo' => array('Expediente','Estado')));
  $escolaridades = $this->paginate('Escolaridade');    
//debug($parte);
   if ($this->request->is('requested')) {return $escolaridades;} else { $this->set(compact('escolaridades')); }
 }


 public function add() {
  $this->set('title_for_layout', 'Cliente - Alta');
  if (!empty($this->data)):
   if ($this->Escolaridade->save($this->data)) {
    $this->Session->setFlash('El cliente '.$this->data['Escolaridade']['id'].' fue guardado correctamente.','flash_add');
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar la Escolaridad.", "flash_error");
  endif;
 }

 public function status($id = null) {
  $this->Escolaridade->id = $id;
  $this->Escolaridade->recursive=-1;
  $existe=$this->Escolaridade->findById($id);
  debug($existe);
  if ($existe['Escolaridade']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['Escolaridade']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpjuzgado_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Escolaridade']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   $this->Escolaridade->save($data);
   $this->Session->setFlash('Se ha modificadio el status',"flash_add");
   $this->redirect(array('action' => 'index'));
  }

	
}
?>
