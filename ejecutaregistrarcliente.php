<?php session_start();

	$rutafunciones = 'funciones/';
    include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_fechas.php';
	include $rutafunciones.'valida_correo.php';

    // $hostname = $_SESSION['hostname'];
	// $relpath  = "supervision/asistencia/"; 

	$idCliente = $_SESSION['loggedUser']['idCliente'];

     // Convertir vaariables POST en locales
	foreach ($_POST as $nombre => $valor) {
	 	if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	}

	if (isset($_SESSION['var_return'])) {
		$var_return = $_SESSION['var_return'];
	    foreach ($var_return as $nombre => $valor) {
			${$nombre} = $valor;
		} // Cierre foreach     
			
    	unset($_SESSION['var_return']); 
	}


	/* --------------------------------------- INSERTA LOS DATOS EN LA BASE DE DATOS ---------------------------- */

	echo $ejecuta;		
	switch($ejecuta) {
		case 'insertarRegistro':
			
			// Insertar los detalles del medio de pago en la base de datos
			$colsarr = array("idDetalleMedioDePago",
							 "cuentaMedioPago",
							 "nombreInstitucion",
					 		 "infoVerificacion",
					 		 "mesExpiracion",
					 		 "anioExpiracion");
			$numcols = count($colsarr);
			$valarr  = array("NULL");
	
			switch ($selMetodoPago) {
				case '1':
					$valarr[] = "'$noTarjetaCredito'";
					$valarr[] = "'$bancoEmisor'";
					$valarr[] = "'$digitoVerificador'";
					$valarr[] = "'$mesVencimiento'";
					$valarr[] = "'$anioVencimiento'"; 
					break;

				case '2':
					$valarr[] = "'$noTarjetaDeDebito'";
					$valarr[] = "'$bancoEmisor'";
					$valarr[] = "NULL";
					$valarr[] = "'$mesVencimiento'";
					$valarr[] = "'$anioVencimiento'"; 
					break;	
		
				case '3':
					$md5_paypalContra = MD5($paypalContra);
					$valarr[] = "'$paypalCorreoe'";
					$valarr[] = "NULL";
					$valarr[] = "'$md5_paypalContra'";
					$valarr[] = "NULL";
					$valarr[] = "NULL"; 
					break;

				default:
					# code...
					break;
			}
	
			$aff_table = "detallemediodepago";

			$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

		   	// Recuperar el id del detalle del medio de pago que se acaba de insertar
			$cols_arr      = array("MAX(idDetalleMedioDePago)");
			$num_cols      = count($cols_arr);
			$tables_arr    = array("detallemediodepago");

			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

			$idDetalleMedioDePago=mysql_fetch_row($result);

			// Generar contraseña
			$md5_pass = MD5($pass);			

			// Inserta registro de el resto de los datos del nuevo cliente en la base de datos
			$colsarr = array("idCliente",
					 		 "nombreusuario", 
					 		 "nombres", 
					 		 "aPaterno", 
							 "aMaterno",
							 "correoe",
							 "contra",
					 		 "direccionLinea1",
					 		 "direccionLinea2",
					 		 "ciudad",
					 		 "idEstado",
					 		 "codPostal",
					 		 "noTelefono",
					 		 "idMetodoPago",
					 		 "idDetalleMedioDePago");
			$numcols = count($colsarr);
			$valarr = array("NULL",
							"'$nombreUsuario'", 
							"'$nombres'", 
							"'$apaterno'", 
							"'$amaterno'",
							"'$correoe'",
							"'$md5_pass'",
							"'$direccionlinea1'",
							"'$direccionlinea2'",
							"'$ciudad'",
							"'$selEstado'",
							"'$codPostal'",
							"'$noTel'",
							"'$selMetodoPago'",
							"'$idDetalleMedioDePago[0]'");
			$aff_table = "clientes";

			$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

			$cols_arr      = array("MAX(idCliente)");
			$num_cols      = count($cols_arr);
			$tables_arr    = array("clientes");

			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

			$idClienteNuevo=mysql_fetch_row($result);
    
			$apellidosCliente = $apaterno . ' ' . $amaterno;

		    $_SESSION['loggedUser'] = array("idCliente" => "$idClienteNuevo[0]",
		    							    "nombreUsuario" => "$nombreUsuario",
		    							    "nombreCliente" => "$nombres",
		    							    "apellidosCliente" => "$apellidosCliente",
		    							    "openSession" => "true");
	
			$_SESSION['accion'] = "finalizarRegistro";

			// unset($_SESSION['var_return']);
	
			header("Location: ".$_SERVER['HTTP_REFERER']."");
			exit();

			break;

		case 'actualizarDireccion':

			$colsvalarr   = array("nombres    = '$nombres'", 
					 		 "aPaterno        = '$apaterno'", 
							 "aMaterno        = '$amaterno'",
					 		 "direccionLinea1 = '$direccionlinea1'",
					 		 "direccionLinea2 = '$direccionlinea2'",
					 		 "ciudad          = '$ciudad'",
					 		 "idEstado        = '$selEstado'",
					 		 "codPostal       = '$codPostal'",
					 		 "noTelefono      =	'$noTel'");
    		$numcols      = count($colsvalarr); 
    		$aff_table    = "clientes";
    		$where_clause = "idCliente = '$idCliente'";

    		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

			$_SESSION['accion'] = "revisarCambiosRegistro";

			header("Location: ".$_SERVER['HTTP_REFERER']."");
			exit();

			break;	

		case 'actualizaMedioPago':
			
			// Insertar los detalles del medio de pago en la base de datos
			$colsvalarr = array();
			
			if (isset($selMetodoPago)) {
				$tipoMedioDePagoActual = $selMetodoPago;

				$colsvalarr   = array("idMetodoPago = '$selMetodoPago'");
				$numcols      = count($colsvalarr);
				$aff_table    = "clientes";
				$where_clause = "idCliente = '$idCliente'";

				$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause);
				
				unset($colsvalarr);

			}

			switch ($tipoMedioDePagoActual) {
				case '1':
					$colsvalarr[] = "cuentaMedioPago   = '$noTarjetaCredito'";
					$colsvalarr[] = "nombreInstitucion = '$bancoEmisor'";
					$colsvalarr[] = "infoVerificacion  = '$digitoVerificador'";
					$colsvalarr[] = "mesExpiracion 	   = '$mesVencimiento'";
					$colsvalarr[] = "anioExpiracion    = '$anioVencimiento'"; 
					break;

				case '2':

					$colsvalarr[] = "cuentaMedioPago   = '$noTarjetaDebito'";
					$colsvalarr[] = "nombreInstitucion = '$bancoEmisor'";
					$colsvalarr[] = "infoVerificacion  = NULL";
					$colsvalarr[] = "mesExpiracion 	   = '$mesVencimiento'";
					$colsvalarr[] = "anioExpiracion    = '$anioVencimiento'"; 
					break;	
		
				case '3':
					$md5_paypalContra = MD5($paypalContra);
					$colsvalarr[] = "cuentaMedioPago   = '$paypalCorreoe'";
					$colsvalarr[] = "nombreInstitucion = NULL";
					$colsvalarr[] = "infoVerificacion  = '$md5_paypalContra'";
					$colsvalarr[] = "mesExpiracion 	   = NULL";
					$colsvalarr[] = "anioExpiracion    = NULL"; 
					break;

				default:
					# code...
					break;
			}

			$numcols = count($colsvalarr);
			$aff_table = "detallemediodepago";
			$where_clause = "idDetalleMedioDePago = '$medioDePagoActual'";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause);  

			$_SESSION['accion'] = "revisarCambiosMedioPago";
	
			// include 'variable_test.php';

			header("Location: ".$_SERVER['HTTP_REFERER']."");
			exit();

			break;
	}

	// include 'variable_test.php';

?>			