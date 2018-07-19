<?php
class Log extends AppModel {
  public $useTable = 'cblogs';
  var $order = 'created DESC';

  public $belongsTo = array(
  	'User' => array( 
		 'className'    => 'User',
		 'foreignKey'   => 'cbuser_id'
        )
  );
}
?>
