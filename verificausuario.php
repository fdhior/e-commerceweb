<?php

$rutafunciones = 'funciones/';
include $rutafunciones.'consultas.php';

/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];


$validateError= "This username is already taken";
$validateSuccess= "This username is available";

/* RETURN VALUE */
$arrayToJs = array();
$arrayToJs[0] = $validateId;


$cols_arr     = array("nombreusuario");
$num_cols     = count($cols_arr);
$tables_arr   = array("clientes");
$num_tables   = count($tables_arr);
$where_clause = "nombreusuario = '$validateValue'";

$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);


if (mysql_num_rows($result) > 0) {			// validate??
/*	for($x=0;$x<1000000;$x++){
		if($x == 990000){*/
	$arrayToJs[1] = false; 
/*
		}
	} */
}else{
	$arrayToJs[1] = true;					// RETURN TRUE
}

	echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR

?>