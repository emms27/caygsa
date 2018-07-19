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

class ExpedientesController extends AppController {
 //se agregaron en el Helper
 public $helpers = array('Html',
			 'Form',
		         'Javascript',
			 'Ajax',
			 'Csv',
			 'Dates'//,
			// 'Crumb'
 );

 public $components = array('RequestHandler');
  //var $beforeFilter = array('requireLogin'=>array('only'=>array('add','edit','delete')));
  //var $beforeFilter = array('requireLogin'=>array('except'=>array('index')));


 public function index() {
  $this->set('title_for_layout', 'Expediente - Consulta');
  $this->Expediente->recursive = 0; 

  if ((isset($this->passedArgs['sexpediente'])) || (isset($this->data['Expediente']['sexpediente']))){
   if ((isset($this->passedArgs['sexpediente'])) && ($this->passedArgs['sexpediente']!=NULL)) $palabra=$this->passedArgs['sexpediente'];
   else $palabra=$this->data['Expediente']['sexpediente'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Expediente.expediente LIKE '=> '%'.$palabra.'%'));//,
			                         //'Expediente.ver' => '1'));

  }else{
   $this->paginate = array('limit' => 50,
                           'page' =>1);//,
//		 	   'conditions' => array('Expediente.ver' => '1'));
  }


  $expediente = $this->paginate('Expediente');    
  if ($this->request->is('requested')) {return $expediente;} else { $this->set(compact('expediente'));}
  


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

 public function consulta_expedientes(){ 
  $this->set('title_for_layout', 'Juzgado - Consulta');
  if ((isset($this->data['Expediente']['expini'])) && 
      (isset($this->data['Expediente']['expfin'])) && 
      (isset($this->data['Expediente']['globaljuzgado_id']))){
   $juzgado=$this->data['Expediente']['globaljuzgado_id'];
   $expini=$this->data['Expediente']['expini'];
   $expfin=$this->data['Expediente']['expfin'];

   $campo[1]='htsjpexpediente_id LIKE';  
   $valor[1]=$juzgado.$expini;
   $valor[2]=$juzgado.$expfin;
   $valor[3]=$juzgado."%";
   //   $saldo= $this->DesgloseSaldo('DetalleRangoFechas',$campo,$valor,1);
   //debug($valor);

   $this->Expediente->recursive=0;
   $this->Expediente->unbindModel(array('hasMany' => array('Partes')));
   $this->Expediente->unbindModel(array('belongsTo' => array('Cliente','TipoCredito')));

   if ($juzgado!=NULL || $juzgado!=""){
    $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.expediente >='=> $valor[1],
			     	  		       'Expediente.expediente <='=> $valor[2])));
   }else{
    $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.expediente LIKE '=> $expini.'%',
			     	  		       'Expediente.expediente LIKE '=> $expfin.'%')));
   }

   //debug($expediente);
   $this->set(compact('expediente'));
  }

     //JUZGADOS
   $globaljuzgados = $this->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
						        'fields'=>array('Juzgado.id',
								        'Juzgado.id',
									'Juzgado.organo_judicial')
                                                       )
                                                  );

   $this->set(compact('globaljuzgados'));
 }

 public function consulta_juzgado(){ 
  $this->set('title_for_layout', 'Juzgado - Consulta');
  if ((isset($this->data['Expediente']['from'])) && 
      (isset($this->data['Expediente']['to'])) &&
      (isset($this->data['Expediente']['status'])) &&  
      (isset($this->data['Expediente']['globaljuzgado_id']))){
   $fecini=$this->data['Expediente']['from'].' 00:00:00';
   $fecfin=$this->data['Expediente']['to'].' 23:59:59';
   $juzgado=$this->data['Expediente']['globaljuzgado_id'];
   $status=$this->data['Expediente']['status'];

   $campo[1]='htsjpexpediente_id LIKE';  
   $valor[1]=$fecini;
   $valor[2]=$fecfin;
   $valor[3]=$juzgado."%";
//   $saldo= $this->DesgloseSaldo('DetalleRangoFechas',$campo,$valor,1);
   //debug($saldo);

   $this->Expediente->recursive=0;
   $this->Expediente->unbindModel(array('hasMany' => array('Partes')));
   $this->Expediente->unbindModel(array('belongsTo' => array('Cliente','TipoCredito')));

   if ($juzgado!=NULL || $juzgado!=""){
    if ($status=='T'){
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin,
			     	  		       'Expediente.expediente LIKE '=> $valor[3],
			     	  		       'Expediente.fecha_terminacion !='=> NULL,
			     	  		       'Expediente.fecha_terminacion !='=> '0000-00-00',
     )));
    }else{
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin,
			     	  		       'Expediente.expediente LIKE '=> $valor[3]
     )));
    }
   }else{
    if ($status=='T'){
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin,
			     	  		       'Expediente.fecha_terminacion !='=> NULL,
			     	  		       'Expediente.fecha_terminacion !='=> '0000-00-00'
     ))); 
    }else{
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin
     ))); 
    }
   }
   //debug($expediente);
   $this->set(compact('expediente'));
  }

     //JUZGADOS
   $globaljuzgados = $this->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
						        'fields'=>array('Juzgado.id',
								        'Juzgado.id',
									'Juzgado.organo_judicial')
                                                       )
                                                  );

   $this->set(compact('globaljuzgados'));
 }

 public function excel_juzgado(){//$id = null) { 
/*
  if (!$id){
   $this->Session->setFlash('No has seleccionado ningun pdf.');
   $this->redirect(array('action'=>'index'), null, true);
  }
*/
   //Configure::write('debug',2); // Otherwise we cannot use this method while developing 
   $this->layout = 'excel';

   $this->Expediente->recursive=0;
   $this->Expediente->unbindModel(array('hasMany' => array('Partes')));
   $this->Expediente->unbindModel(array('belongsTo' => array('TipoCredito')));

   $dataurl=$this->params['url'];
   $fecini=$this->params['url']['fecini'].' 00:00:00';
   $fecfin=$this->params['url']['fecfin'].' 23:59:59';
   $status=$this->params['url']['s'];
   $juzgado=$this->params['url']['j'];
   $valor[3]=$juzgado.'%';
  

   if ($juzgado!=NULL || $juzgado!=""){
    if ($status=='T'){
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin,
			     	  		       'Expediente.expediente LIKE '=> $valor[3],
			     	  		       'Expediente.fecha_terminacion !='=> NULL,
			     	  		       'Expediente.fecha_terminacion !='=> '0000-00-00',
     )));
    }else{
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin,
			     	  		       'Expediente.expediente LIKE '=> $valor[3]
     )));
    }
   }else{
    if ($status=='T'){
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin,
			     	  		       'Expediente.fecha_terminacion !='=> NULL,
			     	  		       'Expediente.fecha_terminacion !='=> '0000-00-00'
     ))); 
    }else{
     $expediente= $this->Expediente->find('all',array(
			         'conditions' => array('Expediente.fecha_registro >='=> $fecini,
			     	  		       'Expediente.fecha_registro <='=> $fecfin
     ))); 
    }
   }
   //debug($expediente);
   $this->set(compact('expediente')); 
   $this->render();
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
  if ($this->Expediente->saveAll($this->data, array('validate'=>'first'))) {
    //if ($this->Expediente->save($this->data)) {
     //$factual=date('Y-m-d h:i:s');
  /*   $sparte = "insert into ddfmpartes (id,htsjpexpediente_id,nombre,apepat,apemat,htsjpestado_id,tusuario,tidentificacion,nidentificacion,fecha_registro) VALUES ('$idparte','$idexp','H. Tribunal','Superior de Justicia','del Estado de Puebla','21','Beneficiario','Credencial de Elector','0101010101010','$factual')";
     $this->Expediente->Involucrado->query($sparte);
*/
   $this->Session->setFlash('El expediente fue guardado correctamente.',"flash_add");
   $this->redirect(array('controller'=>'Expedientes','action' => 'index'));
  } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para dar de alta el expediente","flash_error");
 }

  //JUZGADOS
   $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
   $globaljuzgados = $this->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,						
						        'fields'=>$FiltroJuzgado
   ));

   $globalmaterias = $this->Expediente->Materia->find('list',
						  array('recursive' => -1,
			  		                'conditions' => array('Materia.ver' => 1,
			  		                		      'Materia.asunto' => 1)
   ));

   $cbclientes = $this->Expediente->Cliente->find('list',
						  array('order' =>'Cliente.namefull ASC', 
							'recursive' => -1
   ));

   $globaltipojuicios = $this->Expediente->Materia->find('list',
						  array('order' =>'Materia.descripcion ASC', 
							'recursive' => -1,
			  		                'conditions' => array('Materia.ver' => 1,
			  		                		      'Materia.juicio' => 1)
   ));

   $cbtipocreditos = $this->Expediente->TipoCredito->find('list',
						  array('recursive' => -1,
			  		                'conditions' => array('TipoCredito.ver' => 1)
   ));

   //debug($cbtipocreditos);
   //$this->loadModel('TipoJuicio');

    $this->set(compact('globaltipojuicios','cbclientes','globaljuzgados','globalmaterias','cbtipocreditos'));

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

   $this->set('title_for_layout', 'Expediente - Editar');
   //$this->Expediente->id = $id;
   //$this->Expediente->recursive=-1;
   //$personal=$this->User->findById($id);
   //debug($personal);
   if ($this->request->is('get')) {
     $this->Expediente->recursive=-1;
     $expedientes=$this->Expediente->findById($id);
     $this->request->data =$expedientes;
     $juzid=substr($expedientes['Expediente']['expediente'],0,4);
     $anio=substr($expedientes['Expediente']['expediente'],-4,4);
     $exp=substr($expedientes['Expediente']['expediente'],-8,4);
     $this->request->data('Expediente.globaljuzgado_id', $juzid);
     $this->request->data('Expediente.num',$exp);
     $this->request->data('Expediente.anio', $anio);
     //debug($this->request->data);
   } else {
    if ($this->Expediente->save($this->request->data)) {
     $this->Session->setFlash('El expediente fue actualizado',"flash_add");
    //$this->redirect(array('action' => 'view',$id));
     $this->redirect(array('action' => 'index'));
    } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el Expediente", "flash_error");
   }

  //JUZGADOS
   $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
   $globaljuzgados = $this->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,						
						        'fields'=>$FiltroJuzgado
   ));

   $globalmaterias = $this->Expediente->Materia->find('list',
						  array('recursive' => -1,
			  		                'conditions' => array('Materia.ver' => 1,
			  		                		      'Materia.asunto' => 1)
   ));

   $cbclientes = $this->Expediente->Cliente->find('list',
						  array('order' =>'Cliente.namefull ASC', 
							'recursive' => -1
   ));

   $globaltipojuicios = $this->Expediente->Materia->find('list',
						  array('order' =>'Materia.descripcion ASC', 
							'recursive' => -1,
			  		                'conditions' => array('Materia.ver' => 1,
			  		                		      'Materia.juicio' => 1)
   ));

   $cbtipocreditos = $this->Expediente->TipoCredito->find('list',
						  array('recursive' => -1,
			  		                'conditions' => array('TipoCredito.ver' => 1)
   ));

   //$this->loadModel('TipoJuicio');

   $this->set(compact('globaltipojuicios','cbclientes','globaljuzgados','globalmaterias','cbtipocreditos'));
