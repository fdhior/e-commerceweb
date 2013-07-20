<?php
date_default_timezone_set('America/Mexico');

// Funciones para checar validar fechas
function compare_dates($fecha1,$fecha2)
{

// devuelve un numero positivo si la primera fecha es mayor que la segunda, uno negativo si la primera es menor que la seguna y 0 si son iguales. Como bono funciona con ambos formatos: 'yyyy-mm-dd' y 'yyyy/mm/dd' 

// Positivo fecha 1 > fecha 2
// Negativo Fecha 1 < fecha 2
// 0 fecha 1 = fecha 2

	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
		list($dia1,$mes1,$año1)=split("/",$fecha1);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
		list($dia1,$mes1,$año1)=split("-",$fecha1);
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
		list($dia2,$mes2,$año2)=split("/",$fecha2);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
		list($dia2,$mes2,$año2)=split("-",$fecha2);
	$dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
	return ($dif);
}

function checkDateFormat($date)
{
  //match the format of the date
  if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
  {
    //check weather the date is valid of not
	if(checkdate($parts[2],$parts[3],$parts[1])) {
		return true;
	} else {
		return false;
	} 
  } else {
    return false;
  } 	
} // cierre de función

?>