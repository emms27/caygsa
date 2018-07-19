<?php
/**
 * Controller para crud de los involucrados.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
class PartesController extends AppController {
 public $helpers = array('Html', 'Form','Javascript', 'Ajax','EstadoCivil','Ocupaciones','Escolaridad','Dates');


 public function index() {
  $this->set('title_for_layout', 'Partes - Consulta');

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Parte']['sparte'])) || 
      (isset($this->passedArgs['tparte'])) || (isset($this->data['Parte']['tparte']))){

   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Parte']['sparte'];

   $tipo="";
   if ((isset($this->passedArgs['sparte'])) && (isset($this->passedArgs['tparte'])) || 
       (isset($this->data['Parte']['sparte'])) && (isset($this->data['Parte']['tparte']))){
    if ((isset($this->passedArgs['tparte'])) && ($this->passedArgs['tparte']!=NULL)) $tipo=$this->passedArgs['tparte'];
    else $tipo=$this->data['Parte']['tparte'];
   }

   $this->paginate = array('limit' => 50,
                           'page' =>1,
 			   'recursive' =>0,
		           'order'  => array('Parte.namefull' => 'asc'),
			   'conditions' => array('Parte.namefull LIKE '=> '%'.$palabra.'%',
				                 'Parte.tipo LIKE '=> '%'.$tipo.'%',
			 	                 'Parte.ver' => '1'));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1,
 			   'recursive' =>0,
 		           'order'  => array('Parte.namefull' => 'asc'),
			   'conditions' => array('Parte.ver' => '1'));
  } 

  $parte = $this->paginate('Parte');  
  if ($this->request->is('requested')) {return $parte;} else { $this->set(compact('parte')); }
 }

 public function view($id=null) {
  $this->set('title_for_layout', 'Clientes - Consulta');
  $this->Parte->id = $id;
  $this->Parte->recursive = -1;
  //$juzid=substr($cliente['Parte']['id'],0,4); 
  //$user = $this->Auth->user();

  if (!$this->Parte->exists()) {
   $this->Session->setFlash('No se encontró el Parte "'.$id.'" en el Sistema');
   $this->redirect(array('action'=>'index'), null, true);
  }else{ // if (($user['Group']['id']==3) && ($user['htsjpjuzgado_id']!=$juzid)){
   // $this->Session->setFlash('No tiene permiso para visualizar la parte "'.$id.'"');
   // $this->redirect(array('action'=>'index'), null, true);
   $cliente=$this->Parte->read();
   $this->Parte->Expediente->id=$cliente['Parte']['cbexpediente_id'];
   $this->Parte->Expediente->recursive = -1;
   $cbexpediente['Expediente']=$this->Parte->Expediente->field('expediente');
   $this->Parte->Expediente->Juzgado->id=$this->Parte->Expediente->field('globaljuzgado_id');
   $this->Parte->Expediente->Juzgado->recursive = -1;
   $cbexpediente['Juzgado']=$this->Parte->Expediente->Juzgado->field('organo_judicial');
   $this->set(compact('cliente','cbexpediente'));
  }
 }


 public function add() {
  $this->set('title_for_layout', 'Parte - Alta');
  if (!empty($this->data)):
   if ($this->Parte->save($this->data)) {
    $this->Session->setFlash('La Parte '.$this->data['Parte']['id'].' fue guardado correctamente.', "flash_add");
    $this->redirect(array('action' => 'index'));
   } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar la parte.", "flash_error");
  endif;
  //Juzgados
/*  $user = $this->Auth->user();
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.descripcion');
  if ($user['Group']['id']==3){
   $htsjpjuzgados = $this->Involucrado->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => 0,						
						        'fields'=>$FiltroJuzgado,
                                                        'conditions'=>array('id'=>$user['htsjpjuzgado_id'])
   ));
  }else if ($user['Group']['id']==1 || $user['Group']['id']==4 ){
   $htsjpjuzgados = $this->Involucrado->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => 0,						
						        'fields'=>$FiltroJuzgado
   ));
  }
*/

  $this->loadModel('Estado');
  $globalmunicipios = $this->Estado->find('list',
						  array('order' =>'Estado.id ASC', 
							'recursive' => 0,						
						        'fields'=>'Estado.entidad'
  ));
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
  $globaljuzgados = $this->Parte->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,
						        'fields'=>$FiltroJuzgado
  ));

/* $globalescolaridades = $this->Parte->Escolaridade->find('list',
						  array('order' =>'Escolaridade.id ASC', 
							'conditions' =>array('Escolaridade.ver'=>'1'),  
							'recursive' => -1,						
						        'fields'=>'Escolaridade.escolaridad'
  ));

  $globalocupaciones = $this->Parte->Ocupacione->find('list',
						  array('order' =>'Ocupacione.id ASC',
							'conditions' =>array('Ocupacione.ver'=>'1'),  
							'recursive' => -1,						
						        'fields'=>'Ocupacione.ocupacion'
  ));
*/
 
  $this->set(compact('globaljuzgados'));
 }

 public function edit($id = null) {
  $this->Parte->id = $id;
  $this->Parte->recursive = -1;
  if (!$this->Parte->exists()) {
   $this->Session->setFlash('No se encontró la Parte "'.$id.'" en el Sistema','flash_error');
   $this->redirect(array('action'=>'index'), null, true);
  }else{
   $cbexpediente=$this->Parte->field('cbexpediente_id');
   $this->Parte->Expediente->id=$cbexpediente;
   $this->Parte->Expediente->recursive = -1;
   $cbexpediente2=$this->Parte->Expediente->field('expediente');

   $this->set('title_for_layout', 'Parte - Editar');
   if ($this->request->is('get')) {
    $this->request->data = $this->Parte->read();
    $juzid=substr($cbexpediente2,0,4);
    $anio=substr($cbexpediente2,-4,4);
    $exp=substr($cbexpediente2,-8,4);
    $this->request->data('Parte.globaljuzgado_id', $juzid);
    $this->request->data('Parte.cbexpediente_id',$exp);
    $this->request->data('Parte.anio', $anio);
   } else {
    if ($this->Parte->save($this->request->data)) {
     $this->Session->setFlash('El Parte "'.$id.'", se ha actualizado',"flash_add");
     $this->redirect(array('action' => 'view',$id));
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el Parte", "flash_error");
   }
  }
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
  $globaljuzgados = $this->Parte->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,
						        'fields'=>$FiltroJuzgado
  ));
  $this->set(compact('globaljuzgados'));
 }


	
}
?>
