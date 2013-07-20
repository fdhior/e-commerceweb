<?php

function generarMeses($messelecionado) {	

	$optionHTML = '';

	for ($i = 1; $i <= 12; $i++) {
		
		$optionHTML .= '<option ';

		if ($i < 10) {
			if ('0'.$i == $messelecionado) {
				$optionHTML .= 'selected="selected"';
			}
			$optionHTML .= 'value="0'. $i . '">0' . $i;
		} else {
			$optionHTML .= 'value="'. $i . '">' . $i; 
		}	

		$optionHTML .= '</option>';	
	}

	return $optionHTML;
}

function generarAnios($anioseleccionado) {	

	$optionHTML = '';
	$anio_actual = date('Y'); 
	for ($anio = 3000; $anio >= $anio_actual; $anio--) {
	   	if ($anio == $anioseleccionado) {
			$optionHTML .= '<option selected="selected" value="'.$anio.'"> '.$anio.'</option>';	
		} else {
			$optionHTML .= '<option value="'.$anio.'"> '.$anio.'</option>';
		}
	}

	return $optionHTML;
}

?>