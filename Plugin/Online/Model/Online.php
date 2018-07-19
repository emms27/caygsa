<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
class Online extends OnlineAppModel {
 //var $useTable = false;
 public $useTable = 'cbonlines';
 var $name = 'Online';
 var $primaryKey = 'ip';


 public $belongsTo = array(
 	 'User' => array( 
		   'className'    => 'User',
		   'foreignKey'   => 'ddfmuser_id'
         )
 );
  
   
  // Helper method to give me ten minutes ago non MySQL related
 function _tenMinAgo(){
    $min = 10*60;
    return date("Y-m-d H:i:s", time() - $min);
 }
  
  // converts an IP number to an IP address from the database
 function _NumberToIpAddress($number = null){ return long2ip($number); }

  // converts an IP address to a number for the database.
 function _ipAddressToNumber($IPaddress = null){ return ip2long($IPaddress);} 

  //  Insert the user to the current url
 function updateNow(){
  //  $userID=AuthComponent::user('id');
  $userID=1;
  $userIP= $this->_ipAddressToNumber(CakeRequest::clientIp());

  $save_data = array(
  	'ddfmuser_id'=> $userID,
        'ip'  => $userIP,
	//'dt'  => 'NOW()',
        'app' => 'CAYGSA');
  $this->save($save_data);
 }  

 // Clear the table of old online users
 function deleteOld(){
  //$conditions = array('dt <' => "SUBTIME(NOW(),'0 00:05:00')",'app'=>'DDFM');
  //$this->deleteAll($conditions,false);
  
   $sdelete = "delete FROM cbonlines WHERE dt<SUBTIME(NOW(),'0 00:01:00') and app='CAYGSA'";  
   $this->query($sdelete);
 }

 function beforeFind(){
  $this->deleteOld();
  $this->updateNow();
 }

/*
 function afterFind($results){
  foreach($results as $key => $val){
   if(isset($val[$this->alias]['ip'])){
    $results[$key][$this->alias]['real_ip'] = $this->_NumberToIpAddress($val[$this->alias]['ip']);
   }
  }
  return $results;
 }
*/
 
}
