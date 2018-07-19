//var js = jQuery.noConflict();
(function($){
	$(document).ready(function(){
 		$('#news-container').vTicker({ 
			speed: 500,
			pause: 3000,
			animation: 'fade',
			mousePause: false,
			showItems: 5
		});

	        $('#news-container1').vTicker({
			speed: 700,
			pause: 4000,
			animation: 'fade',
			mousePause: false,
			showItems: 1
		});
                /*
		$( "#searchparte" ).autocomplete({     			
					minLength: 2,
					source: webroot + "involucrados/autoCompletado",
					focus: function( event, ui ){
						$( "#searchparte" ).val( ui.item.Involucrado.nombre ); 
						return false;
 					},
					select: function( event, ui ) {
						$("#resultados").hide('slow');
						$( "#searchparte" ).val( ui.item.Involucrado.nombre );
						var id = ui.item.Involucrado.id;
						$.ajax({
						  url: webroot + "involucrados/getData/"+id,
						  dataType: 'json',
						  success: function(data){
						   var expes = data.Involucrado;
			 	    var url = webroot + "expedientes/detalle_individual/"+ id;
						var html = '<div id="inter_resultados"><div class="datos_curso">';
						    html += '<h3>Descripción del expediente:</h3><div class="desc">';
						    html += '<table border=0  class="testgrid">';
			               html += '<tr><th>Expediente</th><th>Juzgado</th><th>Materia</th></tr>';
                                       html +='<td><a href="'+url+'">'+id+ '</a></td>';
                                       html +='<td>'+expes["htsjpjuzgado_id"] + '</td>';
                                       html +='<td>'+expes["htsjpmateria_id"] + '</td>';
                                       html +='</tr></table><br>';
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
								.append( "<a>" + item.Involucrado.nombre + "</a>" )
								.appendTo( ul );
				};//autocomplete
                */
		$( "#search" ).autocomplete({     			
					minLength: 2,
					source: webroot + "Expedientes/autoCompletado",
					focus: function( event, ui ){
						$( "#search" ).val( ui.item.Expediente.id ); 
						return false;
 					},
					select: function( event, ui ) {
						$("#resultados").hide('slow');
						$( "#search" ).val( ui.item.Expediente.id );
						var id = ui.item.Expediente.id;
						$.ajax({
						  url: webroot + "Expedientes/getData/"+id,
						  dataType: 'json',
						  success: function(data){
						   var expes = data.Expediente;
						   var juz = data.Juzgado;
						   var mat = data.Materia;
			 	    var url = webroot + "Expedientes/view/"+ id;
		 		    var html  = '<div class="cuadroblue">';
					html += '<h3>Descripción del expediente:</h3>';
	     		                html +='<hr style="float:left; width:35%;text-align:left;height:1px;border:1px;background-color:#e2e2e2;" >';
                                        html +='<br><div class="datos_obtenidos">';
                                        html +='<p><strong>Expediente: </strong><a class="semefo" href="'+url+'">'+id+ '</a>';
                                        html +='<br><strong>Juzgado: </strong>'+juz["descripcion"];
                                        html +='<br><strong>Materia: </strong>'+mat["materia"];
                                        html +='<br><strong>Exp. Procedente: </strong>'+expes["htsjpexpediente_id"];
                                        html +='</p></div></div><br>';
						$("#resultados").html(html);
					        $("#resultados").show('slow');
						  }//success
						});
						return false;
					}//select
				}).data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
								.data( "item.autocomplete", item )
								.append( "<a>" + item.Expediente.id + "</a>" )
								.appendTo( ul );
				};//autocomplete
	});// document
})(jQuery);
