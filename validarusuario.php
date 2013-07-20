<?php
	
 	session_start();

	$rutafunciones = 'funciones/';
	include $rutafunciones.'consultas.php';

	include 'target_links.php';

	$llamadaLogin = $_POST['llamadaLogin'];
	$inputUser    = trim($_POST['username']);
	$inputPass    = trim($_POST['password']);

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

	switch ($llamadaLogin) {
		case 'index':
			$cierre_err_mess .= $target_link10 . '"';	
			break;
		case 'finalizarcompra':
			$cierre_err_mess .= $target_link3 . '?accion=finalizarCompra"';
			break;
		case 'wishlist':
			$cierre_err_mess .= $target_link20 . '?accion=registroUsuario"';
			break;	

	}

	$cierre_err_mess .= ' title="intenta de nuevo" target="_top">intenta ingresar de nuevo</a></p>';
	$cierre_err_mess .= '</div>';
	$cierre_err_mess .= '<div>';
	$cierre_err_mess .= '</body>';
	$cierre_err_mess .= '<html>';

			
	// $cierre_err_mess2 = '</p>';

	// Validar Campo vacio Usuario
	if(!isset($_POST['username']) || trim($_POST['username']) == "") {
		die("$err_mess Debes teclear un nombre de usuario<br /> $cierre_err_mess");
	}

	if(!isset($_POST['password']) || trim($_POST['password']) == "") {
		die("$err_mess Debes teclear tu contrase&ntilde;a<br />$cierre_err_mess");
	}

	// Obtener datos de la base de datos
	$cols_arr   = array("idCliente",  	 // 0
						"nombreusuario", // 1
					  	"nombres",    	 // 2
					  	"aPaterno",		 // 3
					  	"aMaterno");	 // 4
	$num_cols   = count($cols_arr);
	$tables_arr = array("clientes");
	$where_clause = "nombreusuario = '$inputUser' AND contra = MD5('$inputPass')";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	if(mysql_num_rows($result) == 1) {

		// Si el usuario y contraseña son correctos iniciar la session del cliente
		$datosCliente=mysql_fetch_row($result);

		$apellidosCliente = $datosCliente[3] . ' ' . $datosCliente[4];

		$_SESSION['loggedUser'] = array("idCliente" => "$datosCliente[0]",
										"nombreUsuario" => "$datosCliente[1]",
		                                "nombreCliente" => "$datosCliente[2]",
		                                "apellidosCliente" => "$apellidosCliente",
		                                "openSession" => "true");

		switch ($llamadaLogin) {
			case 'index':
					header("Location: " . $target_link10 . ""); 
					break;

			case 'finalizarcompra':
					$_SESSION['accion'] = "finalizarCompra";
					header("Location: " . $target_link3 . "");
					break;			
			case 'wishlist':
					header("Location: " . $target_link20 . "");				
					break;
		}
		

		exit();
	} else {

		// Si la combinacion usuario/contraseña no existe muestra un error
		die("$err_mess Tu contrase&ntilde;a o nombre de usuario es incorrecto<br /> $cierre_err_mess");

	}	


	
?>	