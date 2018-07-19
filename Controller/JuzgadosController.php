<?php
class JuzgadosController extends AppController {
	                                     //se agregaron en el Helper
 public $helpers = array('Html', 'Form','Javascript', 'Ajax');
    //public $components = array('Session');
	//public $scaffold; Genera el CRUD


 public function index() {
  $this->set('title_for_layout', 'Juzgado - Consulta');
  $this->Juzgado->recursive = 0; 

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Juzgado']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Juzgado']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Juzgado.organo_judicial LIKE '=> '%'.$palabra.'%'));

  }else $this->paginate = array('limit' => 50,'page' =>1);

  $juzgados = $this->paginate('Juzgado');  
  //debug($juzgados);  
  if ($this->request->is('requested')) {return $juzgados;} else { $this->set(compact('juzgados')); }
 }



 public function add() {
  $this->set('title_for_layout', 'Juzgado - Alta');
  if (!empty($this->data)):
   if ($this->Juzgado->save($this->data)) {
    $this->Session->setFlash('La Ocupación '.$this->data['Juzgado']['id'].' fue guardada correctamente.',"flash_add");
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar la Ocupación.", "flash_error");
  endif;

  $globalmunicipios = $this->Juzgado->Municipio->find('list',array('recursive' => -1));
  $globalmaterias = $this->Juzgado->Materia->find('list',array('recursive' => -1,'conditions' => array('Materia.ver' => 1,'Materia.juzgado' => 1)));

  $this->set(compact('globalmunicipios','globalmaterias'));
 }

 public function edit($id = null) {
  $this->Juzgado->id = $id;
  $this->Juzgado->recursive = -1;
  $involucrado=$this->Juzgado->find('first',
					  array('conditions'=>array('id'=>$id),
						'recursive'=>-1/*,
	 				        'fields'=>array('id',
					  		  'nombre',
							  'apepat',
							  'apemat',
							  'edad',
							  'sexo',
							  'estadocivil',
							  'escolaridad',
							  'ocupacion',
							  'tidentificacion',
							  'nidentificacion',
							  'htsjpestado_id',
							  'email')*/));
  $juzid=substr($involucrado['Juzgado']['id'],0,4); 

  $this->set('title_for_layout', 'Juzgado - Editar');
  if ($this->request->is('get')){
   $this->request->data = $involucrado;
   $this->request->data('Juzgado.globalmunicipio_id',$involucrado['Juzgado']['globalmunicipio_id']);
   $this->request->data('Juzgado.globalmateria_id',$involucrado['Juzgado']['globalmateria_id']);
  } else {
   if ($this->Juzgado->save($this->request->data)) {
    $this->Session->setFlash('El Juzgado "'.$id.'", se ha actualizado',"flash_add");
    $this->redirect(array('action' => 'view',$id));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el Juzgado", "flash_error");
  }

  $globalmunicipios = $this->Juzgado->Municipio->find('list',array('recursive' => -1));
  $globalmaterias = $this->Juzgado->Materia->find('list',array('recursive' => -1,'conditions' => array('Materia.ver' => 1,'Materia.juzgado' => 1)));

   $this->set(compact('globalmunicipios','globalmaterias'));

 }

 public function status($id = null) {
  $this->Juzgado->id = $id;
  $this->Juzgado->recursive=-1;
  $existe=$this->Juzgado->findById($id);
  //debug($existe);
  if ($existe['Juzgado']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['Juzgado']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpjuzgado_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Juzgado']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   debug($data);
   //$this->Juzgado->save($data);

   if ($this->Juzgado->saveField('ver',$ever,array('validate' => 'only')))
    $this->Session->setFlash('Se ha modificadio el status',"flash_add");

   $this->redirect(array('action' => 'index'));
  }

}
?>
