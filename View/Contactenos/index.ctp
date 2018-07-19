<?php  echo $this->Html->script(array('jquery.jeditable.mini')); ?>
<?php 
/**
 * View alta almacenamiento de Depositos.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *
 */
?>
<div class="breadcrumb">
       <?php
         echo $this->Html->link('', 
                                array('controller'=>'pages','action'=>'home'),
				array('title'=>'Inicio','escape' => false,'class'=>'icon-home'));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Iglesias', 
                                array('controller'=>'Iglesias','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Consulta', 
                                array('controller'=>'Iglesias','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
         echo '<span class="divider">/</span>';
         echo $this->Html->link('Iglesias', 
                                array('controller'=>'Iglesias','action'=>'index'),
				array('title'=>'Inicio','escape' => false));
       ?>
</div><br><br>
<table border="0">
 <tr>
  <td width="4%" align="center">
   <?php echo $this->Html->image("icons/icon_view.png",array("width"=>"28px","height"=>"28px","border"=>"0")); ?>
  </td>
  <td width="55%"><h1>Consulta Mensaje del Contacto</h1></td>
  <td width="45%">
   <?php echo $this->Form->create('Contacteno',array('action'=>'index')); ?>
   <table border="0">
    <tr>
     <td><?php  echo $this->Form->input('sorden', 
					array('label'=>'',
  			   		      'id'=>'sorden',
		 			      'type'=>'search',
					      'placeholder'=>'Busca una predicación',
					      'style'=>'border:1px solid gray;',
		                              'x-webkit-speech speech required onspeechchange'=>'startSearch();',
                                              'autocapitalize'=>"on", 'autocomplete'=>"on",'autocorrect'=>"on" 
            )); 
          ?>
      </td>
      <td><?php echo $this->Form->end('Buscar'); ?></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td colspan="3" class="arial11gris" align="left">
   La consulta de mensajes te muestran todos los mensaje emitidos en la sección de contacto del Ministerio El Cielo en La Tierra.<br><br>
  </td>
 </tr>
 <tr>
  <td colspan="3">
   <div style="border:1px solid #666666; background-color:#F4EDD5; padding:2px;">
    <p class="verdana11azul">» Total de registros encontrados: 
    <strong><?php echo $this->Paginator->counter(array('format' => '%count%')); ?></strong>.</br>
    » Se mostrar&aacute; un total de <strong>50</strong> registros por p&aacute;gina.</br>
    » Usted se encuentra consultando la p&aacute;gina 
    <strong><?php echo $this->Paginator->counter(array('format' => '%page% de %pages%')); ?></strong>.
    </p>
   </div>
  </td>
 </tr>
</table>
<div class="paging">
<?php echo $this->Paginator->prev('« Anterior', null, null, array('class' => 'disabled')); ?>
<?php echo $this->Paginator->numbers(array('modulus'=>'9','separator' => ''));  ?>
<?php echo $this->Paginator->next('Siguiente »', null, null, array('class' => 'disabled')); ?> 
</div></br></br>


<table border=0  class="testgrid">
 <?php
   echo $this->Html->tableHeaders(
       array(
             $this->Paginator->sort('Contacteno.id', '#'),
             $this->Paginator->sort('Contacteno.nombre', 'nombre'),
             $this->Paginator->sort('Contacteno.asunto', 'asunto'),
             $this->Paginator->sort('Contacteno.email', 'email'),
             $this->Paginator->sort('Contacteno.pais', 'pais'),
             $this->Paginator->sort('Contacteno.estado', 'status'),
             $this->Paginator->sort('Contacteno.fecha_registro', 'Creación'),

	     'Acci&oacute;n'
           )); 
 
    $n=1; foreach ($peticiones as $peticion):
     $idemail='divemail_'.$peticion['Contacteno']['id'];
     $idpais='divpais_'.$peticion['Contacteno']['id']; 
  ?>
   <tr>
        <td><?php echo $peticion['Contacteno']['id']; ?></td>
        <td><?php echo $peticion['Contacteno']['nombre']; ?></td>
        <td><?php echo $peticion['Contacteno']['asunto']; ?></td>
        <td><div class="edit" id="<?php echo $idemail; ?>"><?php echo $peticion['Contacteno']['email']; ?> </div>
		<?php
		echo $this->Ajax->editor($idemail, 
		    array(
			'controller' => 'Contacteno', 
			'action' => 'upemail',$peticion['Contacteno']['id']
		         ), 
		    array(
			'indicator' => $this->Html->image('loading.gif'),
			'submit' => 'OK',
			'cancel' => 'Cancel',
		        'onblur' => 'submit',
			'style'  => 'inherit',
			'id'     => $peticion['Contacteno']['id'],
		        'name'   => 'data[Contacteno][email]',                      
		       // 'type' => 'text',
			'submitdata' => array('email'=>2),
			'tooltip'    => 'Clic para editar...',
		        'width'  => '220px',
		        'height' => '15px'
			)
		    );
		?>
        </td>

        <td><div class="edit" id="<?php echo $idpais; ?>"><?php echo $peticion['Contacteno']['pais']; ?> </div>
		<?php
		echo $this->Ajax->editor($idpais, 
		    array(
			'controller' => 'Contactenos', 
			'action' => 'uppais',$peticion['Contacteno']['id']
		         ), 
		    array(
			'indicator' => $this->Html->image('loading.gif'),
			'submit' => 'OK',
			'cancel' => 'Cancel',
		        'onblur' => 'submit',
			'style'  => 'inherit',
			'id'     => $peticion['Contacteno']['id'],
		        'name'   => 'data[Contacteno][pais]',                           
		        'type' => 'select',
                        'data' => array(
					 'AF'=>'Afganistán',
					 'AL'=>'Albania',
					 'DE'=>'Alemania',
					 'AD'=>'Andorra',
					 'AO'=>'Angola',
					 'AI'=>'Anguila',
					 'AQ'=>'Antártica',
					 'AG'=>'Antigua y Barbuda',
					 'AN'=>'Antillas Holandesas',
					 'SA'=>'Arabia Saudá',
					 'DZ'=>'Argelia',
					 'AR'=>'Argentina',
					 'AM'=>'Armenia',
					 'AW'=>'Aruba',
					 'AU'=>'Australia',
					 'AT'=>'Austria',
					 'AZ'=>'Azerbaiján',
					 'BE'=>'Bélgica',
				 	 'BS'=>'Bahamas',
					 'BH'=>'Bahrain',
					 'BD'=>'Bangladesh',
					 'BB'=>'Barbados',
					 'BY'=>'Belarus',
					 'BZ'=>'Belice',
					 'BJ'=>'Benin',
					 'BM'=>'Bermuda',
				 	 'BO'=>'Bolivia',
					 'BA'=>'Bosnia-Hercegovina',
					 'BW'=>'Botswana',
					 'BR'=>'Brasil',
					 'BN'=>'Brunei Darussalam',
					 'BG'=>'Bulgaria',
				 	 'BF'=>'Burkina Faso',
					 'BI'=>'Burundi',
					 'BT'=>'Bután',
					 'CV'=>'Cabo Verde',
					 'KH'=>'Camboya',
					 'CM'=>'Camerún',
					 'CA'=>'Canadá',
					 'TD'=>'Chad',
					 'CL'=>'Chile',
					 'CN'=>'China',
					 'CY'=>'Chipre',
					 'VA'=>'Ciudad del Vaticano',
					 'CO'=>'Colombia',
					 'KM'=>'Comoras',
					 'CG'=>'Congo',
					 'KP'=>'Corea del Norte',
					 'KR'=>'Corea del Sur',
					 'CI'=>'Costa de Marfil',
					 'CR'=>'Costa Rica',
					 'HR'=>'Croacia',
					 'CU'=>'Cuba',
					 'DK'=>'Dinamarca',
					 'DJ'=>'Djibuti',
					 'DM'=>'Dominica',
					 'EC'=>'Ecuador',
					 'EG'=>'Egipto',
					 'SV'=>'El Salvador',
					 'AE'=>'Emiratos Árabes Unidos',
					 'ER'=>'Eritrea',
					 'SK'=>'Eslovaquia',
					 'SI'=>'Eslovenia',
					 'SP'=>'España',
					 'EE'=>'Estonia',
					 'ET'=>'Etiopía',
					 'RU'=>'Federación Rusa',
					 'FJ'=>'Fiji',
					 'PH'=>'Filipinas',
					 'FI'=>'Finlandia',
					 'FR'=>'Francia',
					 'FX'=>'Francia Metropolitana',
					 'GA'=>'Gabón',
					 'GM'=>'Gambia',
					 'GE'=>'Georgia',
					 'GS'=>'Georgia del Sur e Islas Sandwich del Sur',
					 'GH'=>'Ghana',
					 'GI'=>'Gibraltar',
					 'GR'=>'Grecia',
					 'GL'=>'Groenlandia',
					 'GP'=>'Guadalupe',
					 'GU'=>'Guam',
					 'GT'=>'Guatemala',
					 'GF'=>'Guayana Francesa',
					 'GN'=>'Guinea',
					 'GQ'=>'Guinea Ecuatorial',
					 'GW'=>'Guinea-Bissau',
					 'GY'=>'Guyana',

					 'HT'=>'Haití',
					 'HN'=>'Honduras',
					 'HK'=>'Hong Kong',
					 'HU'=>'Hungría',
					 'IN'=>'India',
					 'ID'=>'Indonesia',
					 'IR'=>'Irán',
					 'IQ'=>'Irak',
					 'IE'=>'Irlanda',
					 'BV'=>'Isla Bouvet',
					 'CX'=>'Isla Christmas',
					 'NF'=>'Isla Norfolk',
					 'IS'=>'Islandia',
					 'KY'=>'Islas Caimanes',
					 'CC'=>'Islas Cocos (Keeling)',
					 'CK'=>'Islas Cook',
					 'FO'=>'Islas Faroe',
					 'HM'=>'Islas Heard y Mc Donald',
					 'FK'=>'Islas Malvinas',
					 'MP'=>'Islas Marianas Septentrionales',
					 'MH'=>'Islas Marshall',
					 'SB'=>'Islas Salomón',
					 'SJ'=>'Islas Svalbard y Jan Mayen',
					 'TC'=>'Islas Turks y Caicos',
					 'VG'=>'Islas Vírgenes (Británicas)',
					 'VI'=>'Islas Vírgenes (EEUU)',
					 'WF'=>'Islas Wallis y Futuna',
					 'IL'=>'Israel',
					 'IT'=>'Italia',
					 'JM'=>'Jamaica',
					 'JP'=>'Japón',
					 'JO'=>'Jordania',
					 'QA'=>'Katar',
					 'KZ'=>'Kazajistán',
					 'KE'=>'Kenia',
					 'KG'=>'Kirguizistán',
					 'KI'=>'Kiribati',
					 'KW'=>'Kuwait',
					 'LB'=>'Líbano',
					 'LA'=>'Laos, República Popular',
					 'LS'=>'Lesoto',
					 'LV'=>'Letonia',
					 'LR'=>'Liberia',
					 'LY'=>'Libia',
					 'LI'=>'Liechtenstein',
					 'LT'=>'Lituania',
					 'LU'=>'Luxemburgo',
					 'MX'=>'México',
					 'MC'=>'Mónaco',
					 'MO'=>'Macao',
					 'MK'=>'Macedonia',
					 'MG'=>'Madagascar',
					 'MY'=>'Malasia',
					 'MW'=>'Malaui',
					 'MV'=>'Maldivas',
					 'ML'=>'Mali',
					 'MT'=>'Malta',
					 'MA'=>'Marruecos',
					 'MQ'=>'Martinica',
					 'MU'=>'Mauricio',
					 'MR'=>'Mauritania',
					 'YT'=>'Mayotte',
					 'FM'=>'Micronesia',
					 'MD'=>'Moldova',
					 'MN'=>'Mongolia',
					 'MS'=>'Montserrat',
					 'MZ'=>'Mozambique',
					 'MM'=>'Myanmar',
					 'NE'=>'Níger',
					 'NA'=>'Namibia',
					 'NR'=>'Nauru',
					 'NP'=>'Nepal',
					 'NI'=>'Nicaragua',
					 'NG'=>'Nigeria',
					 'NU'=>'Niue',
					 'NO'=>'Noruega',
					 'NC'=>'Nueva Caledonia',
					 'NZ'=>'Nueva Zelanda',
					 'OM'=>'Omán',
					 'NL'=>'Países Bajos',
					 'PK'=>'Pakistán',
					 'PW'=>'Palau',
					 'PA'=>'Panamá',
					 'PG'=>'Papua Nueva Guinea',
					 'PY'=>'Paraguay',
					 'PE'=>'Perú',
					 'PN'=>'Pitcairn',
					 'PF'=>'Polinesia Francesa',
					 'PL'=>'Polonia',
					 'PT'=>'Portugal',
					 'PR'=>'Puerto Rico',
					 'GB'=>'Reino Unido',
					 'SY'=>'República Árabe de Siria',
					 'CF'=>'República Centroafricana',
					 'CZ'=>'República Checa',
					 'DO'=>'República Dominicana',
					 'RE'=>'Reunión',
					 'RW'=>'Ruanda',
					 'RO'=>'Rumanía',
					 'EH'=>'Sahara Occidental',
					 'WS'=>'Samoa',
					 'AS'=>'Samoa Americana',
					 'KN'=>'San Cristóbal y Nevis',
					 'SM'=>'San Marino',
					 'VC'=>'San Vicente y las Granadinas',
					 'SH'=>'Santa Elena',
					 'LC'=>'Santa Lucía',
					 'ST'=>'Santo Tomé y Príncipe',
					 'SN'=>'Senegal',
					 'yu'=>'Serbia y Montenegro',
					 'SC'=>'Seychelles',
					 'SL'=>'Sierra Leona',
					 'SG'=>'Singapur',
					 'SO'=>'Somalía',
					 'LK'=>'Sri Lanka',
					 'PM'=>'St Pierre y Miquelon',
					 'SZ'=>'Suazilandia',
					 'ZA'=>'Sudáfrica',
					 'SD'=>'Sudán',
					 'SE'=>'Suecia',
					 'CH'=>'Suiza',
					 'SR'=>'Surinam',
					 'TN'=>'Túnez',
					 'TH'=>'Tailandia',
					 'TW'=>'Taiwan',
					 'TZ'=>'Tanzanía',
					 'TJ'=>'Tayiquistán',
					 'TF'=>'Territorios australes y antárticos franceses',
					 'IO'=>'Territorios Británicos del Océano Índico',
					 'TP'=>'Timor Oriental',
					 'TG'=>'Togo',
					 'TK'=>'Tokelau',
					 'TO'=>'Tonga',
					 'TT'=>'Trinidad y Tobago',
					 'TM'=>'Turkmenistán',
					 'TR'=>'Turquía',
					 'TV'=>'Tuvalu',
					 'UA'=>'Ucrania',
					 'UG'=>'Uganda',
					 'UY'=>'Uruguay',
					 'US'=>'USA',
					 'UZ'=>'Uzbekistán',
					 'VU'=>'Vanuatu',
					 'VE'=>'Venezuela',
					 'VN'=>'Vietnam',
					 'YE'=>'Yemen',
					 'ZR'=>'Zaire',
					 'ZM'=>'Zambia',
					 'ZW'=>'Zimbabue',
					 'ZZ'=>'Otros-No indicados'
				      ), 
			'submitdata' => array('email'=>2),
			'tooltip'    => 'Clic para editar...',
		        'width'  => '220px',
		        'height' => '15px'
			)
		    );
		?>
        </td>
        <td><?php echo $peticion['Contacteno']['estado']; ?></td>
        <td><?php echo $peticion['Contacteno']['fecha_registro']; ?></td>
    <td><center>
     <ul class="actions-tools">
      <li>
       <?php 
	echo $this->Html->link(__('Ver'), 
	  	array('action' => 'view', $peticion['Contacteno']['id']), 
		array('class'=>'view')
               );
/*
	echo $this->Form->postLink(_('Cancelar'),
                array('action' => 'cancel', $imagen['Imagene']['id']),
		array('class'=>'cancel'), __('¿Realmente desea cancelar este deposito %s?', $imagen['Imagene']['id'])
               );
*/
       ?>

       </li>
      </ul></center>
     </td>
    </tr>
    <?php endforeach; ?>
	
	
</table>
</div>

 
