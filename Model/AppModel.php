<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {


 function validarAnio($data, $limit){  
  $ymin=1980;  $ymax=date("Y");
 
  if (($data['anio']>=$ymin) && ($data['anio']<=$ymax)) $count=0;  else $count=1;
  return $count < $limit;    
 }

 function IDExpedienteNew($modelo,$campo,$valor){  
  //debug($valor);
  $idnew = $this->find('count',array('conditions' => array($modelo.".".$campo." LIKE" => $valor."%"), 
                                     'recursive' => -1
                                     )
                       );
  //debug($idnew);
  $id=$idnew+1;
  $long=strlen($id);
														         
  switch($long){
   case 1: $id='000'.$id; break;
   case 2: $id='00'.$id;  break;
   case 3: $id='0'.$id;   break;
   case 4: $id=$id;       break;
  }  
  $valor.=$id;   
  return  $valor;
 }

 function IDNewExp($modelo,$campo,$valor){  
  //debug($valor);
  $idnew = $this->find('count',array('conditions' => array($modelo.".".$campo." LIKE" => "%".$valor), 
                                     'recursive' => -1
           ));
  //debug($idnew);
  $id=$idnew+1;
  $long=strlen($id);
														         
  switch($long){
   case 1: $id='000'.$id; break;
   case 2: $id='00'.$id;  break;
   case 3: $id='0'.$id;   break;
   case 4: $id=$id;       break;
  }  
  $id.=$valor;   
  return  $id;
 }


}
