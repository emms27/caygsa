<?php 
//App::import('Vendor','tcpdf/config/lang/spa'); //require_once('../config/lang/eng.php');
//App::import('Vendor','tcpdf/tcpdf'); 


App::import('Vendor','xtcpdf'); 



 

//$pdf = new XTCPDF(); 


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->encrypted  = 1;    NO FURULA

//PARA poner contraseña y para imprimir o no
                                                                    //print = para no imprimir ni guardar
//$pdf->SetProtection(array('modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble', 'print-high'), $user_pass='me'); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Lic. Emmanuel Sanchez Carreon');
$pdf->SetTitle('Honorable Tribunal Superior de Justicia del Estado de Puebla');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$title='Honorable Tribunal Superior de Justicia del Estado de Puebla';
$departamento='Departamento de Depositos, Fianzas y Multas';
$logo='pj_logo.jpg';
$urlogo='http://localhost/cake_2_1/app/webroot/img/bancomer_logo.jpg';
$logo_width=20;
$font=array('times', '', 14, '', true);
$fontfoot=array('helvetica', '', 10, '', true);
$fontheader=array('courier', '', 10, '', true);
$pdf->SetHeaderData($logo,$logo_width,$title,$departamento);

// set header and footer fonts
$pdf->setHeaderFont($font);
$pdf->setFooterFont($fontfoot);
//$pdf->xheadertext = 'Fecha: '. date('d-m-Y',time());


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$referencia='123456789012345789';
$pdf->setBarcode($referencia);

/* set some language dependent data:
$l = Array();
$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr';
$l['a_meta_language'] = 'es';
$l['w_page'] = 'página';
$pdf->setLanguageArray($l);
*/
//$pdf->setLanguageArray($l);
// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


 $pdf->Ln(5); 
 //Colores, ancho de línea y FUENTE en negro y RELLENO blanco
 $pdf->SetFillColor(255,255,255); //RELLENO blanco
 $pdf->SetTextColor(0); //NEGRO la letra 
 $pdf->Cell(0.1); $pdf->Cell(80,14,'',0,0,'C',1); 
 
// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => false,
    'font' => 'times',
    'fontsize' => 7,
    'stretchtext' => 3
);

// PRINT VARIOUS 1D BARCODES
    
  $codebar=$pdf->write1DBarcode('1234567890123456789', 'C39', '', '', '', 14, 0.3, $style, 'N');
  $pdf->Ln(.1);
   
  $w=array(30,100,50);  
  $header=array('EXPEDIENTE','NOMBRE','CANTIDAD A PAGAR'); 
  
  //Colores, ancho de línea y fuente en Blanco y RELLENO gris
   $pdf->SetFont('times','',7);
   $pdf->SetFillColor(107,107,107);
   $pdf->SetTextColor(255); 
 
  //encabezado de la tabla
   for($i=0;$i<count($header);$i++) {$pdf->Cell(0.1); $pdf->Cell($w[$i],5,$header[$i],1,0,'C',1);} 
   $pdf->Ln(5);
   
   $pdf->SetFillColor(255,255,255); //RELLENO blanco
   $pdf->SetTextColor(0); //NEGRO la letra 
   $pdf->Cell(0.1); $pdf->Cell($w[0],5,'0150/2010',1,0,'C',1); 
   $pdf->Cell(0.1); $pdf->Cell($w[1],5,'Emmanuel Sanchez Carreon',1,0,'C',1); 
   $pdf->Cell(0.1); $pdf->Cell($w[2],5,'$259.25',1,0,'C',1); $pdf->Ln(5);
   


// Table with rowspans and THEAD      <img src="pj_logo.jpg">
$tbl = <<<EOD
<table border="1" cellpadding="2" cellspacing="2" width="100%">
<thead>
 <tr style="background-color:#FFFF00;color:#0000FF;">
  <td width="100%" align="center" rowspan="6"><b>A</b></td>
 </tr>
</thead>
 <tr>
  <td width="10%" align="center">1.</td>
  <td width="10%">CONVENIO: fasfasfsfasfasfafafafafadfasdfadfasdf </td>
  <td width="20%">90270</td>
  <td width="60%"></td>
  
 </tr>
 <tr>
  <td width="10%" align="center">2.</td>
  <td width="10%">REFERENCIA: </td>
  <td width="20%">1234567890123456789</td>
  <td width="60%"></td>
 </tr>
 
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');


// Example of Image from data stream ('PHP rules')
$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');

// The '@' character is used to indicate that follows an image data stream and not an image file name
//$pdf->Image('@'.$imgdata);

$html = '<img src="'.$imgdata.'" alt="test alt attribute" width="100" height="100" border="0" />';

 // output the HTML content
 $pdf->writeHTML($html, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// configuramos la calidad de JPEG
$pdf->setJPEGQuality(100);
$pdf->Image($urlogo,'','',56,12, 'JPG', 'http://www.bancomer.com.mx','',false, 150, '', false, false,'', false, false, false);

//
//$pdf->Image($urlogo, '', '',18,17, '', '', 'T', false, 300, '', false, false,0, false, false, false);



$filename='ficha_'.date('dmY').'.pdf';
//$pdf->Output($filename, 'I'); //el pdf se queda en el navegador
$pdf->Output($filename, 'D'); //el pdf se descarga

?>