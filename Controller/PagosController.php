<?php
/**
 * Controller para crud de los involucrados.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
class PagosController extends AppController {
 public $helpers = array('Html', 'Form','Javascript', 'Ajax','EstadoCivil','Ocupaciones','Escolaridad');

 public function index() {
  $this->set('title_for_layout', 'Pagos - Consulta');
  $this->Pago->recursive = 1; 

  if ((isset($this->passedArgs['spago'])) || (isset($this->data['Pago']['spago']))){
   if ((isset($this->passedArgs['spago'])) && ($this->passedArgs['spago']!=NULL)) $palabra=$this->passedArgs['spago'];
   else $palabra=$this->data['Pago']['spago'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
		           'order'  => array('Pago.id' => 'asc'),
			   'conditions' => array('Pago.id LIKE '=> '%'.$palabra.'%'//,'Pago.ver' => '1'
   ));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1,
		           'order'  => array('Pago.id' => 'asc'));
  }

  $pago = $this->paginate('Pago');  
  if ($this->request->is('requested')) {return $pago;} else { $this->set(compact('pago')); }
 }


 public function view($id=null) {
  $this->set('title_for_layout', 'Clientes - Consulta');
  $this->Pago->id = $id;
  $this->Pago->recursive = 0;
  $cliente=$this->Pago->read();
  if (!$this->Pago->exists()) {
   $this->Session->setFlash('No se encontró el Pago "'.$id.'" en el Sistema');
   $this->redirect(array('action'=>'index'), null, true);
  }else{
   $this->Pago->Expediente->Juzgado->id=$cliente['Expediente']['globaljuzgado_id'];
   $this->Pago->Expediente->Juzgado->recursive = -1;
   $juzgado=$this->Pago->Expediente->Juzgado->field('organo_judicial');
   $this->set(compact('cliente','juzgado'));
  }
 }

 public function add() {
  $this->set('title_for_layout', 'Pago - Alta');
  if (!empty($this->data)):
   if ($this->Pago->save($this->data)) {
    $this->Session->setFlash('El Pago '.$this->data['Pago']['id'].' fue guardado correctamente.',"flash_add");
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar el pago.", "flash_error");
  endif;
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
  $globaljuzgados = $this->Pago->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => 0,						
						        'fields'=>$FiltroJuzgado));
  $this->set(compact('globaljuzgados','globalmunicipios','globalescolaridades','globalocupaciones'));
 }

 public function edit($id = null) {
  $this->Pago->id = $id;
  $this->Pago->recursive = -1;
  if (!$this->Pago->exists()) {
   $this->Session->setFlash('No se encontró el Pago "'.$id.'" en el Sistema','flash_error');
   $this->redirect(array('action'=>'index'), null, true);
  }else{
   $cbexpediente=$this->Pago->field('cbexpediente_id');
   $this->Pago->Expediente->id=$cbexpediente;
   $this->Pago->Expediente->recursive = -1;
   $cbexpediente2=$this->Pago->Expediente->field('expediente');

  $this->set('title_for_layout', 'Pago - Editar');
  if ($this->request->is('get')) {
    $this->request->data = $this->Pago->read();
    $juzid=substr($cbexpediente2,0,4);
    $anio=substr($cbexpediente2,-4,4);
    $exp=substr($cbexpediente2,-8,4);
    $this->request->data('Pago.globaljuzgado_id', $juzid);
    $this->request->data('Pago.cbexpediente_id',$exp);
    $this->request->data('Pago.anio', $anio);
   } else {
    if ($this->Pago->save($this->request->data)) {
     $this->Session->setFlash('El Pago "'.$id.'", se ha actualizado',"flash_add");
     $this->redirect(array('action' => 'view',$id));
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el Pago", "flash_error");
   }
  }

  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
  $globaljuzgados = $this->Pago->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,
						        'fields'=>$FiltroJuzgado
  ));
  $this->set(compact('globaljuzgados'));
 }

 public function status($id = null) {
  $this->Pago->id = $id;
  $this->Pago->recursive=-1;
  $existe=$this->Pago->findById($id);
  if ($existe['Pago']['ver']==0) $ever=1; else $ever=0;
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   $this->Pago->save($data);
   $this->Session->setFlash('Se ha modificadio el status',"flash_add");
   $this->redirect(array('action' => 'index'));
 }	
}
?>
