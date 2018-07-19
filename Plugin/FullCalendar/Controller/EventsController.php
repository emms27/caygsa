<?php
/*
 * Controller/EventsController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

class EventsController extends FullCalendarAppController {
	var $name = 'Events';
        var $paginate = array('limit' => 15);

 function index() {
  $this->set('title_for_layout', 'Eventos - Consulta');
  $this->Event->recursive = 0;

  if ((isset($this->passedArgs['sparte'])) || (isset($this->data['Event']['sparte']))){
   if ((isset($this->passedArgs['sparte'])) && ($this->passedArgs['sparte']!=NULL)) $palabra=$this->passedArgs['sparte'];
   else $palabra=$this->data['Event']['sparte'];

   $this->paginate = array('limit' => 50,
                           'page' =>1,
			   'conditions' => array('Event.title LIKE '=> '%'.$palabra.'%'));

  }else $this->paginate = array('limit' => 50,'page' =>1);

  $events = $this->paginate('Event'); 

  if ($this->request->is('requested')) {return $events;} else { $this->set(compact('events')); }
 }

 function view($id = null) {
	if (!$id) {
		$this->Session->setFlash(__('Invalid event', true));
		$this->redirect(array('action' => 'index'));
	}
	$this->set('event', $this->Event->read(null, $id));
 }

 function add() {
	if (!empty($this->data)) {
		//$this->Event->create();
	 if ($this->Event->save($this->data)) {
            $this->Session->setFlash('Se agendó al expediente "'.$this->data['Event']['cbexpediente_id'].'" ',"flash_add");
	    $this->redirect(array('action' => 'index'));
	 } else $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrar el evento", "flash_error");
	}
  $FiltroJuzgado=array('Juzgado.id','Juzgado.id','Juzgado.organo_judicial');
  $globaljuzgados = $this->Event->Expediente->Juzgado->find('list',
						  array('order' =>'Juzgado.id ASC', 
							'recursive' => -1,
						        'fields'=>$FiltroJuzgado));
 	$this->set('cbeventtypes', $this->Event->EventType->find('list',array('conditions'=>array('ver'=>1))));
	$this->set('globaljuzgados', $globaljuzgados);
  }

  function edit($id = null) {
	if (!$id && empty($this->data)) {
		$this->Session->setFlash(__('Invalid event', true));
		$this->redirect(array('action' => 'index'));
	}
	if (!empty($this->data)) {
	  if ($this->Event->save($this->data)) {
		$this->Session->setFlash('El evento "'.$id.'" fue actualizado', 'flash_add');
		$this->redirect(array('action' => 'index'));
	  } else 
            $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el evento", "flash_error");
	}
	if (empty($this->data)) $this->data = $this->Event->read(null, $id);

 	$this->set('cbeventtypes', $this->Event->EventType->find('list',array('conditions'=>array('ver'=>1))));
  }

  function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for event', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Event->delete($id)) {
			$this->Session->setFlash(__('Event deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Event was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

        // The feed action is called from "webroot/js/ready.js" to get the list of events (JSON)
	function feed($id=null) {
		$this->layout = "ajax";
		$vars = $this->params['url'];
		//$conditions = array('conditions' => array('UNIX_TIMESTAMP(start) >=' => $vars['start'], 'UNIX_TIMESTAMP(start) <=' => $vars['end']));
		$events = $this->Event->find('all',array('conditions'=>array('active'=>'1')));//, $conditions);
		foreach($events as $event) {
			if($event['Event']['all_day'] == 1) {
				$allday = true;
				$end = $event['Event']['start'];
			} else {
				$allday = false;
				$end = $event['Event']['end'];
			}
			$data[] = array(
					'id' => $event['Event']['id'],
					'title'=>$event['Event']['title'],
					'start'=>$event['Event']['start'],
					'end' => $end,
					'allDay' => $allday,
					'url' => $this->webroot.'full_calendar/events/view/'.$event['Event']['id'],
					'details' => $event['Event']['details'],
					//'className' => $event['EventType']['color'] //v 1.4.11
					'color' => $event['EventType']['color']  //v 1.6.1
					//textColor: 'black',
			);
		}
		$this->set("json", json_encode($data));
	}

        // The update action is called from "webroot/js/ready.js" to update date/time when an event is dragged or resized
	function update() {
		$vars = $this->params['url'];
		$this->Event->id = $vars['id'];
		$this->Event->saveField('start', $vars['start']);
		$this->Event->saveField('end', $vars['end']);
		$this->Event->saveField('all_day', $vars['allday']);
	}

 function status($id = null) {
  $this->Event->id = $id;
  $this->Event->recursive=-1;
  $existe=$this->Event->findById($id);
  //debug($existe);
  if ($existe['Event']['active']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['Event']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpEvent_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['Event']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   //$this->Event->save($data);

   if ($this->Event->saveField('active',$ever,array('validate' => 'only')))
    $this->Session->setFlash('Se ha modificado el status',"flash_add");

   $this->redirect(array('action' => 'index'));
  }


}
?>
