<?php 
// Archivo para generar consultas SQL
include "conectarbd.php";


// Arma Consultas SELECT SQL Generales
function select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit)
{
	include "conectarbd.php"; // Incluir la fucion para conectarse a la base de datos
	
	// Armar las columnas de la consulta
	$num_cols = $num_cols - 1; // Obtiene las columnas del array cols_arr segun la cantidad de elementos
	for ($i = 0; $i <= $num_cols; $i++) {
		if ($i == $num_cols) {
			$colsstr = $colsstr.$cols_arr[$i];
		} else {	
			$colsstr = $colsstr.$cols_arr[$i].", ";
		}	
	}

 	// Armar las tablas de la consulta
    if ($join_tables == '1') { // Une las tablas
		$num_tables = $num_tables - 2;
		for ($i = 0; $i <= $num_tables; $i++) {
			$j = $i + 1;
			if ($i == '0') {
				$tablesstr = $tables_arr[$i]." INNER JOIN ".$tables_arr[$j]." ON ".$tables_arr[$i].".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} else {	
				$tablesstr = $tablesstr." INNER JOIN ".$tables_arr[$j]." ON ";
				if ($connect == '0') {
					$tablesstr = $tablesstr.$tables_arr[0];
				}
				if ($connect == '1') {
					$tablesstr = $tablesstr.$tables_arr[1];
				}
				if ($connect == '2') { // A Prueba
					$tablesstr = $tablesstr.$tables_arr[2];
				}
				$tablesstr = $tablesstr.".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} // fin de if 
		} // fin de ciclo for	
		$tablesstr = "(".$tablesstr.")";
	} else { // Si no son multiples tablas entonces la consulta es sencilla (afecta a una tabla)
		$tablesstr = "$tables_arr[0]";	
	}
	
	// where_clause
	if (isset($where_clause)){
		$where_clause = "WHERE ".$where_clause;
	}	

    // Parametros extra se agregan si se mandan desde los programas
	if (isset($order)){
		$comp_qor = "ORDER BY $order"; 
	}

	if (isset($dir) and $dir <> ""){
		$comp_qdr = "$dir"; 
	}	
	
	if (isset($limit) and $limit <> ""){
		$comp_qlm = "LIMIT $limit"; 
	}	
	
	if (!isset($comp_qdr)) {
		$comp_qdr = "";
	}

	if (!isset($comp_qlm)) {
		$comp_qlm = "";
	}
	
	$query_prot = "SELECT $colsstr FROM $tablesstr $where_clause $comp_qor $comp_qdr $comp_qlm";

	//echo "$query_prot";	

	$query = mysql_query($query_prot, $conexion);
	if (!$query) {
     die('<br />Consulta Invalida: ' . mysql_error());
	}

return ($query);
} // cierre de function select_gnrl_query


// Arma Consultas SELECT SQL Generales
function select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause)
{
	include "conectarbd.php"; // Incluir la fucion para conectarse a la base de datos
	
	$colsstr = '';
	// Armar las columnas de la consulta
	$num_cols = $num_cols - 1; // Obtiene las columnas del array cols_arr segun la cantidad de elementos
	for ($i = 0; $i <= $num_cols; $i++) {
		if ($i == $num_cols) {
			$colsstr = $colsstr.$cols_arr[$i];
		} else {	
			$colsstr = $colsstr.$cols_arr[$i].", ";
		}	
	}

 	// Armar las tablas de la consulta
    /*if ($join_tables == '1') { // Une las tablas
		$num_tables = $num_tables - 2;
		for ($i = 0; $i <= $num_tables; $i++) {
			$j = $i + 1;
			if ($i == '0') {
				$tablesstr = $tables_arr[$i]." INNER JOIN ".$tables_arr[$j]." ON ".$tables_arr[$i].".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} else {	
				$tablesstr = $tablesstr." INNER JOIN ".$tables_arr[$j]." ON ";
				if ($connect == '0') {
					$tablesstr = $tablesstr.$tables_arr[0];
				}
				if ($connect == '1') {
					$tablesstr = $tablesstr.$tables_arr[1];
				}
				if ($connect == '2') { // A Prueba
					$tablesstr = $tablesstr.$tables_arr[2];
				}
				$tablesstr = $tablesstr.".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} // fin de if 
		} // fin de ciclo for	
		$tablesstr = "(".$tablesstr.")";
	} else { // Si no son multiples tablas entonces la consulta es sencilla (afecta a una tabla)*/
		$tablesstr = "$tables_arr[0]";	
//	}
	
	// where_clause
	if (isset($where_clause)){
		$where_clause = "WHERE ".$where_clause;
	}	

    // Parametros extra se agregan si se mandan desde los programas
	/*if (isset($order)){
		$comp_qor = "ORDER BY $order"; 
	}

	if (isset($dir) and $dir <> ""){
		$comp_qdr = "$dir"; 
	}	
	
	if (isset($limit) and $limit <> ""){
		$comp_qlm = "LIMIT $limit"; 
	}*/	
	
	
	$query_prot = "SELECT $colsstr FROM $tablesstr $where_clause";

//	echo "$query_prot";	

	$query = mysql_query($query_prot, $conexion);
	if (!$query) {
     die('<br />Consulta Invalida: ' . mysql_error());
	}

return ($query);
} // cierre de function select_gnrl_query


