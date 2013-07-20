<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Plasticos Sonoros-Proyecto E-Commerce - Aplicación de Administracion de Pedidos</title>
        <link rel="stylesheet" type="text/css" href="../css/estilossonoros.css" />
<?php
	session_start();

	 // $_SESSION['vanda'] = 'vanda';

        $rutafunciones = '../funciones/';
	include $rutafunciones.'consultas.php';

	include '../target_links.php';

        // Mostrar los valores de _POST
/*      echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
                }
        } */

	if (isset($_POST['entrada'])) {

		$entrada = $_POST['entrada'];

		include $rutafunciones.'conectarbd.php';

		$inputUser = mysql_real_escape_string($_POST['username']);
		$inputPass = mysql_real_escape_string($_POST['password']);

		include $rutafunciones.'cerrar_conexion.php';

	}       
        

?>
</head>

<body>

<?php 

	// Si no sea enviado informacion se muestran las entradas       
	if (!$_POST['submit']) {

?>



<!-- <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p> -->
<div id="contenedorLogin">
	<div class="contenedorBordes"> 

		<div class="loginLogo"> 	
			<img src="../images/logo.jpg" width="317" height="50" alt="LOGO">
		</div>
		
			<p>Sistema De Administracion de Pedidos Y Ventas</p>
			<p>Ingreso a Usuarios</p>
			<p>Ingresa Tu Usuario y Contrase&ntilde;a</p>
			<form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div id="formaLoginTexto">
				<table border="0" cellpadding="5" cellspacing="5" bgcolor="#CADAEC">
					<tr>
						<td class="logintext">Usuario</td>
						<td><input type="text" size="10" name="username"></td>
					</tr>
					<tr>
						<td class="logintext">Contrase&ntilde;a</td>
						<td><input type="password" size="10" name="password"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input name="entrada" type="hidden" id="entrada" value="admin" />
						<input name="submit" type="submit" class="logintext" value="Entrar"></td>
					</tr>
				</table>
			</div>	
			</form>
	</div>
</div>


</body>


<?php
        }

$err_mess = '<div id="contenedorLogin"><div class="contenedorBordes"> 
 <p>';

$cierre_err_mess = '<a href="' . $target_link10 . '" title="intenta de nuevo" target="_self">intenta ingresar de nuevo</a></p>
</div>
</body>
</html>';

        if ($entrada == "admin") {
                // form submitted
                // check for username
                if (!isset($_POST['username']) || trim($_POST['username']) == "") {
                        die ("$err_mess Debes teclar un nombre de usuario<br /> $cierre_err_mess");

                } 
                // check for password
                if (!isset($_POST['password']) || trim($_POST['password']) == "") {
                        die ("$err_mess Debes teclar tu contraseña<br />Si la olvidaste contacta a el Area de sistemas<br /> $cierre_err_mess");
                }

                // connect and execute SQL query
//              $connection = mysql_connect("localhost", "root", "probell") or die ("No se puede conectar!");
//              mysql_select_db("egprobell");
                // assign to variables and escape

                
                // Consulta Nombre e ID de Tiendas
                $cols_arr = array("idUsuario",
                				  "nombreusuario",
                				  "nombreCompleto");		
                $num_cols = count($cols_arr);
                $join_tables = '0';
                $tables_arr = array("usuarios");
                $num_tables = count($tables_arr);
                $where_clause = "nombreusuario = '$inputUser' AND contra = MD5('$inputPass')";

                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

//              $query = "SELECT iduser, nombre, idtusr, idarea, usa_sprv, usa_man, usa_sol, usa_conf FROM gnrl_usrs WHERE username = '$inputUser' AND pswd = MD5('$inputPass')";
//              $result = mysql_query($query, $connection) or die ("Error in query: $query. " . mysql_error());
        
        
                if (mysql_num_rows($result) == 1) {
                        $datosUsuario=mysql_fetch_row($result);
        
                        // if row exists
                        // user/pass combination is correct
                        // start a session
                        session_start();
                        
                        
                        
                        $_SESSION['adminLoggedUser'] = array("idUsuario"      => "'$datosUsuario[0]'", 
                        	                             "nombreusuario"  => "'$datosUsuario[1]'", 
                        	                             "nombreCompleto" => "'$datosUsuario[2]'");

	                    // redirect browser to protected resource
                        header('Location: admintienda.php');
                        exit;
                } else {
                        // if row does not exist        
                        // user/pass combination is wrong
                        // redirect browser to error page
                        die("$err_mess Tu contraseña o nombre de usuario<br />es incorrecto<br /> $cierre_err_mess");

                } // Cierre de Else
        } // Cierre de if admin 

?>

</body>
</html>
