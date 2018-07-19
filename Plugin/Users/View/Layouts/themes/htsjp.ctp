<?php
/**
 * Layout principal
 * @version 1.0
 * @author L.I. Emmanuel Sanchez Carreon
 * @email  esanchez@htsjpuebla.gob.mx
 * @email2 carreon.emmanuel@gmail.com
 *    
 */
?>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
					    'admin/reset',
				            'ddfm/style',
                                            'admin/forms', 
                                            'admin/fenix',
                                            'tablas',
		                            'fuentes',
					    'square',
             	                            'paginacion',
					    'actions-tools/style',
	                                    'ui-1.9.1/jquery-ui-1.9.1.custom',
                                            //'ui/jquery-ui-1.8.4.custom',
			                    'jboesch-gritter/jquery.gritter',
					    'http://fonts.googleapis.com/css?family=Amaranth',
		                            'http://fonts.googleapis.com/css?family=Linden Hill',
					    'http://fonts.googleapis.com/css?family=Tangerine',
					    'http://fonts.googleapis.com/css?family=Handlee',
					    'http://fonts.googleapis.com/css?family=Great Vibes',
					    'http://fonts.googleapis.com/css?family=Mate SC',
			      		    'http://fonts.googleapis.com/css?family=Italianno',
					    'http://fonts.googleapis.com/css?family=IM Fell English SC',
					    'http://fonts.googleapis.com/css?family=Judson',
					    'http://fonts.googleapis.com/css?family=Montaga',
					    'http://fonts.googleapis.com/css?family=Pompiere'
                                            )
                                       );
		echo $this->Html->script(array(
                                               'ui-lightness/jquery-1.8.2', 
				               'ui-lightness/jquery-ui-1.9.1.custom.min',
				               'ui-1.9.1/i18n/jquery.ui.datepicker-es',
		                               'jquery.gritter',
		                               'jquery.gritter.min',
                                               'ckeditor/ckeditor'
                                              )
                                         );
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                echo $this->Html->scriptBlock('var webroot="'.$this->webroot.'";');
		$layout = $this->Helpers->load('Dates');
?>
<script type="text/javascript">
//var js = jQuery.noConflict();
(function($){
	$(document).ready(function(){
		$( "#search" ).autocomplete({     			
					minLength: 2,
					source: webroot + "depositos/autoCompletado",
					focus: function( event, ui ){
						$( "#search" ).val( ui.item.Deposito.id ); 
						return false;
 					},
					select: function( event, ui ) {
						$("#resultados").hide('slow');
						$( "#search" ).val( ui.item.Deposito.id );
						var id = ui.item.Deposito.id;
						$.ajax({
						  url: webroot + "depositos/getData/" +id,
						  dataType: 'json',
						  success: function(data){
							var deposito = data.Deposito;
							var url = webroot + "depositos/view/"+ id;
							var html  = '<div id="inter_resultados"><div class="datos_curso">';
							    html += '<h3>Descripción del depósito:</h3><div class="desc">';
							    html += '<table border=0  class="testgrid">';
			          html += '<tr><th>Expediente</th><th>Concepto</th><th>Importe</th><th>Acción</th></tr>';
			               html +='<tr><td>'+deposito["htsjpexpediente_id"] + '</td>';
                                       html +='<td>'+deposito["htsjpconcepto_id"] + '</td>';
                                       html +='<td>'+deposito["importe"] + '</td>';
                                       html +='<td><a href="'+url+'">Ver</a></td></tr></table><br>';
                                       html +='</div></div></div>';
									$("#resultados").html(html);
									$("#resultados").show('slow');
						  }//success
						});
						return false;
					}//select
				}).data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
								.data( "item.autocomplete", item )
								.append( "<a>" + item.Deposito.id + "</a>" )
								.appendTo( ul );
				};//autocomplete
	});// document
})(jQuery);
</script>

</head>
<body>
<center>
 <header>
  <div class="tool">
   <div id="bartool"> 
     <div class="wrapper_autocomplete" align="right"> 
      <?php echo $this->Form->input('search', array('label'=>'','placeholder'=>'Busca un deposito')); ?>
     </div>
   </div>
  </div>
  <div id="title">
   <?php echo $this->Html->image("title/09.jpg", 
		                 array("width"=>"1026px",
				       "height"=>"180px"
		                 )); 
   ?>
  </div>
  <nav><?php echo 'Heróica Puebla de Zaragoza, '.$layout->fechaActual(); ?></nav>
 
</header>

 <div class="wrapper_all">
	<section class="content_left">
         <aside id="noticias-rel"><?php echo $this->element("tools");?></aside>
	</section>
	<section class="content_right">
		<section id="render">
			<?php echo $this->Session->flash(); ?>
                        <div id="resultados"></div>
			<?php echo $this->fetch('content'); ?>
		</section>
	</section>
 </div>
 <div class="footer">
 </div>
<footer>
 <div id="contenedorfooter"><?php echo $this->element("footer");?></div>
 <div id="footerfin">Copyright © 2011 Honorable Tribunal Superior de Justicia del Estado de Puebla.</div>
<!-- ©2010 Honorable Tribunal Superior de Justicia del Estado de Puebla. | Poder Judicial del Estado de Puebla. | Departamento de Depósitos, Fianzas y Multas. -->
</footer>

   <?php 
	echo $this->element('sql_dump'); 
	echo $this->Js->writeBuffer(); // Write cached scripts  
   ?>
</center>
</body>
</html>
