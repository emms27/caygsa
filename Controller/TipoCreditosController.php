<?php
class TipoCreditosController extends AppController {
	                                     //se agregaron en el Helper
 public $helpers = array('Html', 'Form','Javascript', 'Ajax');
    //public $components = array('Session');
	//public $scaffold; Genera el CRUD


 public function index() {
  $this->set('title_for_layout', 'Tipo de Crédito - Consulta');
  $this->TipoCredito->recursive = 0; 

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['TipoCredito']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['TipoCredito']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('TipoCredito.tipo LIKE '=> '%'.$palabra.'%'));

  }else $this->paginate = array('limit' => 50,'page' =>1);

  $juzgados = $this->paginate('TipoCredito');  
  //debug($juzgados);  
  if ($this->request->is('requested')) {return $juzgados;} else { $this->set(compact('juzgados')); }
 }



 public function add() {
  $this->set('title_for_layout', 'Cliente - Alta');
  if (!empty($this->data)):
   if ($this->TipoCredito->save($this->data)) {
    $this->Session->setFlash('La Ocupación '.$this->data['TipoCredito']['id'].' fue guardada correctamente.',"flash_add");
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar el tipo de Crédito.", "flash_error");
  endif;
 }

 public function status($id = null) {
  $this->TipoCredito->id = $id;
  $this->TipoCredito->recursive=-1;
  $existe=$this->TipoCredito->findById($id);
  //debug($existe);
  if ($existe['TipoCredito']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['TipoCredito']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpjuzgado_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Juzgado']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   //debug($data);
   //$this->Juzgado->save($data);

   if ($this->TipoCredito->saveField('ver',$ever,array('validate' => 'only')))
    $this->Session->setFlash('Se ha modificadio el status',"flash_add");

   $this->redirect(array('action' => 'index'));
  }

}
?>
