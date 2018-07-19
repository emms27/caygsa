<?php
/**
 * Helper para mostrar un select list de todos los paises.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 *
 * 
 * @formatos dia=dd  mes=mm  a�o=YYYY  hora=hh:mm:ss.


 ------------- EJEMPLO -------------
 1. Mostrar la fecha actual
  echo $this->Dates->fechaActual();

 2. Mostrar la fecha dando parametros
  echo $this->Dates->fechaObtener(dia,mes,a�o);

 3. Mostar el nombre del mes en espa�ol dando parametros
  echo $this->Dates->mesObtener(mes);

 4. Mostrar el nombre del dia en espa�ol dando parametros
    echo $this->Dates->diaObtener(dia,mes,a�o);

 5. Mostrar tiempo de retardo dando parametros
    echo $this->Dates->tiempoRetardo(hora_tolerancia,hora_registrada);
 -----------------------------------
 */

class DatesHelper extends AppHelper
{
// $fechoy=date("Y-m-d");
// $hrhoy=date("H:i:s");

  function tiempoRetardo($horaini,$horafin)
  {
	$horai=substr($horaini,0,2);
	$mini=substr($horaini,3,2);
	$segi=substr($horaini,6,2);

	$horaf=substr($horafin,0,2);
	$minf=substr($horafin,3,2);
	$segf=substr($horafin,6,2);

	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);

	$dif=$fin-$ini;

	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	return date("H:i:s",mktime($difh,$difm,$difs));
  } 


  function fechaActual()
  {
	 $dia=date("d"); // dia del mes  
	 $m=date("n");   // numero del mes
	 $y=date("Y");   // a�o
	 switch($m)
	 {
	  case 1:    $mes="Enero";      break;
	  case 2:    $mes="Febrero";    break;
	  case 3:    $mes="Marzo";      break;
	  case 4:    $mes="Abril";      break;
	  case 5:    $mes="Mayo";       break;
	  case 6:    $mes="Junio";      break;
	  case 7:    $mes="Julio";      break;
	  case 8:    $mes="Agosto";     break;
	  case 9:    $mes="Septiembre"; break;
	  case 10:   $mes="Octubre";    break;
	  case 11:   $mes="Noviembre";  break;
	  case 12:   $mes="Diciembre";  break;
	 }
	 
	 $dia_semana=date("w");  // numero del dia que va
	 switch($dia_semana)
	 {
	  case 1:   $ds="Lunes";       break;
	  case 2:   $ds="Martes";      break;
	  case 3:   $ds="Miercoles";   break;
	  case 4:   $ds="Jueves";      break;
	  case 5:   $ds="Viernes";     break;
	  case 6:   $ds="Sabado";      break;
	  case 0:   $ds="Domingo";     break;
	 }	
	 $fecha_hoy=$ds.', '.$dia.' de '.$mes.' de '.$y; // Formato formal de la fecha
	 return $fecha_hoy;
  }

  function fechaExpire($ini,$fin)
  {
   if ($ini==NULL) $ini= date('Y-m-d');
   $start_ts = strtotime($ini); 
   $end_ts = strtotime($fin); 
   $diff = $end_ts - $start_ts; 
   return round($diff / 86400); 
  } 


  function fechaObtener($dmed,$mmed,$ymed)
  {
    switch($mmed)
    {
     case 1: $mes_med="Enero";      break;    
     case 2: $mes_med="Febrero";    break;   
     case 3: $mes_med="Marzo";      break;
     case 4: $mes_med="Abril";      break;    
     case 5: $mes_med="Mayo";       break;  
     case 6: $mes_med="Junio";      break;
     case 7: $mes_med="Julio";      break;   
     case 8: $mes_med="Agosto";     break;   
     case 9: $mes_med="Septiembre"; break;
     case 10:$mes_med="Octubre";    break;    
     case 11:$mes_med="Noviembre";  break;	  
     case 12:$mes_med="Diciembre";  break;
    }

    $ds_med=date('D',mktime(0,0,0,$mmed,$dmed,$ymed)); // muestra el dia p/e Wed=Mi�rcoles
    switch($ds_med)
    {
     case 'Sun': $d="Domingo";    break;      
     case 'Sat': $d="S&aacutebado";     break;      
     case 'Mon': $d="Lunes";      break;
     case 'Tue': $d="Martes";     break;      
     case 'Wed': $d="Mi&eacutercoles";  break;      
     case 'Thu': $d="Jueves";     break;
     case 'Fri': $d="Viernes";    break;
    }
    $fec_med=" ".$d.', '.$dmed.' de '.$mes_med.' de '.$ymed;	
    return $fec_med;
  }

  function FormatoCompletoFecha($fecha){
   $fparte=explode('-',$fecha);
    switch($fparte[1])
    {
     case 1: $mes_med="Enero";      break;    
     case 2: $mes_med="Febrero";    break;   
     case 3: $mes_med="Marzo";      break;
     case 4: $mes_med="Abril";      break;    
     case 5: $mes_med="Mayo";       break;  
     case 6: $mes_med="Junio";      break;
     case 7: $mes_med="Julio";      break;   
     case 8: $mes_med="Agosto";     break;   
     case 9: $mes_med="Septiembre"; break;
     case 10:$mes_med="Octubre";    break;    
     case 11:$mes_med="Noviembre";  break;	  
     case 12:$mes_med="Diciembre";  break;
    }

    $ds_med=date('D',mktime(0,0,0,$fparte[1],$fparte[2],$fparte[0])); // muestra el dia p/e Wed=Mi�rcoles
    switch($ds_med)
    {
     case 'Sun': $d="Domingo";    break;      
     case 'Sat': $d="S&aacutebado";     break;      
     case 'Mon': $d="Lunes";      break;
     case 'Tue': $d="Martes";     break;      
     case 'Wed': $d="Mi&eacutercoles";  break;      
     case 'Thu': $d="Jueves";     break;
     case 'Fri': $d="Viernes";    break;
    }
    $fec_med=$d.', '.$fparte[2].' de '.$mes_med.' de '.$fparte[0];	
    return $fec_med;
  }

  // ***** Convertimos el MES con nombre en espa�ol ******
  function mesObtener($m)
  {
   switch($m)
   { 	
    case 1:    $mes="Enero";      break;
    case 2:    $mes="Febrero";    break;
    case 3:    $mes="Marzo";      break;
    case 4:    $mes="Abril";      break;
    case 5:    $mes="Mayo";       break;
    case 6:    $mes="Junio";      break;
    case 7:    $mes="Julio";      break;
    case 8:    $mes="Agosto";     break;
    case 9:    $mes="Septiembre"; break;
    case 10:   $mes="Octubre";    break;
    case 11:   $mes="Noviembre";  break;
    case 12:   $mes="Diciembre";  break;
   }	
   return $mes;
  }

  //Convertimos el Dia en espa�ol
  function diaObtener($dmed,$mmed,$ymed)
  {
   $ds_med=date('D',mktime(0,0,0,$mmed,$dmed,$ymed)); // muestra el dia p/e Miercoles=Wed
   switch($ds_med)
   {
    case 'Sun': $d="Domingo";        break;      
    case 'Sat': $d="S&aacute;bado";     break;      
    case 'Mon': $d="Lunes";      break;
    case 'Tue': $d="Martes";     break;      
    case 'Wed': $d="Mi&eacutercoles";  break;      
    case 'Thu': $d="Jueves";     break;
    case 'Fri': $d="Viernes";    break;
   }
   return $d;
  }
}
?>
