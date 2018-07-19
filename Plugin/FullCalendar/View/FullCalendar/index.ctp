<?php
/*
 * View/FullCalendar/index.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

echo $this->Html->script(array(
            //'/full_calendar/js/jquery/jquery-1.5.min',
			      //'/full_calendar/js/jquery/jquery-ui-1.8.9.custom.min',
			      //'/full_calendar/js/fullcalendar/1.4.11/fullcalendar.min',
			      //'/full_calendar/js/fullcalendar/1.4.11/jquery.qtip-1.0.0-rc3.min', 
			      '/full_calendar/js/fullcalendar/1.6.1/fullcalendar.min',
			      '/full_calendar/js/ready'), array('inline' => 'false'
));

echo $this->Html->css(array(
 			'/full_calendar/css/fullcalendar/theme/cupertino/style',
			'/full_calendar/css/fullcalendar/1.6.1/fullcalendar'));
		      //array('inline' => false));
?>
<link rel="stylesheet" type="text/css" href="/caygsa/full_calendar/css/fullcalendar/1.6.1/fullcalendar.print.css" media='print' />

<div class="btn-group">
  <p class="btn btn-primary" href="#" ><i class="icon-list"></i> Acción</p>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
    <span class="icon-caret-down"></span></a>
  <ul class="dropdown-menu">
    <li>
     <?php
         echo $this->Html->link('<i class="icon-calendar"></i> Agendar',
				array('plugin' => 'full_calendar', 'controller' => 'events', 'action' => 'add'),array('escape' => false));
     ?>
    </li>
    <li>
     <?php
         echo $this->Html->link('<i class="icon-search"></i> Eventos',
				array('plugin' => 'full_calendar', 'controller' => 'events', 'action' => 'index'),array('escape' => false));
     ?>
    </li>
    <li class="divider"></li>
    <li>
     <?php
         echo $this->Html->link('<i class="icon-search"></i> Tipo de Eventos',
				array('plugin' => 'full_calendar', 'controller' => 'event_types', 'action' => 'index'),array('escape' => false));
     ?>
    </li>
  </ul>
</div><br><br>

<div class="Calendar index">
  <!-- <div id='calendar' style='width: 900px; margin: 0 auto;'></div> -->
  <div id="calendar"></div>
</div><br><br>
