<?php 
/**
 * View pdf para generar Orden de Pago.
 * @version 1.0
 * @author Emmanuel Sánchez Carreón
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
App::import('Vendor','tcpdf/config/lang/spa'); 
App::import('Vendor','tcpdf/tcpdf'); 

class XTCPDF  extends TCPDF { 
 function Header(){} 
 function Footer(){
  $this->SetY(-15);  $this->SetFont('helvetica','I',8);    $this->SetTextColor(120);
  $this->Cell(0,10,'Honorable Tribunal Superior de Justicia del Estado de Puebla.',0,0,'L');$this->Ln(3);
  $this->Cell(0,10,'Palacio de Justicia   |  5 Oriente nÃºmero 9 col. Centro HistÃ³rico   |  TelÃ©fono(s): (222) 229.66.00',0,0,'L');
  $this->Cell(0,10,'PÃ¡gina '.$this->PageNo(),0,0,'R');   //NÃºmero de pÃ¡gina
  $this->Ln(3);
 }

 function Encabezado($juzgado,$fecha,$saldo,$fechamovimientos) {
  $urlogo='../webroot/img/logos/pj.jpg';
  $this->Image($urlogo,'174','15',28,26, 'JPG',
               'http://www.htsjpuebla.gob.mx','',false, 150, '', false, false,'', false, false, false);

  $this->SetFillColor(107,107,107);   $this->SetTextColor(255); $this->SetFont('times','',5);
  $this->Cell(0.1); $this->Cell(160,2,'',0,0,'R',1);   
  $this->SetFont('times','',9);
  $this->Cell(0.1); $this->Cell(35,5,'ESTADO DE CUENTA',0,0,'C',1);  $this->Ln(12);
  $this->Cell(25);
  $this->Ln(0.1);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Juzgado',1,0,'R',1); 
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,$juzgado['Juzgado']['descripcion'],1,0,'L');  $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Depositos',1,0,'R',1);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,'$**'.$saldo['SaldoNuevo']['Deposito'],1,0,'L');  $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Pagos',1,0,'R',1);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,'$**'.$saldo['SaldoNuevo']['Pagado'],1,0,'L');  $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Fecha de Emision',1,0,'R',1);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,$fecha,1,0,'L');  $this->Ln(18);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0); //Relleno BLANCO y NEGRO la letra 
  $this->Cell(195,5,$fechamovimientos,0,0,'R',0,false);   $this->Ln(5);
 }


 function Resumen_Cuentas($url,$saldo){
  $w=array(35,35,35,35,50);
  $header=array(
		'CHEQUE',
		'DAP',
		'PLASTICO',
		'TRASPASO',
	        'TOTAL'
  ); 

  $this->SetFillColor(107,107,107);   $this->SetTextColor(255);
  $this->SetFont('times','',9);
  $this->Cell(0.1); $this->Cell(45,5,'RESUMEN DE CUENTAS',0,0,'C',1);  
  $this->SetFont('times','',5);
  $this->Cell(0.1); $this->Cell(150,2,'',0,0,'R',1);   
  $this->Ln(7);

  $this->SetFont('times','B',9);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0); //Relleno BLANCO y NEGRO la letra 
  $this->Cell(195,5,'PAGOS',0,0,'L',0,false);   $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
 
   for($i=0;$i<count($header);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($w[$i],5,$header[$i],1,0,'C',1);
   }	 $this->Ln(5);  

   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);    $this->SetFont('times','',9);

   $this->Cell(0.1); $this->Cell($w[0],5,'$**'.$saldo['SaldoNuevo']['Cheque'],1,0,'C',false);
   $this->Cell(0.1); $this->Cell($w[1],5,'$**'.$saldo['SaldoNuevo']['Dap'],1,0,'C',false); 
   $this->Cell(0.1); $this->Cell($w[2],5,'$**'.$saldo['SaldoNuevo']['Plastico'],1,0,'C',false);
   $this->Cell(0.1); $this->Cell($w[3],5,'$**'.$saldo['SaldoNuevo']['Traspaso'],1,0,'C',false);
   $this->Cell(0.1); $this->Cell($w[4],5,'$**'.$saldo['SaldoNuevo']['Pagado'],1,0,'C',false);
   $this->Ln(10);   
 }

 function Transacciones($saldo){
  $this->SetFillColor(107,107,107); $this->SetTextColor(255); $this->SetFont('times','',9);
  $this->Cell(0.1); $this->Cell(55,5,'TRANSACCIONES EN EL PERIODO',0,0,'C',1);  
  $this->SetFont('times','',5); $this->Cell(0.1); $this->Cell(140,2,'',0,0,'R',1);   
  $this->Ln(5);
  $this->SetFont('times','B',9);
  $j=$c=$d=$p=$t=1;
  $w=array(6,55,30,18,30);
  $wCheque=array(6,20,30,30,20,30);
  $wDap=array(6,55,30,30,20,30);
  $wPlastico=array(6,55,30,30,20,30);
  $wTraspaso=array(6,25,30,30,30,20,30);
  $header=array(
		'#',
		'REFERENCIA',
		'CUENTA',
		//'CONCEPTO',
	        'DEPOSITO',
		'CANTIDAD'
  );

  $headerCheque=array(
		'#',
		'CHEQUE',
		'CUENTA',
	        'ORDEN DE PAGO',
	        'STATUS',
		'CANTIDAD'
  );

  $headerDap=array(
		'#',
		'REFERENCIA',
		'CUENTA',
	        'ORDEN DE PAGO',
	        'STATUS',
		'CANTIDAD'
  );    

  $headerPlastico=array(
		'#',
		'NUM. TARJETA',
		'CUENTA',
	        'ORDEN DE PAGO',
	        'STATUS',
		'CANTIDAD'
  );

  $headerTraspaso=array(
		'#',
		'FOLIO',
		'CUENTA EMISORA',
		'CUENTA RECEPTORA',
	        'ORDEN DE PAGO',
	        'STATUS',
		'CANTIDAD'
  );
   //Cheque
  $this->Ln(3);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
  $this->Cell(195,5,'DEPOSITOS',0,0,'L',0,false);   $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
  $this->SetDrawColor(0,0,0);
  $this->SetLineWidth(.1);
  for($i=0;$i<count($header);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($w[$i],5,$header[$i],1,0,'C',1);
  }	 
  $this->Ln(5);
  $this->SetFillColor(224,235,255);  $this->SetTextColor(0);  $this->SetFont('times','',11);   $fill=false;

  foreach ($saldo['MovimientosSaldo']['Deposito'] as $deposito): 
    $this->SetFont('times','',10); $this->Cell(0.1); $this->Cell($w[0],5,$j,1,0,'C', $fill);    
    $this->Cell(0.1); $this->Cell($w[1],5,$deposito['Ficha']['id'],1,0,'C',  $fill);  
    $this->Cell(0.1); $this->Cell($w[2],5,$deposito['Ficha']['htsjpcuenta_id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($w[3],5,$deposito['Ficha']['fecha_deposito'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($w[4],5,'$**'.$deposito['Ficha']['importe'],1,0,'C',  $fill);        
    $this->Ln(5);	
    $j++; $fill=!$fill;
   endforeach;

   //Cheque
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'PAGOS POR CHEQUE',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerCheque);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wCheque[$i],5,$headerCheque[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $j=1;   $c=1;
   $fill=false;

   foreach ($saldo['MovimientosSaldo']['Cheque'] as $cheque): 
    $this->SetFont('times','',10); $this->Cell(0.1); $this->Cell($w[0],5,$c,1,0,'C', $fill);    
    $this->Cell(0.1); $this->Cell($wCheque[1],5,$cheque['Cheque']['num_cheque'],1,0,'C',  $fill);  
    $this->Cell(0.1); $this->Cell($wCheque[2],5,$cheque['OrdenPago']['htsjpcuenta_id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wCheque[3],5,$cheque['OrdenPago']['id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wCheque[4],5,$cheque['Cheque']['estado'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wCheque[5],5,'$**'.$cheque['OrdenPago']['importe'],1,0,'C',  $fill);        
    $this->Ln(5);
    $c++; $fill=!$fill;
   endforeach;

   //DAP
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'PAGOS POR DAP',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerDap);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wDap[$i],5,$headerDap[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $fill=false;

   foreach ($saldo['MovimientosSaldo']['Dap'] as $dap): 
    $this->SetFont('times','',10); $this->Cell(0.1); $this->Cell($w[0],5,$d,1,0,'C', $fill);    
    $this->Cell(0.1); $this->Cell($wDap[1],5,$dap['Dap']['referencia'],1,0,'C',  $fill);  
    $this->Cell(0.1); $this->Cell($wDap[2],5,$dap['OrdenPago']['htsjpcuenta_id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wDap[3],5,$dap['OrdenPago']['id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wDap[4],5,$dap['Dap']['estado'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wDap[5],5,'$**'.$dap['OrdenPago']['importe'],1,0,'C',  $fill);
    $this->Ln(5);
    $d++; $fill=!$fill;
   endforeach;

   //Plastico
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'PAGOS POR PLASTICO',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerPlastico);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wPlastico[$i],5,$headerPlastico[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $fill=false;

   foreach ($saldo['MovimientosSaldo']['Plastico'] as $dap): 
    $this->SetFont('times','',10); $this->Cell(0.1); $this->Cell($w[0],5,$p,1,0,'C', $fill);    
    $this->Cell(0.1); $this->Cell($wPlastico[1],5,$dap['Plastico']['num_plastico'],1,0,'C',  $fill);  
    $this->Cell(0.1); $this->Cell($wPlastico[2],5,$dap['OrdenPago']['htsjpcuenta_id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wPlastico[3],5,$dap['OrdenPago']['id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wPlastico[4],5,$dap['Plastico']['estado'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wPlastico[5],5,'$**'.$dap['OrdenPago']['importe'],1,0,'C',  $fill);
    $this->Ln(5);
    $p++; $fill=!$fill;
   endforeach;

   //Traspaso
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'PAGOS POR TRASPASO',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerTraspaso);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wTraspaso[$i],5,$headerTraspaso[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $fill=false;

   foreach ($saldo['MovimientosSaldo']['Traspaso'] as $dap): 
    $this->SetFont('times','',10); $this->Cell(0.1); $this->Cell($w[0],5,$t,1,0,'C', $fill);    
    $this->Cell(0.1); $this->Cell($wTraspaso[1],5,$dap['Traspaso']['folio'],1,0,'C',  $fill);  
    $this->Cell(0.1); $this->Cell($wTraspaso[2],5,$dap['OrdenPago']['htsjpcuenta_id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wTraspaso[3],5,$dap['Traspaso']['htsjpcuenta_id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wTraspaso[4],5,$dap['OrdenPago']['id'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wTraspaso[5],5,$dap['Traspaso']['estado'],1,0,'C',  $fill);
    $this->Cell(0.1); $this->Cell($wTraspaso[6],5,'$**'.$dap['OrdenPago']['importe'],1,0,'C',  $fill);
    $this->Ln(5);
    $t++; $fill=!$fill;
   endforeach;  
 }    

	
}
 $dataurl=$this->params['url'];
 $fini=explode('-',$dataurl['fecini']);
 $ffin=explode('-',$dataurl['fecfin']);
 $fecha=$this->Dates->fechaActual();
 $fmovi='Movimientos del '.$this->Dates->fechaObtener($fini[2],$fini[1],$fini[0]).' a '.
 $this->Dates->fechaObtener($ffin[2],$ffin[1],$ffin[0]);
 $filename='o'.$folio.'_'.date('dmY').'.pdf';
 $juz_desc=strtoupper($juzgados['Juzgado']['descripcion']);

 $pdf = new XTCPDF('P','mm','LETTER', true, 'UTF-8', false);

 // set document information
 $pdf->SetCreator(PDF_CREATOR);
 $pdf->SetAuthor('L.I. Emmanuel Sánchez Carreón');
 $pdf->SetTitle('Honorable Tribunal Superior de Justicia del Estado de Puebla');
 $pdf->SetSubject('Orden de Pago');
 $pdf->SetKeywords('DDFM, Orden de pago, Expediente');

 $pdf->SetMargins(10,5,10,true);
 $pdf->SetHeaderMargin(0);
 $pdf->setLanguageArray($l);

 $pdf->AddPage();
 $markup = ob_get_clean();

 $pdf->Encabezado($descjuzgado,$fecha,$saldo,$fmovi);
 $pdf->Resumen_Cuentas($dataurl,$saldo);
 $pdf->Transacciones($saldo);  
 $pdf->Output($filename, 'I');
?>