/*function select_gnrl_query_prot($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit, $query_only)
{
	include "conectarainventario.php"; // Incluir la fucion para conectarse a la base de datos
	
	$colsstr = '';
	// Armar las columnas de la consulta
	$num_cols = $num_cols - 1; // Obtiene las columnas del array cols_arr segun la cantidad de elementos
	for ($i = 0; $i <= $num_cols; $i++) {
		if ($i == $num_cols) {
			$colsstr = $colsstr.$cols_arr[$i];
		} else {	
			$colsstr = $colsstr.$cols_arr[$i].", ";
		}	
	}

 	// Armar las tablas de la consulta
    if ($join_tables == '1') { // Une las tablas
		$num_tables = $num_tables - 2;
		for ($i = 0; $i <= $num_tables; $i++) {
			$j = $i + 1;
			if ($i == '0') {
				$tablesstr = $tables_arr[$i]." INNER JOIN ".$tables_arr[$j]." ON ".$tables_arr[$i].".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} else {	
				$tablesstr = $tablesstr." INNER JOIN ".$tables_arr[$j]." ON ";
				if ($connect == '0') {
					$tablesstr = $tablesstr.$tables_arr[0];
				}
				if ($connect == '1') {
					$tablesstr = $tablesstr.$tables_arr[1];
				}
				if ($connect == '2') { // A Prueba
					$tablesstr = $tablesstr.$tables_arr[1];
				}
				$tablesstr = $tablesstr.".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} // fin de if 
		} // fin de ciclo for	
		$tablesstr = "(".$tablesstr.")";
	} else { // Si no son multiples tablas entonces la consulta es sencilla (afecta a una tabla)
		$tablesstr = "$tables_arr[0]";	
	}
	
	// where_clause
	if (isset($where_clause)){
		$where_clause = "WHERE ".$where_clause;
	}	

    // Parametros extra se agregan si se mandan desde los programas
	if (isset($order)){
		$comp_qor = "ORDER BY $order"; 
	}

	if (isset($dir)){
		$comp_qdr = "$dir"; 
	}	
	
	if (isset($limit)){
		$comp_qlm = "LIMIT $limit"; 
	}	
	
	$query_prot = "SELECT $colsstr FROM $tablesstr $where_clause $comp_qor $comp_qdr $comp_qlm";


//	echo "$query_prot";	


	if ($query_only == 1) {
		return ($query_prot);
	} else {
		$query = mysql_query($query_prot, $conexion);
		if (!$query) {
	    	die('<br />Consulta Invalida: ' . mysql_error());
		}
		return ($query);
	}

} // cierre de function select_gnrl_query*/



// Arma sentencias INSERT SQL 
function gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table)
{
	include "conectarbd.php";
	$numcols = $numcols - 1;
	for ($i = 0; $i <= $numcols; $i++) {
		if ($i == $numcols) {
			$colsstr = $colsstr.$colsarr[$i];
		} else {	
			$colsstr = $colsstr.$colsarr[$i].", ";
		}	
		next($colsarr);
	}
	
	for ($i = 0; $i <= $numcols; $i++) {
		if ($i == $numcols) {
			$valstr = $valstr.$valarr[$i];
		} else {	
			$valstr = $valstr.$valarr[$i].", ";
		}	
	}	

	$query_prot = "INSERT INTO $aff_table ($colsstr) VALUES ($valstr)";
	
 	// echo "$query_prot";

	$query = mysql_query($query_prot, $conexion);
	if (!$query) {
     die('Consulta Invalida: ' . mysql_error());
	}

} // cierre de function insert_query

