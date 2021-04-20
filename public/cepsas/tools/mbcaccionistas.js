function desvincular() 
{
		
	var accionista = $('input[name="des_accionista"]').val();
	var delegado = $('input[name="des_delegado"]').val();
	var asamblea = $('input[name="des_asamblea"]').val();
	
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'desvincular', 'accionista' : accionista, 'delegado' : delegado, 'asamblea' : asamblea},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {	
			/*if(data[0] == '')
			{				
				$('.exito').removeClass('oculto');				
			}
			else
			{
				
				$('.error ul').html(data[0]);
				$('.error').removeClass('oculto');
				$('.exito').removeClass('oculto');
				
			}*/
			setTimeout("$('.emergente').animate({left:'-=300'},500);",10);			
			
		}	
	});		
} 

function redireccionar(url) {
    var url = window.location.href;	
	window.location.href=url;//Aqui debes poner a que pagina quieres redireccionar
  }
function limpiar_voto()
{
	$('input[name="accionista_d"]').val('');
	$('input[name="acciones_d"]').val('');
	$('input[name="asamblea_d"]').val('');
	$('.voto_delegado').addClass('oculto');
	$('.exito').addClass('oculto');
	$('.error ul').html('');
	$('.error').addClass('oculto');
	
}

 
function votar()
{
	
	
	var accionista = $('input[name="accionista"]').val();
	var acciones = $('input[name="acciones"]').val();
	var asamblea = $('input[name="asamblea"]').val();
	var pregunta = $('input[name="pregunta"]').val();
	var respuesta = $('input[name="respuesta"]').val();
	
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'votar', 'pregunta' : pregunta, 'respuesta' : respuesta, 'accionista' : accionista, 'asamblea' : asamblea, 'acciones' : acciones},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {	
			if(data[0] == '')
			{				
				$('.exito').removeClass('oculto');				
			}
			else
			{
				
				$('.error ul').html(data[0]);
				$('.error').removeClass('oculto');
				//$('.exito').removeClass('oculto');
				
			}
						
			setTimeout("redireccionar()",7000);
		}	
	});		
		
}
function actualizar_psw_lista()
{
	var checkboxValues = new Array();
	var accionista = new Array();	
	$('input[name="accionistapsw[]"]').each(function(index) {
		checkboxValues.push($(this).val());
		accionista[index] =  $( this ).data('accionista')
	});
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'actualizar_psw_lista', 'accionista' : accionista, 'checkboxValues' : checkboxValues},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {	
			if(data[0] == '')
			{
				
				$('.lista_accionistas_psw').html('');
				$('.lista_accionistas_psw').addClass('oculto');
				$('.psw_actualizado').removeClass('oculto');
				setTimeout("redireccionar()",7000);
					
				
			}
		}
	});
	
	
}
function actualizar_psw()
{	
	
	var accionista = $('input[name="documento"]').val(); 
	var psw = $('input[name="accionistapsw"]').val(); 
	var psw2 = $('input[name="accionistapsw2"]').val(); 	
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'actualizar_psw', 'accionista' : accionista, 'psw' : psw, 'psw2' : psw2},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {	
			if(data == 'actualizado')
			{
				
				$('.psw_error').addClass('oculto');
				$('.psw_actualizado').removeClass('oculto');
				setTimeout("redireccionar()",7000);	
			}
			if(data == 'error')
			{
				$('.psw_error').removeClass('oculto');
			}
		}
	});

	
}				

function ingresos_delegado()
{
	var delegado = $( "#documento_delegado" ).val();
	var asamblea = $( "#id_asamblea" ).val();
	var checkboxValues = new Array(); 
	$('input[name="accionista[]"]:checked').each(function() {
		checkboxValues.push($(this).val());
	});
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'ingresos_delegado', 'delegado' : delegado, 'asamblea' : asamblea, 'checkboxValues' : checkboxValues},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {
			
			if(data[0] == '')
			{
				$('.accionistas_a_representar .ar').html('');
				$('.accionistas_a_representar').addClass('oculto');
				$('.lista_accionistas_psw .lista_psw').html('');
				$('.lista_accionistas_psw').addClass('oculto');
				$('.registrado').removeClass('oculto');
				setTimeout("redireccionar()",7000);
			
			}
			else
			{
				$('.accionistas_a_representar .ar').html('');
				$('.accionistas_a_representar').addClass('oculto');
				var content = '<form action="">'+data[0]+'</form>';
				$('.lista_accionistas_psw .lista_psw').html(content);
				$('.lista_accionistas_psw').removeClass('oculto');
			}
			limpiarcampos2();
			
		}
	});
	
}

