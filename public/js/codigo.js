
$(function () {
   MuestraTema();
   $("#idtema").hide();

});

// Inicio de regla de ubigeo
$("#ddlSeccion").change(function() {
	MuestraTema();
});
// Fin de regla ubigeo
function MuestraTema(){
	var URLactual = jQuery(location).attr('host');
	$.ajax({
		url: 'http://'+URLactual+'/tema/'+$("#ddlSeccion").val(),
		type: 'GET',
		data: {codsec: $("#ddlSeccion").val()}
	})
	.done(function(tema) {
		$('#ddlTema').html('');
		$('#ddlTema').append($('<option></option>').text('Seleccionar un tema').val(''));
		$.each(tema, function(i) {
			if (tema[i].id==$('#idtema').html()) {
			 $('#ddlTema').append('<option selected value="'+tema[i].id+'">'+tema[i].nombre+'</option>');
			} else{
			 $('#ddlTema').append('<option value="'+tema[i].id+'">'+tema[i].nombre+'</option>');
			};
		});
		$('#ddltema');
		console.log("success");

	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}
