<?php 
/**
 * View pdf para generar Orden de Pago.
 * @version 1.0
 * @author Emmanuel Sánchez Carreón
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 */

App::import('Vendor','tcpdf/config/lang/spa'); 
App::import('Vendor','tcpdf/tcpdf'); 

class XTCPDF  extends TCPDF { 
 function Header(){} 
 function Footer(){

  $this->SetY(-15);  $this->SetFont('helvetica','I',8);    $this->SetTextColor(120);
  $this->Cell(0,10,'',0,0,'L');$this->Ln(3);
  $this->Cell(0,10,'',0,0,'L');
  $this->Cell(0,10,'PÃ¡gina '.$this->PageNo(),0,0,'R');   //NÃºmero de pÃ¡gina
  $this->Ln(3);
 }

 function Encabezado($expediente,$fecha) {
  $urlogo='../webroot/img/logo/cb_logo.jpg';
  $this->Image($urlogo,'174','15',28,26, 'JPG',
               'http://www.htsjpuebla.gob.mx','',false, 150, '', false, false,'', false, false, false);

  $this->SetFillColor(107,107,107);   $this->SetTextColor(255); $this->SetFont('times','',5);
  $this->Cell(0.1); $this->Cell(160,2,'',0,0,'R',1);   
  $this->SetFont('times','',9);
  $this->Cell(0.1); $this->Cell(35,5,'EXPEDIENTE',0,0,'C',1);  
  $this->Ln(4);

  // define barcode style
  $style = array(
    'position' => '',
    'align' => 'R',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => 'R',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => false,
    'font' => 'times',
    'fontsize' => 10,
    'stretchtext' => 3
  );
  $this->Cell(25);
/*  $codebar=$this->write1DBarcode($expediente['Expediente']['id'], 'C39', '', '',80, 10,'', $style, 'N'); $this->Ln(0.3);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Expediente',1,0,'R',1); 
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,$expediente['Expediente']['id'],1,0,'L');  $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Juzgado',1,0,'R',1);  
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,strtoupper($expediente['Juzgado']['organo_judicial']),1,0,'L');  $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Cliente',1,0,'R',1);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,strtoupper($expediente['Cliente']['namefull']),1,0,'L');  $this->Ln(5);
*/
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);
  $this->Cell(0.1); $this->Cell(25,5,'Fecha de Emision',1,0,'R',1);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0);
  $this->Cell(0.1); $this->Cell(77,5,$fecha,1,0,'L');  $this->Ln(15);
 }


 function Resumen_Cuentas(){
  $wa=array(35,35,50);
  $w=array(30,30,30,30,30);
  $habono=array(
		'DEPOSITO',
		'SPEI',
	        'TOTAL'
  ); 

  $hcargo=array(
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
  $this->Cell(195,5,'ABONO',0,0,'L',0,false);   $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   //Abono
  for($i=0;$i<count($habono);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wa[$i],5,$habono[$i],1,0,'C',1);
   }	 $this->Ln(5);  

   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);    $this->SetFont('times','',9);

   //$this->Cell(0.1); $this->Cell($wa[0],5,$saldo['Deposito'],1,0,'C',false);
   //$this->Cell(0.1); $this->Cell($wa[1],5,$saldo['Spei'],1,0,'C',false); 
   //$this->Cell(0.1); $this->Cell($wa[2],5,$saldo['Abono'],1,0,'C',false);
   //$this->Ln(10);  

  $this->SetFont('times','B',9);
  $this->SetFillColor(255,255,255);  $this->SetTextColor(0); //Relleno BLANCO y NEGRO la letra 
  $this->Cell(195,5,'CARGO',0,0,'L',0,false);   $this->Ln(5);
  $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8); 

   for($i=0;$i<count($hcargo);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($w[$i],5,$hcargo[$i],1,0,'C',1);
   } $this->Ln(5);  

   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);    $this->SetFont('times','',9);

   //$this->Cell(0.1); $this->Cell($w[0],5,$saldo['Cheque'],1,0,'C',false);
   //$this->Cell(0.1); $this->Cell($w[1],5,$saldo['Dap'],1,0,'C',false); 
   //$this->Cell(0.1); $this->Cell($w[2],5,$saldo['Plastico'],1,0,'C',false);
   //$this->Cell(0.1); $this->Cell($w[3],5,$saldo['Traspaso'],1,0,'C',false);
   //$this->Cell(0.1); $this->Cell($w[4],5,$saldo['Cargo'],1,0,'C',false);
   $this->Ln(10);
 }

 function Transacciones($row){
  $this->SetFillColor(107,107,107); $this->SetTextColor(255); $this->SetFont('times','',9);
  $this->Cell(0.1); $this->Cell(55,5,'TRANSACCIONES EN EL PERIODO',0,0,'C',1);  
  $this->SetFont('times','',5); $this->Cell(0.1); $this->Cell(140,2,'',0,0,'R',1); $this->SetFont('times','B',9);
  $this->Ln(5);
  $j=$c=$d=$p=$t=1;

  $wEtapa=array(6,74,19,19,23,33,22);
  $wEvent=array(6,55,35,34,34,14,18);
  $wPago=array(6,35,35,35,20);
  $wParte=array(6,60,50,20,20,20,20);
  $headerEtapa=array(
		'#',
		'ETAPA',
		'ACUERDO',
	        'AUTO',
	        'NOTIFICACION',
		'REGISTRO',
		'TERMINACION'
  );

  $headerEvent=array(
		'#',
		'TITULO',
		'EVENTO',
	        'INICIO',
	        'FIN',
		'ALL DAY',
		'ESTADO'
  );

  $headerPago=array(
		'#',
		'ID',
		'MONTO',
	        'FECHA REGISTRO',
	        'STATUS'
  );        

  $headerParte=array(
		'#',
		'NOMBRE',
		'EMAIL',
		'TELEFONO',
	        'MOVIL',
	        'OFICINA',
		'TIPO'
  );


   //Etapa
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'ETAPAS',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerEtapa);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wEtapa[$i],5,$headerEtapa[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255);  $this->SetTextColor(0);  $this->SetFont('times','',11);   $fill=false;

 
   //Evento
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'EVENTOS',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerEvent);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wEvent[$i],5,$headerEvent[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $j=1;   $c=1;
   $fill=false;

   //Pago
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'PAGOS',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerPago);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wPago[$i],5,$headerPago[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $j=1;   $c=1;
   $fill=false;

   //Partes
   $this->Ln(3);
   $this->SetFillColor(255,255,255);  $this->SetTextColor(0);  $this->SetFont('times','B',9); 
   $this->Cell(195,5,'PARTES',0,0,'L',0,false);   $this->Ln(5);
   $this->SetFillColor(229,229,229);  $this->SetTextColor(68);  $this->SetFont('times','',8);
   $this->SetDrawColor(0,0,0);
   $this->SetLineWidth(.1);
   for($i=0;$i<count($headerParte);$i++){
    if ($i == 0) $this->Cell(0.1); else  $this->Cell(0.1);
    $this->Cell($wParte[$i],5,$headerParte[$i],1,0,'C',1);
   }	 
   $this->Ln(5);
   $this->SetFillColor(224,235,255); $this->SetTextColor(0);$this->SetFont('times','',11);
   $fill=false;


 }    

	
}

 $fecha=$this->Dates->fechaActual();
 $filename='e.pdf';//.$exp['Expediente']['id'].'_'.date('dmY').'.pdf';


 $pdf = new XTCPDF('P','mm','LETTER', true, 'UTF-8', false);

 //$pdf->encrypted  = 1;  //NO SE QUE HACE
 /*
   $pdf->SetProtection(array('modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble'),
			   //'print- high'),
		     $user_pass='sergio villalba');
   $pdf->SetProtection(array('copy'), '', null, 0, null);
   $pdf->SetProtection(array('print', 'copy'), '', null, 0, null);
 */
 // set document information
 $pdf->SetCreator(PDF_CREATOR);
 $pdf->SetAuthor('L.I. Emmanuel Sánchez Carreón');
 $pdf->SetTitle('Honorable Tribunal Superior de Justicia del Estado de Puebla');
 $pdf->SetSubject('Expediente');
 $pdf->SetKeywords('Caygsa, Expediente');

 $pdf->SetMargins(10,5,10,true);
 $pdf->SetHeaderMargin(0);
 //$pdf->setLanguageArray($l);

 //ob_start();
 $pdf->AddPage();
 //$markup = ob_get_clean();
 $pdf->Encabezado($exp,$fecha);
 //$pdf->Resumen_Cuentas();
 $pdf->Transacciones($exp);  
 $pdf->Output($filename, 'D');
?>