function consultar_registros(id)
{

	var asamblea = id;
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'consultar_registros', 'asamblea' : asamblea },
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {	
		var acciones_registradas = data[0].toFixed(3);	
		$('.porcentaje_registrados').width(''+acciones_registradas+'%');
		$('.total_acciones').html(data[1]);
		$('.registradas').html(data[2]);
		$('.quorum').html('Porcentaje registradas '+acciones_registradas+'%');
		if(acciones_registradas > 50)
		{
			$('.actaquorum').removeClass('oculto');
			$('.panel').removeClass('oculto');
		}		
		}
	});
	
}

function ingresar()
{
	 
	documento = $( "#documento" ).val();	
	asamblea = $( "#id_asamblea" ).val();
	$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'ingresar', 'documento' : documento, 'asamblea' : asamblea },
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {
			
			if(data[0] == 'ya registrado')//SI
			{
				$('.yaregistrado').removeClass('oculto');
				setTimeout("redireccionar()",7000);
			}
			else if(data[0] == 'registrado')
			{				
				$('.registrado').removeClass('oculto');
				if(data[1] != '')
				{
					var content = data[1];
					$('.lista_poderdantes').html(content);
					$('.poderdantes').removeClass('oculto');
				}
				if(data[2] != '')
				{
					$('.accionista_psw').removeClass('oculto');
				}
				else
				{
					setTimeout("redireccionar()",7000);
				}				
			}
			else if(data[0] =='sin titulos')//SI
			{
				$('.sintitulos').removeClass('oculto');
				setTimeout("redireccionar()",7000);	
			}
			else if(data[0] =='inactivo')//
			{				
				$('.inactivo').removeClass('oculto');
				setTimeout("redireccionar()",7000);
			}
						
			data = [];
		}
	}); 
}

function modificartotales()
{
	$( ".vender" ).addClass('oculto');
	$('#ventas-total_contado').attr('readonly', false);
	$('#ventas-total_credito').attr('readonly', false);	
}
function limpiar(e)
{
	$( "#ventas-"+e ).val("");
}

