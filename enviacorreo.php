<?php

	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

	include 'target_links.php';

	// $correoe  = trim($_POST['correoe']);

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

	$cierre_err_mess .= ' title="continuar" target="_top">Continuar</a></p>';
	$cierre_err_mess .= '</div>';
	$cierre_err_mess .= '<div>';
	$cierre_err_mess .= '</body>';
	$cierre_err_mess .= '<html>';



	$direc_destino = "li094106303@rigel.fca.unam.mx";
//	$asunto = $asunto;
	
	$boundary = '==MP_Bound_xyccr948x==';
	$encabezado = array();
	$encabezado[] = 'MIME-Version: 1.0';
	$encabezado[] = 'Content-type: multipart/alternative; boundary="' . $boundary . '"';
	$encabezado[] = "From: CLIENTE @ PLASTICOS SONOROS <".$correoe.">";

	$cuerpo_msj = 'This is a Multipart Message in MIME format.' . "\n";
	$cuerpo_msj .= '--' . $boundary . "\n";
	$cuerpo_msj .= 'Content-type: text/html; charset="iso-8859-1"' . "\n";
	$cuerpo_msj .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
	$cuerpo_msj .= "Mensaje Enviado por: ".$nombrermt."\n";
	$cuerpo_msj .= "Correo Electronico: ".$correoe."\n\n";
	$cuerpo_msj .= $mensaje . "\n";
	$cuerpo_msj .= '--' . $boundary . "\n";
	$cuerpo_msj .= 'Content-type: text/plain; charset="iso-8859-1"' . "\n";
	$cuerpo_msj .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
	$cuerpo_msj .= "Mensaje Enviado por: ".$nombrermt."\n";
	$cuerpo_msj .= "Correo Electronico: ".$correoe."\n\n";
	$cuerpo_msj	.= strip_tags($mensaje) . "\n";
	$cuerpo_msj .= '--' . $boundary . '--' . "\n";
	
	
	
//	$mensaje = 'Mensaje enviado por: '.$nombrermt.'<br />Correo-e: '.$correoe.'<br /><br />'.$mensaje; 

	$success = mail($direc_destino, $asunto, $cuerpo_msj, join("\r\n", $encabezado));

	unset($encabezado);
	unset($cuerpo_msj);

	$encabezado = array();
	$encabezado[] = 'MIME-Version: 1.0';
	$encabezado[] = 'Content-type: multipart/alternative; boundary="' . $boundary . '"';
	$encabezado[] = "From: PLATICOS SONOROS <soportealcliente@plasticossonoros.com.mx>";
	
	$asunto = "PLASTICOS SONOROS - TIENDA VIRTUAL DE DISCOS DE VINIL: HEMOS RECIBIDO TU MENSAJE";
	
	$cuerpo_msj = 'This is a Multipart Message in MIME format.' . "\n";
	$cuerpo_msj .= '--' . $boundary . "\n";
	$cuerpo_msj .= 'Content-type: text/html; charset="iso-8859-1"' . "\n";
	$cuerpo_msj .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
	$cuerpo_msj .= "SERVICIO AL CLIENTE @ PLASTICOS SONOROS\n\n";
	$cuerpo_msj .= "Hemos recibido tu mensaje\n";
	$cuerpo_msj .= "En breve nos comunicaremos contigo\n\n";
	$cuerpo_msj .= "Gracias por tu preferencia\n\n";
	$cuerpo_msj .= "--- Mensaje Original ---\n\n";
	$cuerpo_msj .= $mensaje . "\n";
	$cuerpo_msj .= '--' . $boundary . "\n";
	$cuerpo_msj .= 'Content-type: text/plain; charset="iso-8859-1"' . "\n";
	$cuerpo_msj .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
	$cuerpo_msj .= "PLASTICOS SONOROS\n\n";
	$cuerpo_msj .= "Hemos recibido tu mensaje\n";
	$cuerpo_msj .= "En breve nos comunicaremos contigo\n\n";
	$cuerpo_msj .= "Gracias por tu preferencia\n\n";
	$cuerpo_msj .= "--- Mensaje Original ---\n\n";
	$cuerpo_msj	.= strip_tags($mensaje) . "\n";
	$cuerpo_msj .= '--' . $boundary . '--' . "\n";
	

	$success2 = mail($correoe, $asunto, $cuerpo_msj, join("\r\n", $encabezado));

	if ($success === TRUE and $success2 === TRUE) {
		die("$err_mess Hemos recibido tu Mensaje<br />En breve nos pondremos en contacto contigo<br /> $cierre_err_mess");
	} else {
		die("$err_mess Ocurrió un error no especificado<br />Al enviar tu mensaje<br /> $cierre_err_mess");
	}	
	// 

?> 


