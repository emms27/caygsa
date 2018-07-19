<?php
App::uses('UsersAppModel', 'Users.Model');
class Group extends UsersAppModel {
  var $name = 'cbgroups';
  public $actsAs = array('Acl' => array('type' => 'requester'));
  var $hasMany = array('User');
 
  public function parentNode() {
        return null;
    }


}

?>
