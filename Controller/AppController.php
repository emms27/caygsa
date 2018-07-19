<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
//App::uses('UsersAppController', 'Users.Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
 public $layout = 'admin';
 //var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth');

/*		
 function beforeFilter() {

    //Configure AuthComponent
    $this->Auth->authorize = array(
        'Controller',
        'Actions' => array('actionPath' => 'controllers')
    );
    $this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'login', 'password' => 'password')));
    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false, 'plugin' => false);
    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login', 'admin' => false, 'plugin' => false);
    $this->Auth->loginRedirect = array('controller' => 'products', 'action' => 'index', 'admin' => false, 'plugin' => false);

 }

function isAuthorized($user) {
    // return false;
    return $this->Auth->loggedIn();
}
*/


 public $components = array(
        'Acl',
        'Auth' => array(
            //'loginRedirect' => array('plugin'=>false,'controller' => 'pages', 'action' => 'home'),
            'loginAction' => array('plugin'=>false,'controller' => 'users','action' => 'login'),
            'authError' => 'No tiene permiso para esta acción',
            'authorize' => array('Actions' => array('actionPath' => 'controllers'))
        ),
        'Session'
 );

 public function beforeFilter() {
  //parent::beforeFilter();
  //$this->Auth->allow('display'); //permite paginas
  //$this->Auth->authorize = 'actions';
  //Configure AuthComponent
  $this->Auth->loginAction = array('plugin'=>false,'controller' => 'Users', 'action' => 'login');
  $this->Auth->logoutRedirect = array('plugin'=>false,'controller' => 'users', 'action' => 'login');
  $this->Auth->loginRedirect = array('plugin'=>false,'controller' => 'pages', 'action' => 'home');


  if (sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) { 
    $this->{$this->modelClass}->setUserData($this->activeUser); 
  } 


  $user = $this->Auth->user();

  //debug($user);
  if ($user!=NULL) {
    $this->set('isAuthed', true);
    $this->_userId = (int) $user['id'];
    //$this->set('userid', $user['id']);
    $this->set('userid', $user);
  } else $this->set('isAuthed', false);

 //$this->set('ip', $this->RequestHandler->getClientIp());
 }



}

