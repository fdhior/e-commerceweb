<?php

session_start();

$rutafunciones = 'funciones/';
include $rutafunciones.'consultas.php';

/* RECEIVE VALUE */
$nameValue=$_REQUEST['firstname'];
$userValue=$_REQUEST['nombreUsuario'];

// Convertir vaariables POST en locales
foreach ($_POST as $nombre => $valor) {
	if(stristr($nombre, 'button') === FALSE) {
		${$nombre} = $valor;
	}
}


$validateError= "This username is already taken";
$validateSuccess= "This username is available";


/* RETURN VALUE */
$arrayToJs = array();
$arrayToJs[0] = array();
$arrayToJs[1] = array();


$cols_arr     = array("nombreusuario");
$num_cols     = count($cols_arr);
$tables_arr   = array("clientes");
$num_tables   = count($tables_arr);
$where_clause = "nombreusuario = '$userValue'";

$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);


if (mysql_num_rows($result) > 0) {			// validate??
	$arrayToJs[0][0] = 'nombreUsuario';
	$arrayToJs[0][1] = false;
	$arrayToJs[0][2] = "Este usuario ya existe en el sistema";
} else { 
	$arrayToJs[0][0] = 'nombreUsuario';
	$arrayToJs[0][1] = true;			// RETURN TRUE
	$arrayToJs[0][2] = "This user is available"; 

	switch ($registroOrigen) {
		case 'finalizarcompra':
			// Establecer una array de sesion con los datos basicos del cliente
			$_SESSION['var_return'] = array("accion" => "registrarMetodoPago");
			break;
		case 'whishlist':
			// Establecer una array de sesion con los datos basicos del cliente
			$_SESSION['var_return'] = array("accion" => "registroParcial");
			break;

		default:
			# code...
			break;
	}

	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			$_SESSION['var_return'][$nombre] = $valor;
		}
	}	
	// header("Location: ".$_SERVER['HTTP_REFERER']."");
	// exit();

}


// if($nameValue =="duncan"){		// validate??
	$arrayToJs[1][0] = 'firstname';
	$arrayToJs[1][1] = true;			// RETURN TRUE
			// RETURN ARRAY WITH success
/* }else{
	$arrayToJs[1][0] = 'firstname';
	$arrayToJs[1][1] = true;
	$arrayToJs[1][2] = "This name is already taken";
} */

	echo json_encode($arrayToJs);

?>