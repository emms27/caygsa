<?php

/**
 * Helper para mostrar un select list de todos los paises.
 * @version 1.0
 * @author Emmanuel Sanchez Carreon
 * @link http://www.pedroventura.com/blog_programacion/2009/10/08/cakephp-helper-para-crear-un-listado-de-paises/
 *
 */

class EscolaridadHelper extends AppHelper
{

 public $helpers = array('Form');

 function ComboEscolaridad($camponombre, $label=null, $default=null, $atributos=null)
 {
  $escolaridad=array('Primaria'=>'Primaria',
  	             'Secundaria'=>'Secundaria',
	             'Bachiller'=>'Bachiller',
	             'Tecnico'=>'Tecnico',
	             'Licenciatura'=>'Licenciatura',
	             'Ingeniería'=>'Ingeniería',
	             'Maestría'=>'Maestría',
	             'Doctorado'=>'Doctorado',
	             'Sin estudios'=>'Sin estudios',
	             'otro'=>'otro'
                    );


 
 $list = '';
 //if ($label!=null) $list .= $this->Form->label($label);

 $list .= $this->Form->input($camponombre, 
			     array('options' => $escolaridad,
				   'label'=>$label,
				   'empty' => 'Por favor, seleccione...'
                                  )
                            );

// $list .= $this->Form->input($camponombre , , $default, $atributos,false);
 $list .= '';


 return $this->output($list);
 }


}

?>
