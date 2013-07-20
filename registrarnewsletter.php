<?php
	
 	session_start();

	$rutafunciones = 'funciones/';
	include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_correo.php';

	include 'target_links.php';

	$correoe  = trim($_POST['correoe']);

	$err_mess = '<!DOCTYPE html>';
	$err_mess .= '<html>';
	$err_mess .= '<head>';
    $err_mess .= '<meta charset="utf-8" />';
    $err_mess .= '<title>Plasticos Sonoros-Proyecto E-Commerce</title>';
    $err_mess .= '<link href="css/estilossonoros.css" type="text/css" rel="stylesheet" />';
    $err_mess .= '</head>';
    $err_mess .= '<body>';

    $err_mess .= '<div id="errorVentanaModal"><div id="finalizacion"><p>'; 
	
	$cierre_err_mess = '<a href="';

	$cierre_err_mess .= $_SERVER['HTTP_REFERER'] . '"';	

	$cierre_err_mess .= ' title="intenta de nuevo" target="_top">intenta ingresar de nuevo</a></p>';
	$cierre_err_mess .= '</div>';
	$cierre_err_mess .= '<div>';
	$cierre_err_mess .= '</body>';
	$cierre_err_mess .= '<html>';

			
	// $cierre_err_mess2 = '</p>';

	// Validar Campo vacio Usuario
	
	if(!isset($_POST['correoe']) || trim($_POST['correoe']) == "") {
		die("$err_mess Debes teclear una cuenta de Correo Eléctronico para poder registarte $cierre_err_mess");
	}

	if (trim($_POST['correoe']) <> "" and comprobar_email($correoe) == 0) {
		$_SESSION['errCorreoe'] = $correoe;
		die("$err_mess Hay un error en la escritura de esta direcci&oacute;n de correo $cierre_err_mess");
	}

	$cols_arr = array("correoe",);		
    $num_cols = count($cols_arr);
    $tables_arr = array("newsletter");
    $num_tables = count($tables_arr);
    $where_clause = "correoe = '$correoe'";

    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

    if (mysql_num_rows($result) == 1) {
		die("$err_mess La cuenta de correo electronico ya fue registrada anteriormente<br /> $cierre_err_mess");    	
	} else {

		// Registrar al Usuario
		$colsarr = array("idUsuarioBoletin",
			 		     "correoe");
		$numcols = count($colsarr);
		$valarr = array("NULL",
						"'$correoe'");
		$aff_table = "newsletter";

		$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

		$_SESSION['correoeRegistrado'] = $correoe;
	
		header("Location: " . $target_link16 . "");
		exit();
	
	}


	
?>	