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
<?= $form->create('WabiSabi',array('url'=>array('controller'=>'WabiSabi','action'=>'edit')))?>
<?= $form->input('id', array('type'=>'hidden'))?>
<?= $form->input('page_name', array('type'=>'hidden'))?>
<?= $form->input('content', array('type'=>'textarea','label'=>__('Wiki Text',true)))?>
<?= $form->end(__('Save',true))?>