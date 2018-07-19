<?php
class MunicipiosController extends AppController {
	                                     //se agregaron en el Helper
 public $helpers = array('Html', 'Form','Javascript', 'Ajax');
    //public $components = array('Session');
	//public $scaffold; Genera el CRUD


 public function index() {
  $this->set('title_for_layout', 'Municipio - Consulta');
  $this->Municipio->recursive = 0; 

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Municipio']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Municipio']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Municipio.municipio LIKE '=> '%'.$palabra.'%'));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1
   ); 
  } 

  $municipios = $this->paginate('Municipio');
  //debug($municipios);    
  if ($this->request->is('requested')) {return $municipios;} else { $this->set(compact('municipios')); }
 }



 public function add() {
  $this->set('title_for_layout', 'Cliente - Alta');
  if (!empty($this->data)):
   if ($this->Municipio->save($this->data)) {
    $this->Session->setFlash('El Municipio "'.$this->data['Municipio']['municipio'].'" fue guardado correctamente.',"flash_add");
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar el Municipio.", "flash_error");
  endif;

  $globalestados = $this->Municipio->Estado->find('list',array('recursive' => -1));
  //$globalmaterias = $this->Municipio->Materia->find('list',array('recursive' => -1,'conditions' => array('Materia.ver' => 1,'Materia.Municipio' => 1)));

  $this->set(compact('globalestados'));
 }

 public function status($id = null) {
  $this->Municipio->id = $id;
  $this->Municipio->recursive=-1;
  $existe=$this->Municipio->findById($id);
  //debug($existe);
  if ($existe['Municipio']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['Municipio']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpMunicipio_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Municipio']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   debug($data);
   //$this->Municipio->save($data);

   if ($this->Municipio->saveField('ver',$ever,array('validate' => 'only')))
    $this->Session->setFlash('Se ha modificadio el status',"flash_add");

   $this->redirect(array('action' => 'index'));
  }

}
?>
