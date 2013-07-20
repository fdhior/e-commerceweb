$(document).ready(function(){ 
	
	// Cargar la lista de pedidos recientes al inicio  
	mostrarPedidosRecientes();

}); 

var mostrandoLista = '';

function mostrarPedidosRecientes() {
	
	$.ajax({ 
		data: "accion=muestraLista&filtro=recientes", 
		type: "GET", 
		dataType: "json", 
		url: "interfacebd.php", 
			success: function(data) { 
			restults(data);
		} 
	});	
	mostrandoLista = "recientes";
}

function mostrarPedidosConfirmados() {
	
	$.ajax({ 
		data: "accion=muestraLista&filtro=pagoConfirmado", 
		type: "GET", 
		dataType: "json", 
		url: "interfacebd.php", 
			success: function(data) { 
			restults(data);
		} 
	});
	mostrandoLista = "confirmados";	
}

function mostrarPedidosEnEntrega() {
	
	$.ajax({ 
		data: "accion=muestraLista&filtro=enProcesoDeEntrega", 
		type: "GET", 
		dataType: "json", 
		url: "interfacebd.php", 
			success: function(data) { 
			restults(data);
		} 
	});
	mostrandoLista = "enentrega";	
}

function mostrarPedidosEntregados() {
	
	$.ajax({ 
		data: "accion=muestraLista&filtro=pedidoEntregado", 
		type: "GET", 
		dataType: "json", 
		url: "interfacebd.php", 
			success: function(data) { 
			restults(data);
		} 
	});	
	mostrandoLista = "entregados";
}

function mostrarPedidosCandelados() {
	
	$.ajax({ 
		data: "accion=muestraLista&filtro=pedidoCancelado", 
		type: "GET", 
		dataType: "json", 
		url: "interfacebd.php", 
			success: function(data) { 
			restults(data);
		} 
	});	
	mostrandoLista = "cancelados";
}

// Variables Globales de Pedidos
var idEstadoEditando  = '';
var estadoEditando    = '';
var idControlEditando = '';
var controlEditando   = '';

function editarEstado(idEstado, idPedido, idControl) {

	// alert($('#' + idEstado).html());
	// $('#' + idEstado).html('').show(); 
	
	// Verificar si ya se está editando un registro (valor de variables globales)
	if (idEstadoEditando != '') {
		cancelaEdicionAnterior(idEstadoEditando);
	}
	
	// Agregar a la variables globales el valor del pedido que esta siendo editado
	idEstadoEditando  = idEstado;
	estadoEditando    = $('#' + idEstado).html();
	idControlEditando = idControl;
	controlEditando   = $('#' + idControl).html();
	
	// alert(controlEditando);

	var html = '<select id="selEstado" onChange="javascript: ejecutaCambiarEstado(\'' + idPedido + '\')">';
//	    		html += mesOpciones;
   		html += '</select>';	

	$('#' + idEstado).html(html);
	obtenerEstadosPedido();

	html = '<a href="#" onclick="javascript:  cancelaEdicionAnterior(\'' + idEstado + '\')">Cancelar</a>';
	// alert(html)

	$('#' + idControl).html(html);

}

function ejecutaCambiarEstado(idPedidoVal) {
	
	var result = confirm("¿Deseas Cambiar El Estado De Este Pedido?");
	if (result == true) {
		
		var selEstadoVal = $('#selEstado option:selected').val();
		$.ajax({ 
			data: "accion=actualizaEstadoPedido&selEstado=" + selEstadoVal + "&idPedido=" + idPedidoVal, 
			type: "GET", 
			dataType: "json", 
			url: "interfacebd.php", 
				success: function(data) { 
			} 
		});
		actualizaDespuesDeEdicion();
	} else {
		cancelaEdicionAnterior(idEstadoEditando);
	}

}