// Arma sentencias UPDATE SQL
function gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause)
{
	include "conectarbd.php";
	$colsstr = '';
	$numcols = $numcols - 1;
	for ($i = 0; $i <= $numcols; $i++) {
		if ($i == $numcols) {
			$colsstr = $colsstr.$colsvalarr[$i];
		} else {	
			$colsstr = $colsstr.$colsvalarr[$i].", ";
		}	
	}

	$query_prot = "UPDATE $aff_table SET $colsstr WHERE $where_clause";
	
 	// echo "$query_prot"; 

 	$query = mysql_query($query_prot, $conexion);
	if (!$query) {
      die('Consulta Invalida: ' . mysql_error());
	} 

} // cierre de function update_query

function gnrl_delete_query($aff_table, $where_clause)
{
	include "conectarbd.php";

	$query_prot = "DELETE FROM $aff_table WHERE $where_clause";
	
// 	echo "$query_prot";

 	$query = mysql_query($query_prot, $conexion);
	if (!$query) {
      die('Consulta Invalida: ' . mysql_error());
	} 

} // cierre de function gnrl_delete_query


function gnrl_altertable_query($aff_table, $action, $modifiers) // Funcion para construir consultas ALTER TABLE
{
	include "conectarbd.php";


	$query_prot = "ALTER TABLE $aff_table $action $modifiers";
	
// 	echo "$query_prot";

 	$query = mysql_query($query_prot, $conexion);
	if (!$query) {
      die('Consulta Invalida: ' . mysql_error());
	} 

} // cierre de function gnrl_altertable_query


// Arma Consultas SELECT SQL que toman una consulta de otra consulta almacenada en una tabla temporal
function select_gnrl_query_on_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit, $where_clause_on_temp)
{
	include "conectarbd.php"; // Incluir la fucion para conectarse a la base de datos
	
	// Armar las columnas de la consulta
	$num_cols = $num_cols - 1; // Obtiene las columnas del array cols_arr segun la cantidad de elementos
	for ($i = 0; $i <= $num_cols; $i++) {
		if ($i == $num_cols) {
			$colsstr = $colsstr.$cols_arr[$i];
		} else {	
			$colsstr = $colsstr.$cols_arr[$i].", ";
		}	
	}

 	// Armar las tablas de la consulta
    if ($join_tables == '1') { // Une las tablas
		$num_tables = $num_tables - 2;
		for ($i = 0; $i <= $num_tables; $i++) {
			$j = $i + 1;
			if ($i == '0') {
				$tablesstr = $tables_arr[$i]." INNER JOIN ".$tables_arr[$j]." ON ".$tables_arr[$i].".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} else {	
				$tablesstr = $tablesstr." INNER JOIN ".$tables_arr[$j]." ON ";
				if ($connect == '0') {
					$tablesstr = $tablesstr.$tables_arr[0];
				}
				if ($connect == '1') {
					$tablesstr = $tablesstr.$tables_arr[1];
				}
				if ($connect == '2') { // A Prueba
					$tablesstr = $tablesstr.$tables_arr[1];
				}
				$tablesstr = $tablesstr.".".$on_fields_arr[$i]." = ".$tables_arr[$j].".".$on_fields_arr[$i];
			} // fin de if 
		} // fin de ciclo for	
		$tablesstr = "(".$tablesstr.")";
	} else { // Si no son multiples tablas entonces la consulta es sencilla (afecta a una tabla)
		$tablesstr = "$tables_arr[0]";	
	}
	
	// where_clause
	if (isset($where_clause)){
		$where_clause = "WHERE ".$where_clause;
	}	

    // Parametros extra se agregan si se mandan desde los programas
	if (isset($order)){
		$comp_qor = "ORDER BY $order"; 
	}

	if (isset($dir)){
		$comp_qdr = "$dir"; 
	}	
	
	if (isset($limit)){
		$comp_qlm = "LIMIT $limit"; 
	}	
	
	if (isset($where_clause_on_temp)){
		$where_clause_on_temp = "WHERE ".$where_clause_on_temp;
	}	

	
	$query_prot1 = "CREATE TEMPORARY TABLE temp_table SELECT $colsstr FROM $tablesstr $where_clause $comp_qor $comp_qdr $comp_qlm";

	$query_prot2 = "SELECT * FROM temp_table $where_clause_on_temp";

//	echo "$query_prot1";	

//	echo "$query_prot2";	

	$query1 = mysql_query($query_prot1, $conexion);

	if (!$query1) {
     die('<br />Consulta Invalida de Tabla Original: ' . mysql_error());
	}

	$query2 = mysql_query($query_prot2, $conexion);

	if (!$query2) {
     die('<br />Consulta Invalida de Tabla Temporal: ' . mysql_error());
	}

return ($query2);
} // cierre de function select_gnrl_query

include "cerrar_conexion.php";
?>
