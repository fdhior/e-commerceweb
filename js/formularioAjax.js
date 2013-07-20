/* window.onload = function() {
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#formaMetodoPago").validationEngine();
	});
} */


function metodoElegido() {

	var options = $('select#selMetodoPago option');
	var len = options.length;
	
	for (var i = 0; i < len; i++) {
	    if (options[i].selected == true) {
	    	var selectedOptionValue = options[i].value;
	    	var selectedOptionText = options[i].text;
	    }
	    // console.log('Option text = ' + options[i].selected);
	    // console.log('Option value = ' + options[i].value);
	}
	mostrarDetalleMetodo(selectedOptionValue, selectedOptionText);	

}

function mostrarDetalleMetodo(selectedOptionValue, selectedOptionText) {
	
	var html = '';
	var mesOpciones = generarMeses();
	var anioOpciones = generarAnios();

	if (selectedOptionValue == 0) {
		$('#metodoDetalle').html(html);
	} else {
		// alert(selectedOptionValue);
		html = '<table cellspacing="0">';

		switch(selectedOptionValue) {
   			case '1':
				html += '<tr class="requerido">';
                html += '<th scope="row">No. De Tarjeta*</th>';
                html += '<td><input name="noTarjetaCredito" type="text" size="20" maxlength="20" class="validate[required,creditCard] text-input" /></td>';
                html += '</tr>'; 
                html += '<tr class="requerido">';
                html += '<th scope="row">Banco Emisor*</th>';
                html += '<td><input name="bancoEmisor" type="text" size="15" maxlength="15" class="validate[required] text-input" /></td>';
                html += '</tr>';
       			html += '<tr class="requerido">';
       			html += '<th scope="row">Fecha de Vencimiento*</th>';
   	    		html += '<td><select name="mesVencimiento" class="validate[required]">';
   	    		html += mesOpciones;
   	    		html += '</select>';
   	    		html += '<select name="anioVencimiento" class="validate[required]">';
   	    		html += anioOpciones;
   	    		html += '</select>';	
   	    		html += '</td>';
				html += '</tr>';
				html += '<tr class="requerido">';
                html += '<th scope="row">Digito Verificador*</th>';
                html += '<td><input name="digitoVerificador" type="text" size="4" maxlength="4" class="validate[required]" /></td>';
                html += '</tr>';
       			break;
   			case '2':
				html += '<tr class="requerido">';
                html += '<th scope="row">No. De Tarjeta*</th>';
                html += '<td><input name="noTarjetaDebito" type="text" size="12" class="validate[required,creditCard] text-input" /></td>';
                html += '</tr>';
                html += '<tr class="requerido">';
                html += '<th scope="row">Banco Emisor*</th>';
                html += '<td><input name="bancoEmisor" type="text" size="12" maxlength="12" class="validate[required] text-input" /></td>';
                html += '</tr>';
       			html += '<tr class="requerido">';
       			html += '<th scope="row">Fecha de Vencimiento*</th>';
   	    		html += '<td><select name="mesVencimiento" class="validate[required] text-input">';
   	    		html += mesOpciones;
   	    		html += '</select>';
   	    		html += '<select name="anioVencimiento" class="validate[required] text-input">';
   	    		html += anioOpciones;
   	    		html += '</select>';	
   	    		html += '</td>';
       			break;        
   			case '3':
				html += '<tr class="requerido">';
                html += '<th scope="row">Correo Electrónico*</th>';
                html += '<td><input name="paypalCorreoe" type="text" size="20" class="validate[required,custom[email]] text-input" /></td>';
                html += '</tr>';
                html += '<tr class="requerido">';
                html += '<th scope="row">Contraseña*</th>';
                html += '<td><input id="paypalContra" name="paypalContra" type="password" size="12" maxlength="12" class="validate[required] text-input" /></td>';
                html += '</tr>';
                html += '<tr class="requerido">';
                html += '<th scope="row">Confirma Cntraseña*</th>';
                html += '<td><input id="paypalContra2" name="paypalContra2" type="password" size="12" maxlength="12" class="validate[required,equals[paypalContra]] text-input" /></td>';
                html += '</tr>';                
      			break;
	    }
       	html += '</table>';
		$('#metodoDetalle').html(html); 

		jQuery(document).ready(function(){
      		// binds form submission and fields to the validation engine
      	jQuery("#formaMetodoPago").validationEngine();
    });
	
	}	

}


function generarMeses() {	

	var optionHTML = '<option selected="selected" value="">Mes</option>';

	for (var i = 0; i < 12; i++) {
		optionHTML += '<option value="'; 

		var muestraMes = i+1;
		if (muestraMes < 10) {
			optionHTML += '0' + muestraMes + '">0' + muestraMes;
		} else { 
			optionHTML += muestraMes + '">' + muestraMes; 
		}
		optionHTML +='</option>';	
	}

	return optionHTML
}

function generarAnios() {	

	var optionHTML = '';
	var fechaActual = new Date(); 
	var anioActual = fechaActual.getFullYear();

	var ic = 0;
	for (var anio = 3001; anio >= anioActual; anio--) {
	   	if (ic == 0) {
	   		optionHTML += '<option selected="selected" value="">Año</option>';	
		} else {
			optionHTML += '<option value="' + anio + '">' + anio + '</option>';
		}
		ic++;
	}

	return optionHTML
}	