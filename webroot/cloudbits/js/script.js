//var js = jQuery.noConflict();
(function($){
  $(document).ready(function(){
   //$().UItoTop({ easingType: 'easeOutQuart' });
   /*try{$Gavick;}catch(e){$Gavick = {};}
    $Gavick["gkHighlighterGK4-gkHighlight_89"] = {
	"animationType" : 'linear',
       	"animationSpeed" : 60,
	"animationInterval" : 3000,
	"animationFun" : Fx.Transitions.linear,
	"mouseover" : true 
    };

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
                */
		$( "#search" ).autocomplete({     			
					minLength: 2,
					source: webroot + "Expedientes/autoCompletado",
					focus: function( event, ui ){
						$("#search").val( ui.item.Expediente.expediente ); 
						return false;
 					},
					select: function( event, ui ) {
						$("#resultado").hide('slow');
						$( "#search" ).val( ui.item.Expediente.expediente );
						var id = ui.item.Expediente.id;
						var expediente = ui.item.Expediente.expediente;
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
    	             //html +='<hr style="float:left; width:100%;text-align:left;height:1px;border:1px;background-color:#e2e2e2;" >';
                      html +='<div class="datos_obtenidos">';
                      html +='<p><strong>Expediente: </strong><a class="semefo" href="'+url+'">'+expediente+ '</a>';
                      html +='<br><strong>Juzgado: </strong>'+juz["organo_judicial"];
                      html +='<br><strong>Materia: </strong>'+mat["descripcion"];
                      html +='<br><strong>Exp. Procedente: </strong>'+expes["cbexpediente_id"];
                      html +='<br><strong>CIS: </strong>'+expes["cis"];
                      html +='<br><strong>Núm. Crédito: </strong>'+expes["num_credito"];
                      html +='</p></div></div><br>';
						$("#resultado").html(html);
					        $("#resultado").show('slow');
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



		$(".fancybox-effects-d").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,
				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
})(jQuery);
