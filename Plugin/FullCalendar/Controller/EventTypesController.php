<?php
/*
 * Controllers/EventTypesController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
 
class EventTypesController extends FullCalendarAppController {

	var $name = 'EventTypes';

        var $paginate = array(
            'limit' => 15
        );

	function index() {
		$this->EventType->recursive = 0;
		$this->set('eventTypes', $this->paginate());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash(__('Invalid event type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('eventType', $this->EventType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EventType->create();
			if ($this->EventType->save($this->data)) {
	 			$this->Session->setFlash('El tipo de evento "'.$id.'" fue registrado', 'flash_add');
				$this->redirect(array('action' => 'index'));
			} else 
             $this->Session->setFlash("Complete la informaci&oacute;n necesaria para registrado el tipo de evento", "flash_error");
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EventType->save($this->data)) {
	 			$this->Session->setFlash('El tipo de evento "'.$id.'" fue actualizado', 'flash_add');
				$this->redirect(array('action' => 'index'));
			} else 
             $this->Session->setFlash("Complete la informaci&oacute;n necesaria para actualizar el tipo de evento", "flash_error");
			
		}
		if (empty($this->data)) {
			$this->data = $this->EventType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for event type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EventType->delete($id)) {
			$this->Session->setFlash(__('Event type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Event type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

 function status($id = null) {
  $this->EventType->id = $id;
  $this->EventType->recursive=-1;
  $existe=$this->EventType->findById($id);
  //debug($existe);
  if ($existe['EventType']['ver']==0) $ever=1; else $ever=0;
  /*$user = $this->Auth->user();
  $juzid=substr($existe['EventType']['id'],0,4); 

  if (($user['Group']['id']==3) && ($user['htsjpEventType_id']!=$juzid)){
   $this->Session->setFlash('No tiene permiso para cancelar la orden de pago "'.$id.'"');
   $this->redirect(array('action'=>'index'), null, true);
  }else if (($existe['EventType']['estado']!="Rechazada") || (!$id)){
   $this->Session->setFlash('La orden "'.$id.'", no se puede cancelar');
   $this->redirect(array('action' => 'index'));
  }else {*/
   $data = array('id' => $id, 'ver' => $ever);//,'estado' => 'Cancelada');
   //$this->EventType->save($data);

   if ($this->EventType->saveField('ver',$ever,array('validate' => 'only')))
    $this->Session->setFlash('Se ha modificado el status',"flash_add");

   $this->redirect(array('action' => 'index'));
  }

}
?>
