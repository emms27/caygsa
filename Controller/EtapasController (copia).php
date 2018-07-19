
<?php
/**
 * Controller para los Expedientes.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */

/*App::uses('ExpedientesAppController', 'Expedientes.Controller');
class ExpedientesController extends ExpedientesAppController {
*/

class EtapasController extends AppController {
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

 public $components = array('RequestHandler');
  //var $beforeFilter = array('requireLogin'=>array('only'=>array('add','edit','delete')));
  //var $beforeFilter = array('requireLogin'=>array('except'=>array('index')));


 public function index() {
  $this->set('title_for_layout', 'Etapa - Consulta');
  $this->Etapa->recursive = 0; 
  $this->Etapa->unbindModel(array('belongsTo' => array('Expediente')));

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Etapa']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Etapa']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Expediente.id LIKE '=> '%'.$palabra.'%'));//,
			                         //'Expediente.ver' => '1'));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1);//,
//		 	   'conditions' => array('Expediente.ver' => '1'));
  }


  $etapa = $this->paginate('Etapa');
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
    if ($this->Etapa->save($this->data)) {
     //$factual=date('Y-m-d h:i:s');
  /*   $sparte = "insert into ddfmpartes (id,htsjpexpediente_id,nombre,apepat,apemat,htsjpestado_id,tusuario,tidentificacion,nidentificacion,fecha_registro) VALUES ('$idparte','$idexp','H. Tribunal','Superior de Justicia','del Estado de Puebla','21','Beneficiario','Credencial de Elector','0101010101010','$factual')";
     $this->Expediente->Involucrado->query($sparte);
*/
     $this->Session->setFlash('La etapa fue guardado correctamente.',"flash_add");
     $this->redirect(array('controller'=>'Etapas','action' => 'index'));
//    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para dar de alta la ficha", "flash_error");
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para dar de alta la etapa","flash_error");
   }

  //JUZGADOS
   $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
   $globaljuzgados = $this->Etapa->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,						
						        'fields'=>$FiltroJuzgado
   ));

   $cbstages = $this->Etapa->Stage->find('list',
						  array('order' =>'Stage.id ASC', 
							'recursive' => -1
   ));


   //$this->loadModel('TipoJuicio');

    $this->set(compact('globaljuzgados','cbstages'));

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