function actualizaDespuesDeEdicion() {
	
	// Tomar el valor actual (texto) de el select que creamos para la edicion
	html = $('#selEstado option:selected').text();
	
	// Mostrar el nuevo valor de estado del pedido editado en la lista
	$('#' + idEstadoEditando).html(html);

	// Restaurar el valor del enlace de control
	$('#' + idControlEditando).html(controlEditando);
	
	// Volver al valor inicial de las variables globales de edicion
	idEstadoEditando  = '';
	estadoEditando    = '';
	idControlEditando = '';
	controlEditando   = '';

	// Actualizar la lista que se está mostrando
	switch (mostrandoLista) {
		case 'recientes':
			mostrarPedidosRecientes();
			break;
		case 'confirmados':
			mostrarPedidosConfirmados();
			break;
		case 'enentrega':
			mostrarPedidosEnEntrega();
			break;
		case 'entregados':
			mostrarPedidosEntregados();
			break;
		case 'cancelados':
			mostrarPedidosCandelados();
			break;				
	}

	alert("El estado del pedido ha sido Cambiado");	
}

function cancelaEdicionAnterior(idEstadoEditando) {
	$('#' + idEstadoEditando).html(estadoEditando);
	$('#' + idControlEditando).html(controlEditando);
}

function obtenerEstadosPedido() {

	$.ajax({ 
		data: "accion=obtenerEstadosPedido", 
		type: "GET", 
		dataType: "json", 
		url: "interfacebd.php", 
			success: function(data) { 
			agregaEstados(data);
		} 
	});

}

function agregaEstados(data) {
	var html = '';
	var i = 0;
	// alert(estadoEditando);
	$.each(data,function(index,value) {
		i = index + 1
		html += '<option value="' + i + '"';
		if (data[index].status == estadoEditando) {
			html += ' selected="selected" ';
		}	
		html +='>' + data[index].status +	'</div>';	
	});	
	$("#selEstado").append(html);
}

function restults(data) {
	var html = '';
	$("#listadoTabla").html('').show(); 
	$.each(data,function(index,value) { 
		html += '<div class="filaLista">';
		html += '<div class="colNumero">' + data[index].idPedido + '</div>'; 
		html += '<div class="colNombres">' + data[index].nombres + ' ' + data[index].aPaterno + ' ' + data[index].aMaterno + '</div>';
		html += '<div class="colNumero">' + data[index].cantProductos + '</div>'; 
		html += '<div class="colMonto">$ ' + data[index].montoEnvio + '</div>'; 
		html += '<div class="colMonto">$ ' + data[index].subtotal + '</div>';
		html += '<div class="colMonto">$ ' + data[index].iva + '</div>'; 
		html += '<div class="colMonto">$ ' + data[index].total + '</div>'; 
		html += '<div class="colFecha">' + data[index].fechaAlta + '</div>'; 
		html += '<div id="status' + index + '" class="colTextoCorto">' + data[index].status + '</div>'; 
		html += '<div id="control' + index + '" class="colTextoCorto"><a href="#" onclick="javascript: editarEstado(\'status' + index + '\',\'' + data[index].idPedido + '\',\'control' + index + '\')">Cambiar<br />Estado</a></div>'; 
		html += '</div>';
	}); 
	// $("#listadoTabla").html(html).show(); 
	$("#listadoTabla").append(html);
	
} 

/*

	$("#muestraNodos").click(function() {
		var $nodes = $('#listadoTabla').children();
		alert('Number of nodes of listadoTabla id is '+$nodes.length);
		var txt="";
		$('#listadoTabla').children().each( function() {
			txt+=$(this).text();
		});
	alert(txt);
	});

	$("#muestraEstado").click(function() {
		alert($('#status0').html());
	});	

	$("#cambiaTitulo").click(function() {
		$('h2').text('Ahora no hago nada');
	});

*/  

/* Fuente: http://www.bloogie.es/tecnologia/programacion/34-ajax-con-jquery-php-y-json-ejemplo-paso-a-paso#ixzz1wgRkyjUZ 
Under Creative Commons License: Attribution Share Alike */