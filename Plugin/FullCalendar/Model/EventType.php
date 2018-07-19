<?php
/*
 * Model/EventType.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
 
class EventType extends FullCalendarAppModel {
   public $useTable = 'cbeventtypes'; //tabla que exista en la base de datos
   public $name = 'EventType';
   //public $virtualFields = array('namefull' => 'CONCAT(Cliente.nombre, " ",Cliente.apepat, " ",Cliente.apemat)');
   public $displayField = 'name';
   public $order = "EventType.name ASC";
 var $actsAs = array('Logable');


	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	var $hasMany = array(
		'Event' => array(
			'className' => 'FullCalendar.Event',
			'foreignKey' => 'cbeventtype_id',
			'dependent' => false,
		)
	);

}
?>
