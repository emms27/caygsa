<?php
 class Role extends AppModel {
  public $useTable = 'roles';	
  public $name = 'Role';
  public $actsAs = array('Acl' => array('type' => 'requester'));
  public $hasMany = array('User');
 
  public function parentNode() {
        return null;
    }


 } 

?>
