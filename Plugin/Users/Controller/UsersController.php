<?php
App::uses('UsersAppController', 'Users.Controller');

class UsersController extends UsersAppController {

 function beforeFilter() {
  parent::beforeFilter();
  $this->Auth->allow('login','logout');
 } 


 function login() {
   $this->layout = 'login';
   $this->set('title_for_layout', 'Iniciar Sesión');
   if ($this->request->is('post')) {
    if ($this->Auth->login()){ 
       $this->User->id = $this->Auth->user('id');
       //$this->registrarActividad('se ha logueado');
       $this->User->saveField('fecha_update', date('Y-m-d H:i:s') );
       return $this->redirect($this->Auth->redirect());
    }
    else $this->Session->setFlash("Usuario o password incorrectos");
   }
 }

 function logout() {
   //$this->layout = 'login';
   //$this->registrarActividad('se fue del sistema');
   $this->Session->setFlash('¡Regresa Pronto!');
   $this->redirect($this->Auth->logout());
 }


}
