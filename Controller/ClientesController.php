<?php
/**
 * Controller para crud de los involucrados.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */
class ClientesController extends AppController {
 public $helpers = array('Html','Dates', 'Form','Javascript', 'Ajax','EstadoCivil','Ocupaciones','Escolaridad');

 public function index() {
  $this->set('title_for_layout', 'Clientes - Consulta');
  $this->Cliente->recursive = 1; 

  if ((isset($this->passedArgs['scliente'])) || (isset($this->data['Cliente']['scliente']))){
   if ((isset($this->passedArgs['scliente'])) && ($this->passedArgs['scliente']!=NULL)) $palabra=$this->passedArgs['scliente'];
   else $palabra=$this->data['Cliente']['scliente'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
		           'order'  => array('Cliente.namefull' => 'asc'),
			   'conditions' => array('Cliente.namefull LIKE '=> '%'.$palabra.'%',
			                         'Cliente.ver' => '1'));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1,
		 	   'recursive' =>-1,
		           'order'  => array('Cliente.namefull' => 'asc'),
		 	   'conditions' => array('Cliente.ver' => '1'));
  }

  $cliente = $this->paginate('Cliente');    
  if ($this->request->is('requested')) {return $cliente;} else { $this->set(compact('cliente')); }
 }

 public function view($id=null) {
  $this->set('title_for_layout', 'Clientes - Consulta');
  $this->Cliente->id = $id;
  $this->Cliente->recursive = -1;
  $cliente=$this->Cliente->read();
  if (!$this->Cliente->exists()) {
   $this->Session->setFlash('No se encontró el Cliente "'.$id.'" en el Sistema','flash_error');
   $this->redirect(array('action'=>'index'), null, true);
  }
  $this->set(compact('cliente'));
 }

 public function add() {
  $this->set('title_for_layout', 'Cliente - Alta');
  if (!empty($this->data)):
   if ($this->Cliente->save($this->data)) {
    $this->Session->setFlash('El cliente '.$this->data['Cliente']['id'].' fue guardado correctamente.','flash_add');
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar la parte.", "flash_error");
  endif;
  $this->set(compact('htsjpjuzgados','globalmunicipios','globalescolaridades','globalocupaciones'));
 }

 public function edit($id = null) {
  $this->Cliente->id = $id;
  $this->Cliente->recursive = -1;
  $involucrado=$this->Cliente->find('first',array('conditions'=>array('id'=>$id),'recursive'=>-1));
  $juzid=substr($involucrado['Cliente']['id'],0,4); 

  $this->set('title_for_layout', 'Parte - Editar');
    if ($this->request->is('get')) $this->request->data = $involucrado;
    else {
     if ($this->Cliente->save($this->request->data)) {
      $this->Session->setFlash('El cliente "'.$id.'", se ha actualizado',"flash_add");
      $this->redirect(array('action' => 'view',$id));
     } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el cliente", "flash_error");
    }
 }	
}
?>