function nuevoantiguo(campana,id)
{	
	var datos = new Array(); 
	datos[0] = id;
	datos[1] = campana;
	
	$.ajax({
		type: "POST",
		url: "../../tools/controlador.php",
		data: { 'action' : 'nuevoantiguo', 'datos' : datos },
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (data) {
			$('#nuevoantiguo').html(data[0]);
			$('#credito').html(data[1]+'%');
			$('#contado').html(data[2]+'%');
			$('#accionesdisponibles').html(data[3]);
			$('#fec_ini_pagos').html(data[4]);
			$('#fec_fin_pagos').html(data[5]);
			$( "input[name='maximo_accionies']" ).val(data[3]);
			$( "input[name='fec_fin_pagos']" ).val(data[5]);
			$( "input[name='credito']" ).val(data[1]);
			$( "input[name='contado']" ).val(data[2]);
			$('#cuota').removeClass('oculto');
			$('#calcular').removeClass('oculto');
		}
	}); 
}
function validar(valoraccion)
{
	var acciones = parseInt($( "#ventas-no_acciones" ).val()); 
	var cuotas = $( "#ventas-cuotas" ).val();
	var porcentajecredito =  parseInt($( "input[name='credito']" ).val()) / 100;
	var porcentajecontado =  parseInt($( "input[name='contado']" ).val()) / 100;
	var maximoacciones = parseInt($( "input[name='maximo_accionies']" ).val());
	var fecinipago = $( "#ventas-fecha_inicio_pago" ).val();
	var fecfinpago = $( "input[name='fec_fin_pagos']" ).val();
	var pago = acciones * valoraccion;
	
	var fecha = fecinipago.split('-');
	var anio = fecha[0];
	var mes = parseInt(fecha[1]);
	var dia = fecha[2];
	
	var fechalimite = fecfinpago.split('-');
	var aniolimite = fechalimite[0];
	var meslimite = parseInt(fechalimite[1]);
	meslimite = meslimite + 1;
	var dialimite = fechalimite[2];
	
	
	var cuotasmaximo = meslimite - mes;
	
	
	var error = '';
	if(acciones > maximoacciones)
		error = "<li> El número de acciones supera el disponible de acciones a la venta.</li>";
	if( cuotas > cuotasmaximo)	
		error = error + "<li> El número de cuotas supera la fecha limite para los pagos.</li>";
	if(fecinipago == '' )	
		error = error + "<li>La fecha inicial del pago es obligatoria.</li>";
	var ultimomes = mes + parseInt(cuotas) - 1;	
	$( "#ventas-fecha_fin_pago" ).val(anio+'-'+ultimomes+'-'+dia);
	
	if($( "#ventas-total_contado" ).val() == '' && $( "#ventas-total_credito" ).val() == '')
	{	
		if(error == '')
		{
			$( ".alert-danger" ).addClass('error_oculto');
			$( "#oculto" ).removeClass('oculto');
			$( ".modificarvalores" ).removeClass('oculto');
			$( "#ventas-total_contado" ).val(pago * porcentajecontado);
			$( "#ventas-total_credito" ).val(pago * porcentajecredito);
			$( "#ventas-total" ).val(pago);
			$( ".callout-success" ).removeClass('oculto');
			$('.vender').removeClass('oculto');
			$('#ventas-total_contado').attr('readonly', true);
			$('#ventas-total_credito').attr('readonly', true);	
			
		}
		else
		{
			$( ".callout-success" ).addClass('oculto');
			$( "#error" ).html('');
			$( ".alert-danger" ).removeClass('error_oculto');
			$( "#error" ).html(error);
			$( ".vender" ).addClass('oculto');
		}
	}
	else
	{
		var tmpcontado = pago * porcentajecredito;
		var tmpcredito = pago * porcentajecontado;
		if($( "#ventas-total_contado" ).val() < tmpcontado)
			error = "<li>Total contado inferior al permitido.</li>";
		if($( "#ventas-total_credito" ).val() > tmpcredito)	
			error = error + "<li>Total credito superior al permitido.</li>";

		tmptotal = parseInt($( "#ventas-total_contado" ).val()) + parseInt($( "#ventas-total_credito" ).val());
		
		
		if(tmptotal != pago )	
			error = error + "<li>Los valores en Total Contado y Total Credito no suman el valor Total.</li>";
		
		if(error == '')
		{
			$( ".alert-danger" ).addClass('error_oculto');
			$( ".callout-success" ).removeClass('oculto');
			$('.vender').removeClass('oculto');
			$('#ventas-total_contado').attr('readonly', true);
			$('#ventas-total_credito').attr('readonly', true);
			if($('#ventas-total_contado').val() == pago)
			{
				$( "#ventas-cuotas" ).val('0'); 
			}	
		}
		else
		{
			$( ".callout-success" ).addClass('oculto');
			$( "#error" ).html('');
			$( ".alert-danger" ).removeClass('error_oculto');
			$( "#error" ).html(error);
			$( ".vender" ).addClass('oculto');
		}	
			
	}	
}
function accionistasppales()
{
		$.ajax({
		type: "POST",
		url: "../tools/controlador.php",
		data: { 'action' : 'accionistasppales'},
		dataType: "json", // Set the data type so jQuery can parse it for you
		success: function (resp) {
					"use strict";
					var donut = new Morris.Donut({
					  element: 'sales-chart',
					  resize: true,
					  colors: ["#3c8dbc", "#f56954", "#00a65a", "#F39C12", "#D81B60"],
					  data:resp,
					  hideHover: 'auto'
					});
					//BAR CHART

				}
	}); 
}
function ventasanio(anio)
{
	

}