/*   //$user = $this->Auth->user();
   $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.descripcion');
   $htsjpjuzgados = $this->User->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,						
						        'fields'=>$FiltroJuzgado,
    //                                                    'conditions'=>array('id'=>$user['htsjpjuzgado_id'])
   ));
   $ddfmgroups = $this->User->Group->find('list',array('order' =>'Group.id ASC','recursive' => -1));
   $this->set(compact('personal','htsjpjuzgados','ddfmgroups'));
  }
*/
 }

 public function view($id = null) { 
  $this->Expediente->id = $id;
  if ((!$this->Expediente->exists()) || (!$id)){
    $this->Session->setFlash('No se encontró el expediente "'.$id.'" en el Sistema');
    $this->redirect(array('action'=>'index'), null, true);
  }else{          
   $this->set('title_for_layout', 'Expediente - Consulta Detalle');

   //$this->Expediente->unbindModel(array('belongsTo' => array('Materia')));
   $this->Expediente->unbindModel(array('hasMany' => array('Stage')));
   $expediente=$this->Expediente->read();
   $campo[1]='ddfmordenpago_id LIKE';
   $campo[2]='htsjpexpediente_id';    
   $valor[1]=$id.'%';  $valor[2]=$id;
   //$saldo= $this->DesgloseSaldo('DetalleExpediente',$campo,$valor,1);
   $this->Expediente->Stage->unbindModel(array('belongsTo' => array('Expediente')));
   $stage=$this->Expediente->Stage->find('all',
			array('recursive' => 0,
			      'conditions' => array('Stage.cbexpediente_id'=> $id),
   ));

   $this->Expediente->Materia->recursive = -1;
   $this->Expediente->Materia->id = $expediente['Expediente']['globaltipojuicio_id'];
   $tipojuicio=$this->Expediente->Materia->field('descripcion');

   $comentarios='<span style="font-size:22px"><span style="font-family:arial,helvetica,sans-serif"><strong>Expediente</strong></span></span><br>'.$expediente['Expediente']['notas'].'<br><br><span style="font-size:22px"><span style="font-family:arial,helvetica,sans-serif"><strong>Etapas Procesales</strong></span></span><br><br>';
   $i=1;
   foreach ($stage as $etapa): 
    $comentarios.='<span style="font-size:18px"><span style="font-family:arial,helvetica,sans-serif"><strong>'.$i.'. '.$etapa['Etapa']['etapa'].'</strong></span></span><br>'.$etapa['Stage']['notas'].'<hr />';
    $i++;
   endforeach;

   $this->set(compact('expediente','stage','tipojuicio','comentarios'));
   $this->render();
  }
 }

 public function pdf($id = null) { 
  $this->Expediente->id = $id;
  if ((!$this->Expediente->exists()) || (!$id)){
    $this->Session->setFlash('No se encontró el expediente "'.$id.'" en el Sistema');
    $this->redirect(array('action'=>'index'), null, true);
  }else{           
   Configure::write('debug',2); // Otherwise we cannot use this method while developing 
   $this->layout = 'pdf'; 
     
   $this->Expediente->unbindModel(array('belongsTo' => array('TipoCredito')));
   $this->Expediente->unbindModel(array('hasMany' => array('Stage')));
   $exp=$this->Expediente->read();
   $this->Expediente->Stage->unbindModel(array('belongsTo' => array('Expediente')));
   $stage=$this->Expediente->Stage->find('all',array('conditions'=>array('Stage.cbexpediente_id'=>$id)));

   //$saldonuevo= $this->DesgloseSaldo('DetalleExpediente',$campo,$valor,1);
   //$saldo=$saldonuevo['SaldoNuevo'];
   //debug($stage);
   //$smovimiento=$saldonuevo['MovimientosSaldo'];
   $this->set(compact('exp','stage'));
   $this->render();
  }
 } 

  function autoCompletado() {
   $user = $this->Auth->user();
   if ($user['Role']['id']==3){
     $expedientes= $this->Expediente->find('all', 
			array('recursive' => -1,
			      'conditions' => array(
						'Expediente.expediente LIKE '=> '%'.$this->request->query['term'].'%',
						'Expediente.expediente LIKE '=>$user['htsjpjuzgado_id'].'%'),
  			      'fields'=> 'Expediente.id'));
    }else {
     $expedientes= $this->Expediente->find('all', 
			array('recursive' => -1,
			      'conditions' => array('Expediente.expediente LIKE '=> '%'.$this->request->query['term'].'%'),
  			      'fields'=> array('Expediente.id','Expediente.expediente')));
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
    if ($user['Role']['id']==3){
     $expediente=$this->Expediente->find('first',
				    array('conditions'=>array(
						'Expediente.id LIKE' => $id,
						'Expediente.id LIKE '=>$user['htsjpjuzgado_id'].'%')));
    }else{
     $this->Expediente->unbindModel(array('hasMany' => array('Partes')));
     $this->Expediente->unbindModel(array('belongsTo' => array('Cliente','TipoCredito')));
     $expediente=$this->Expediente->findById($id);
    }
   }

   $this->set(compact('expediente'));
   //debug($expediente);
   $this->layout = 'ajax';
  }
	
}
?>
