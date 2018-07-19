<?php
  /*Copyright (C) 2011 Jovany Leandro G.C <info@manadalibre.org>
   If you are asking what license this software is released under,
   you are asking the wrong question.
  */
  /*
    This program use code from http://felix.plesoianu.ro/php/wabisabi/ who
    owner is  Felix Pleșoianu <felixp7@yahoo.com>
  */
?>
<?php if($breadcrumb):?>
      <?php foreach($breadcrumb as $d):?>		
       >> <?= $html->link($d, array('plugin'=>'wabi_sabi','controller'=>'WabiSabi','action'=>'index',$d))?>
      <?php endforeach;?>
<?php endif;?>
<br />
<?= $wiki?>
<br />

<?= $html->link(__('Edit',true),array('plugin'=>'wabi_sabi','controller'=>'WabiSabi','action'=>'edit', $page_name),array('class'=>'wabisabi_edit'))?>&nbsp;
<?= $html->link(__('WikiSandBox',true),array('plugin'=>'wabi_sabi','controller'=>'WabiSabi','action'=>'index', 'WikiSandBox'));
