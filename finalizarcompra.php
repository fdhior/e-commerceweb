<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Plasticos Sonoros-Proyecto E-Commerce</title>
	<script src="js/jquery-1.6.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.validationEngine-es.js"  type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/formularioAjax.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/estilossonoros.css" />
	<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css" />
	<link rel="stylesheet" type="text/css" href="css/navbar.css" />

<?php 

    $rutafunciones = 'funciones/';
    include $rutafunciones.'consultas.php';
    include $rutafunciones.'generar_mesesanios.php';

    include "target_links.php";

    $retorno = $_SERVER['PHP_SELF'];
    
    $idCliente = $_SESSION['loggedUser']['idCliente'];
    
    // $carritoCanasta = $_SESSION['carritoCanasta'];
    if ($_GET) {
      foreach ($_GET as $nombre => $valor) {
        if(stristr($nombre, 'button') === FALSE) {
          ${$nombre} = $valor;
        } // Cierre de if
      }// Cierre foreach  
    } else {
      foreach ($_POST as $nombre => $valor) {
        if(stristr($nombre, 'button') === FALSE) {
          ${$nombre} = $valor;
        } // Cierre de if
      }// Cierre foreach 
    } 

    $inputUser = trim($_POST['username']);
    $inputPass = trim($_POST['password']);

    /* if (isset($_SESSION['err_return'])) {
      $err_return = $_SESSION['err_return'];
      foreach ($err_return as $nombre => $valor) {
        ${$nombre} = $valor;
      } // Cierre foreach     
    } 
    unset($_SESSION['err_return']); */

    if (isset($_SESSION['var_return'])) {
      $accion = $_SESSION['var_return']['accion'];
    }

    if (isset($_SESSION['accion'])) {
      $accion = $_SESSION['accion'];
      unset($_SESSION['accion']);
    }

    function ocultaCaracteres($cadenaOcultable,  $noCaracteres) {
          
      for($i=0;$i<strlen($cadenaOcultable);$i++){
        if($i <= $noCaracteres) {
          $cadenaOcultable[$i] = "*";   
        }
      }
      return $cadenaOcultable;
    } ?>

</head>

<body>
	
    <!-- ENCABEZADO -->
    <header id="main-header">
        
        <div id="logo">
          <img src="images/logo.png" alt="LOGO">
        </div>

<?php

        include 'campobusqueda.htm';
  
?>        

	  </header>
    <!-- FIN DE ENCABEZADO -->


  <!-- DIV contenedor -->
  <section id="contenido">
 		 
    <!-- BARRA DE VAVEGACION -->   
    <nav>

<?php

        include 'navbar.htm';
  
?>     

    </nav> 
    <!-- FIN DE BARRA DE NAVEGACION -->
 
    <!-- SECCION FINALIZAR COMPRA -->
    <section id="finalizarCompra">
        <h2>Finalizar Compra</h2>
        <!-- DIV CONTENEDOR BORDES -->
        <div class="contenedorBordes">      

<?php 

      switch ($accion) {
        case 'finalizarCompra':
     
          if (!isset($_SESSION['loggedUser'])) {

?>
            <h2>Inicia Sesión en la Tienda o Registrate</h2>

            <div class="contenedorForma">  
              <form id="formaLogin" method="post" action="<?php echo $target_link9; ?>" target="_top">
                <label>Usuario:</label>
                <input type="text" size="10" name="username" /><br />
                <label>Contraseña:</label>
                <input type="password" size="10" name="password" /><br />
                <input name="llamadaLogin" type="hidden" id="llamadaLogin" value="finalizarcompra" />
                <input name="submit" type="submit" class="btnEnviar" value="ingresar" /></td>
              </form><br />
              <p>Registrate <a href="<?php echo $_SERVER['PHP_SELF']; ?>?accion=registrarUsuario">aqui</a> si no eres usuario</p>
            </div>    

<?php
        
          } else {

            if($_SESSION['cantidadProductosTotal'] == 0) { ?>

              <h2>Carrito Vacio</h2>
              <p>No haya productos en la canasta del Carrito de Compras agrega al menos un producto para poder procesar tu compra</p>

      <?php } else { ?>

              <h2>Bienvenido <?php echo $_SESSION['loggedUser']['nombreCliente'] . ' ' . $_SESSION['loggedUser']['apellidosCliente']; ?> terminemos tu compra</h2>
              <p>Revisa que los productos sean los que tu deseas, en caso de ser necesario modifica las cantidades y/o agrega otros productos realizando una busqueda,
               cuando estes seguro de lo que deseas ordenar da clic en boton Procesar Pedido</p>
    
   <?php      include "canastacarrito.php";

            } // Cierre de If
          } // Cierre de if más externo

          break;

        case 'registrarUsuario':

?>

<script>
            
    // This method is called right before the ajax form validation request
    // it is typically used to setup some visuals ("Please wait...");
    // you may return a false to stop the request 
    function beforeCall(form, options){
      if (window.console) 
      console.log("Right before the AJAX form validation call");
      return true;
    } 
            

    // Called once the server replies to the ajax form validation request
    function ajaxValidationCallback(status, form, json, options){
      if (window.console) 
      console.log(status);
                
      if (status === true) {
        // alert("the form is valid!");
        // uncomment these lines to submit the form to form.action
        form.validationEngine('detach');
        // form.submit();
        // window.location = <?php echo $_SERVER['PHP_SELF']; ?>;
        setTimeout("location.reload(true);", 800);

        // or you may use AJAX again to submit the data
      }
    } 
            
    jQuery(document).ready(function(){
      jQuery("#formaRegistroUsuario").validationEngine({
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        onAjaxFormComplete: ajaxValidationCallback
      });
    });


  </script>

          <h2>Ingresa la información de Registro</h2>

          <div class="contenedorForma">  
            <form id="formaRegistroUsuario" class="formaRegistro" action="<?php echo $target_link6; ?>" method="post">
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Información de Cuenta</th>
                </tr>
                <tr class="requerido">
                  <th scope="row">Nombre de Usuario*</th>
                  <td><input id="nombreUsuario" name="nombreUsuario" type="text" size="20" maxlength="20" 
                      class="validate[required,custom[onlyLetterNumber],maxSize[20],ajax[ajaxUserCallPhp]] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Contraseña*</th>
                  <td><input id="pass" name="pass" type="password" size="15" maxlength="15" class="validate[required] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Confirmar Contraseña* </th>
                <td><input id="pass2" name="pass2" type="password" size="15" maxlength="15" class="validate[required,equals[pass]] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Dirección de Correo-e*</th>
                  <td><input name="correoe" type="text" class="validate[required,custom[email]] text-input" value="" /></td>
                </tr>
                <tr class="encabezado">
                  <th colspan="2">Información de Facturación</th>
                </tr>
                <tr class="requerido">
                  <th scope="row">Nombre(s)* </th>
                  <td><input name="nombres" type="text" size="15" class="validate[required,custom[onlyLetterSp]] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Apellido Paterno* </th>
                  <td><input name="apaterno" type="text" size="15" class="validate[required,custom[onlyLetterSp]] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Apellido Materno* </th>
                  <td><input name="amaterno" type="text" size="15" class="validate[required,custom[onlyLetterSp]] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Direccion (Línea 1)*</th>
                  <td><input name="direccionlinea1" type="text" size="25" class="validate[required] text-input" value="" /></td>
                </tr>
                <tr>
                  <th scope="row">Dirección (Línea 2)</th>
                  <td><input type="text" name="direccionlinea2" size="25" class="validate[required] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Ciudad*</th>
                  <td><input type="text" name="ciudad" class="validate[required] text-input" value="" /></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Estado*</th>
                  <td><select name="selEstado" class="validate[required] text-input">
                      
<?php
                    echo '<option selected="selected" value="">Selecciona Un Estado</option>';   
                    
                    // Obtener lista de Estados
                    $cols_arr = array("idEstado", 
                                        "estado");
                    $num_cols = count($cols_arr);
                    $tables_arr = array("estados");
                    $num_tables = count($tables_arr);

                    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                    while($row=mysql_fetch_row($result)) {    
                      if (isset($err_return) and $row[0] == $selEstado) {
                        echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                      } else {
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';                        
                      }  
                    }   // cierre de While
    
?>
                      </select></td>
                </tr>
                <tr class="requerido">
                  <th scope="row">Código Postal*</th>
                  <td><input name="codPostal" type="text" id="codPostal" size="5" maxlength="5" class="validate[required,custom[onlyNumberSp]] text-input"  value="" />
                      </td>
                </tr>
                <tr class="requerido">
                  <th scope="row">No. Telefónico*</th>
                  <td><input name="noTel" type="text" id="noTel" size="10" maxlength="10" class="validate[required,custom[phone]] text-input" value="" /></td>
                </tr>
              </table>
              <input name="registroOrigen" type="hidden" id="registroOrigen" value="finalizarcompra" /> 
              <input type="submit" name="btnEnviarRegistro" value="Enviar Registro" id="btnEnviarRegistro" />
              <input type="reset" name="Submit2" value="Reset"  id="buttonReset" />
            </form>  
            <!-- <p>Registrate <a href="<?php // echo $_SERVER['PHP_SELF']; ?>?accion=registrarUsuario">aqui</a> si no eres usuario</p> -->
          </div>    



<?php
          break;
        case 'registrarMetodoPago': ?>

         <h2>Especfica el metodo de pago a usar</h2>

          <div class="contenedorForma">  
            <form id="formaMetodoPago" class="formaRegistro" action="<?php echo $target_link7; ?>" method="post">
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Forma de Pago</th>
                </tr>
                <tr>
                  <th scope="row">Metodo de Pago</th>
                  <td><select name="selMetodoPago" id="selMetodoPago" onchange="javascript: metodoElegido()">
                      
<?php
                    echo '<option value="0" selected="selected">Selecciona Una Forma de Pago</option>';   
                    
                    // Obtener lista de Estados
                    $cols_arr = array("idMetodoPago", 
                                      "metodoPago");
                    $num_cols = count($cols_arr);
                    $tables_arr = array("metodopago");
                    $num_tables = count($tables_arr);

                    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                    while($row=mysql_fetch_row($result)) {    
                      if (isset($err_return) and $row[0] == $selEstado) {
                        echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                      } else {  
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                      }  
                    }   // cierre de While ?>

                      </select><?php if ($error_id == "19") {
                                        echo "<br /><span class=\"errorLetra\"><strong>Error: $errorpass</strong></span>";
                                     }?></td>
                </tr>    
                <!-- <tr class="requerido">
                  <th scope="row">No. De Tarjeta*</th>
                  <td><input name="noTarjetaCredito" type="text" size="20" maxlength="20" class="validate[required,creditCard] text-input" /></td>
                </tr> -->

              </table>
              <div id="metodoDetalle"></div>                        
              <input name="ejecuta" type="hidden" id="ejecuta" value="insertarRegistro" /> 
              <input type="submit" name="btnEnviarRegistro" value="Enviar Registro" id="btnEnviarRegistro" />
              <input type="reset" name="Submit2" value="Reset"  id="buttonReset" />
            </form>
          </div>    



<?php
            break;
        case 'finalizarRegistro': ?>            
 
          <h2><?php echo $_SESSION['loggedUser']['nombreCliente']; ?> Has finalizado el registro Exitosamente</h2>

          <p>Has iniciado sesión en el sistema da clic en continuar para seguir adelante con el proceso de compra</p>

          <div class="contenedorForma">  
            <form id="formaRegistroUsuario2" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <input name="accion" type="hidden" id="accion" value="finalizarCompra" />
              <input type="submit" name="btnEnviarRegistro" value="Continuar" id="btnEnviarRegistro" />
            </form>
          </div>    

<?php
            break;  
        case 'revisarDireccion': ?>

          <h2>Verificar Direccion</h2>
          <p>Los Datos que aparecen a continuación usarán para el envio de los productos, puedes hacer los cambios que desees,
             en caso contrario da clic en el boton Omitir Edicion</p>
  
            
  <script>
    jQuery(document).ready(function(){
      // binds form submission and fields to the validation engine
      jQuery("#formaEdicionUsuario").validationEngine();
    });

  </script>



<?php
            // Obtener lista de Estados
            $cols_arr = array("aPaterno",           // 0
                              "aMaterno",           // 1
                              "direccionlinea1",    // 2
                              "direccionlinea2",    // 3
                              "ciudad",             // 4
                              "idEstado",           // 5
                              "codPostal",          // 6
                              "noTelefono");        // 7
            $num_cols     = count($cols_arr);
            $tables_arr   = array("clientes");
            $num_tables   = count($tables_arr);
            $where_clause = "idCliente = '$idCliente'";  

            $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

            $datosCliente=mysql_fetch_row($result);

            unset($where_clause); ?>

          <div class="contenedorForma">  
            <form id="formaEdicionUsuario" class="formaRegistro" action="<?php echo $target_link7; ?>" method="post">
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Información de Facturación</th>
                </tr>
                <tr>
                  <th scope="row">Nombre(s) </th>
                  <td><input name="nombres" type="text" size="15" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $_SESSION['loggedUser']['nombreCliente']; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Apellido Paterno </th>
                  <td><input name="apaterno" type="text" size="15" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $datosCliente[0]; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Apellido Materno </th>
                  <td><input name="amaterno" type="text" size="15" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $datosCliente[1]; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Direccion (Línea 1) </th>
                  <td><input name="direccionlinea1" type="text" size="25" class="validate[required] text-input" value="<?php echo $datosCliente[2]; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Dirección (Línea 2) </th>
                  <td><input type="text" name="direccionlinea2" size="25" class="validate[required] text-input" value="<?php echo $datosCliente[3]; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Ciudad </th>
                  <td><input type="text" name="ciudad" class="validate[required] text-input" value="<?php echo $datosCliente[4]; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Estado </th>
                  <td><select name="selEstado" class="validate[required] text-input">
                      
<?php
                    echo '<option selected="selected" value="">Selecciona Un Estado</option>';   
                    
                    // Obtener lista de Estados
                    $cols_arr = array("idEstado", 
                                        "estado");
                    $num_cols = count($cols_arr);
                    $tables_arr = array("estados");
                    $num_tables = count($tables_arr);

                    $resultEstados = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                    while($row=mysql_fetch_row($resultEstados)) {    
                      if ($row[0] == $datosCliente[5]) {
                        echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                      } else {
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';                        
                      }  
                    }   // cierre de While
    
?>
                      </select></td>
                </tr>
                <tr>
                  <th scope="row">Código Postal </th>
                  <td><input name="codPostal" type="text" id="codPostal" size="5" maxlength="5" class="validate[required,custom[onlyNumberSp]] text-input"  value="<?php echo $datosCliente[6]; ?>" />
                      </td>
                </tr>
                <tr>
                  <th scope="row">No. Telefónico </th>
                  <td><input name="noTel" type="text" id="noTel" size="10" maxlength="10" class="validate[required,custom[phone]] text-input" value="<?php echo $datosCliente[7]; ?>" /></td>
                </tr>
              </table>
              <input name="ejecuta" type="hidden" id="ejecuta" value="actualizarDireccion" />
              <input type="submit" name="btnActualizarRegistro" value="Acualizar Datos" id="btnActualizarRegistro" />
            </form>  
            <form id="formaOmitirEdicion" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="verificarMedioPago" />
              <input type="submit" name="btnOmitirEdicion" value="Omitir Editar Datos"  id="btnOmitirEdicion" />
            </form>  
            <!-- <p>Registrate <a href="<?php // echo $_SERVER['PHP_SELF']; ?>?accion=registrarUsuario">aqui</a> si no eres usuario</p> -->
          </div>    


<?php              

            break;    

        case 'revisarCambiosRegistro':

?>

          <h2>Los Datos han sido Actualizados</h2>
          <p>Verifica una vez más que los Datos sean correctos, en caso de querer hacer cambios da clicen el botón editar, de lo contrario confirma enviar los datos</p>


<?php

            // Obtener lista de Estados
            $cols_arr = array("aPaterno",           // 0
                              "aMaterno",           // 1
                              "direccionlinea1",    // 2
                              "direccionlinea2",    // 3
                              "ciudad",             // 4
                              "idEstado",           // 5
                              "codPostal",          // 6
                              "noTelefono");        // 7
            $num_cols = count($cols_arr);
            $tables_arr = array("clientes");
            $num_tables = count($tables_arr);
            $where_clause = "idCliente = '$idCliente'"; 

            $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

            $datosCliente=mysql_fetch_row($result);

            unset($where_clause); ?>

          <div class="contenedorForma">  
            <form id="formaEdicionUsuario" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">              
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Información de Facturación</th>
                </tr>
                <tr>
                  <th scope="row">Nombre(s) </th>
                  <td><span class="boldspan"><?php echo $_SESSION['loggedUser']['nombreCliente']; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Apellido Paterno </th>
                  <td><span class="boldspan"><?php echo $datosCliente[0]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Apellido Materno </th>
                  <td><span class="boldspan"><?php echo $datosCliente[1]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Direccion (Línea 1) </th>
                  <td><span class="boldspan"><?php echo $datosCliente[2]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Dirección (Línea 2) </th>
                  <td><span class="boldspan"><?php echo $datosCliente[3]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Ciudad </th>
                  <td><span class="boldspan"><?php echo $datosCliente[4]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Estado </th>
                  <td>
<?php
                    // Obtener lista de Estados
                    $cols_arr     = array("estado");
                    $num_cols     = count($cols_arr);
                    $tables_arr   = array("estados");
                    $num_tables   = count($tables_arr);
                    $where_clause = "idEstado = '$datosCliente[5]'"; 

                    $resultEstado = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                    $estadoDireccionCliente=mysql_fetch_row($resultEstado); 
    
?>
                    <span class="boldspan"><?php echo $estadoDireccionCliente[0]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Código Postal </th>
                  <td><span class="boldspan"><?php echo $datosCliente[6]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">No. Telefónico </th>
                  <td><span class="boldspan"><?php echo $datosCliente[7]; ?></span></td>
                </tr>
              </table>
              <input name="accion" type="hidden" id="accion" value="revisarDireccion" />
              <input type="submit" name="btnEditarRegistro" value="Editar Datos" id="btnEditarRegistro" />
            </form>  
            <form id="formaVerificarMedioDePago" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="verificarMedioPago" />
              <input type="submit" name="btnOmitirEdicion" value="Continuar" id="btnOmitirEdicion" />
            </form>  
            <!-- <p>Registrate <a href="<?php // echo $_SERVER['PHP_SELF']; ?>?accion=registrarUsuario">aqui</a> si no eres usuario</p> -->
          </div>   

<?php

          break;    

        case 'verificarMedioPago': ?>
  
  <script>
    jQuery(document).ready(function(){
      // binds form submission and fields to the validation engine
      jQuery("#formaEditarMetodoPago").validationEngine();
    });

  </script>



<?php     // Obtener id del tipo de medio de pago y ei id del detalle del medio pago
          $cols_arr     = array("idMetodoPago",
                                "idDetalleMedioDePago");
          $num_cols     = count($cols_arr);
          $tables_arr   = array("clientes");
          $num_tables   = count($tables_arr);
          $where_clause = "idCliente = '$idCliente'"; 

          $medioPagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          $medioDePagoActual=mysql_fetch_row($medioPagoResult); 

?>

         <h2>Verifica los Datos del Metodo de Pago a usar</h2>

         <p>Verifica los datos del Medio de Pago que tenemos registrado, en caso de que todos sean correctos y no desees cambiar tu medio de pago actual da clic en Proceder Al Cobro </p>

          <div class="contenedorForma">  
            <form id="formaEditarMetodoPago" class="formaRegistro" action="<?php echo $target_link7; ?>" method="post">
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Forma de Pago</th>
                </tr>   
    <?php switch($medioDePagoActual[0]) { 
            case '1': 
              
              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago",
                                    "nombreInstitucion",
                                    "mesExpiracion",
                                    "anioExpiracion",
                                    "infoVerificacion");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>

                <tr>
                  <th scope="row">No. De Tarjeta de Crédito </th>
                  <td><input name="noTarjetaCredito" type="text" size="20" maxlength="20" class="validate[required,creditCard] text-input" value="<?php echo $medioDetalles[0] ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Banco Emisor </th>
                  <td><input name="bancoEmisor" type="text" size="15" maxlength="15" class="validate[required] text-input" value="<?php echo $medioDetalles[1] ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Fecha de Vencimiento </th>
                  <td><select name="mesVencimiento">
           <?php  $mesOpciones = generarMeses($medioDetalles[2]);
                  echo $mesOpciones; ?>
                      </select>
                      <select name="anioVencimiento">
           <?php  $anioOpciones = generarAnios($medioDetalles[3]);
                  echo $anioOpciones; ?>
                      </select></td>
                </tr>
                <tr>
                  <th scope="row">Digito Verificador </th>
                  <td><input name="digitoVerificador" type="text" size="4" maxlength="4" class="validate[required]" value="<?php echo $medioDetalles[4]; ?>" /></td>
                </tr>     
          <?php break; 
            case '2':

              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago",
                                    "nombreInstitucion",
                                    "mesExpiracion",
                                    "anioExpiracion");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>
                
                <tr>
                  <th scope="row">No. De Tarjeta de Débito </th>
                  <td><input name="noTarjetaDebito" type="text" size="12" class="validate[required,creditCard] text-input" value="<?php echo $medioDetalles[0] ?>" /></td>
                </tr>
                  <tr>
                  <th scope="row">Banco Emisor </th>
                  <td><input name="bancoEmisor" type="text" size="12" maxlength="12" class="validate[required] text-input" value="<?php echo $medioDetalles[1] ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Fecha de Vencimiento </th>
                  <td><select name="mesVencimiento">
           <?php  $mesOpciones = generarMeses($medioDetalles[2]);
                  echo $mesOpciones; ?>
                      </select>
                      <select name="anioVencimiento">
           <?php  $anioOpciones = generarAnios($medioDetalles[3]);
                  echo $anioOpciones; ?>
                      </select></td>
                </tr>      
          <?php break;
            case '3': 

              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>
                 
                <tr>
                  <th scope="row">PayPal Correo Electrónico </th>
                  <td><input name="paypalCorreoe" type="text" size="20" class="validate[required,custom[email]] text-input" value="<?php echo $medioDetalles[0]; ?>" /></td>
                </tr>
                <tr>
                  <th scope="row">Contraseña Actual (Oculta) </th>
                  <td><input disabled="disabled" id="paypalContraMostrar" name="paypalContraMostrar" type="password" size="12" maxlength="12" value="12345678910" /></td>
                </tr>                
                <tr>
                  <th scope="row">Nueva Contraseña</th>
                  <td><input id="paypalContra" name="paypalContra" type="password" size="12" maxlength="12" class="validate[required] text-input" /></td>
                </tr>
                <tr>
                  <th scope="row">Confirma Nueva Contraseña </th>
                  <td><input id="paypalContra2" name="paypalContra2" type="password" size="12" maxlength="12" class="validate[required,equals[paypalContra]] text-input" /></td>
                </tr>
          <?php break;
          } // Cierre de switch ?> 
              </table>
              <input name="ejecuta" type="hidden" id="ejecuta" value="actualizaMedioPago" />
              <input name="tipoMedioDePagoActual" type="hidden" id="tipoMedioDePagoActual" value="<?php echo $medioDePagoActual[0]; ?>" />
              <input name="medioDePagoActual" type="hidden" id="medioDePagoActual" value="<?php echo $medioDePagoActual[1]; ?>" /> 
              <input type="submit" name="btnActualizarDatos" value="Actualizar Datos" id="btnActualizarDatos" />
            </form>   
            <form id="formaCambiarDatosMedioDePago" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="cambiarDatosMedioPago" />
              <input type="submit" name="btnOmitirEdicion" value="Cambiar Medio de Pago" id="btnOmitirEdicion" />
            </form>  
            <form id="formaOmitirCambiar" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="confirmacionFinal" />
              <input type="submit" name="btnProceder" value="Proceder Al Cobro" id="btnProceder" />
            </form>             
          </div>


    <?php break;   
        case 'revisarCambiosMedioPago': ?>


<?php     // Obtener id del tipo de medio de pago y ei id del detalle del medio pago
          $cols_arr     = array("idMetodoPago",
                                "idDetalleMedioDePago");
          $num_cols     = count($cols_arr);
          $tables_arr   = array("clientes");
          $num_tables   = count($tables_arr);
          $where_clause = "idCliente = '$idCliente'"; 

          $medioPagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          $medioDePagoActual=mysql_fetch_row($medioPagoResult); ?>


          <h2>Los Datos del Medio de Pago han sido Actualizados</h2>
          <p>Verifica una vez más que los Datos sean correctos, en caso de querer hacer cambios da clicen el botón Editar, de o contrario confirma dando Clic en Proceder</p>

          <div class="contenedorForma">  
            <form id="formaMostrarCambiosMetodoPago" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Forma de Pago</th>
                </tr>   
    <?php switch($medioDePagoActual[0]) { 
            case '1': 
              
              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago",
                                    "nombreInstitucion",
                                    "mesExpiracion",
                                    "anioExpiracion",
                                    "infoVerificacion");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>

                <tr>
                  <th scope="row">No. De Tarjeta de Crédito </th>
                  <td><?php $noCuentaOculta = ocultaCaracteres($medioDetalles[0], 12); echo $noCuentaOculta; ?></td>
                </tr>
                <tr>
                  <th scope="row">Banco Emisor </th>
                  <td><?php echo $medioDetalles[1] ?></td>
                </tr>
                <tr>
                  <th scope="row">Fecha de Vencimiento </th>
                  <td><?php echo $medioDetalles[2] .'/' . $medioDetalles[3] ?></td>
                </tr>
                <tr>
                  <th scope="row">Digito Verificador </th>
                  <td><?php $noDigitoOculta = ocultaCaracteres($medioDetalles[4], 3); echo $noDigitoOculta; ?></td>
                </tr>     
          <?php break; 
            case '2':

              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago",
                                    "nombreInstitucion",
                                    "mesExpiracion",
                                    "anioExpiracion");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>
                
                <tr>
                  <th scope="row">No. De Tarjeta de Débito </th>
                  <td><?php $noCuentaOculta = ocultaCaracteres($medioDetalles[0], 12); echo $noCuentaOculta; ?></td>
                </tr>
                  <tr>
                  <th scope="row">Banco Emisor </th>
                  <td><?php echo $medioDetalles[1] ?></td>
                </tr>
                <tr><?php echo $medioDetalles[2] .'/' . $medioDetalles[3] ?></td>
                </tr>      
          <?php break;
            case '3': 

              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>
                 
                <tr>
                  <th scope="row">PayPal Correo Electrónico </th>
                  <td><?php echo $medioDetalles[0]; ?></td>
                </tr>
                <tr>
                  <th scope="row">Contraseña (Oculta) </th>
                  <td><input disabled="disabled" id="paypalContraMostrar" name="paypalContraMostrar" type="password" size="12" maxlength="12" value="12345678910" /></td>
                </tr>                
          <?php break;
          } // Cierre de switch ?> 
              </table>
              <input name="accion" type="hidden" id="accion" value="verificarMedioPago" />
              <input type="submit" name="btnEditarDatos" value="Volver A Editar" id="btnEditarDatos" />
            </form>  
            <form id="formaOmitirCambiar" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="confirmacionFinal" />
              <input type="submit" name="btnProceder" value="Proceder Al Cobro" id="btnProceder" />
            </form>             
          </div>

    <?php break;   
        case 'cambiarDatosMedioPago': 

          // Obtener id del tipo de medio de pago y ei id del detalle del medio pago
          $cols_arr     = array("idDetalleMedioDePago");
          $num_cols     = count($cols_arr);
          $tables_arr   = array("clientes");
          $num_tables   = count($tables_arr);
          $where_clause = "idCliente = '$idCliente'"; 

          $medioPagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          unset($where_clause);

          $medioDePagoActual=mysql_fetch_row($medioPagoResult); ?>

          <h2>Elige un medio de pago diferente</h2>
          <p>Slecciona un medio de pago de la lista e introduce los datos correspondientes</p>


            <div class="contenedorForma">  
            <form id="formaMetodoPago" class="formaRegistro" action="<?php echo $target_link7; ?>" method="post">
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Forma de Pago</th>
                </tr>
                <tr>
                  <th scope="row">Metodo de Pago</th>
                  <td><select name="selMetodoPago" id="selMetodoPago" onchange="javascript: metodoElegido()">
                      
<?php
                    echo '<option value="0" selected="selected">Selecciona Una Forma de Pago</option>';   
                    
                    // Obtener lista de Estados
                    $cols_arr = array("idMetodoPago", 
                                      "metodoPago");
                    $num_cols = count($cols_arr);
                    $tables_arr = array("metodopago");
                    $num_tables = count($tables_arr);

                    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                    while($row=mysql_fetch_row($result)) {    
                      if (isset($err_return) and $row[0] == $selEstado) {
                        echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                      } else {  
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                      }  
                    }   // cierre de While
    
?>
                      </select></td>
                </tr>    

              </table>
              <div id="metodoDetalle"></div>                        
              <input name="ejecuta" type="hidden" id="ejecuta" value="actualizaMedioPago" />
              <input name="medioDePagoActual" type="hidden" id="medioDePagoActual" value="<?php echo $medioDePagoActual[0]; ?>" /> 
              <input type="submit" name="btnEnviarDatos" value="Enviar Datos" id="btnEnviarRegistro" />
              <input type="reset" name="Submit2" value="Reset"  id="buttonReset" />
            </form>
            <form id="formaOmitirCambiar" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="confirmacionFinal" />
              <input type="submit" name="btnProceder" value="Proceder Al Cobro Sin Cambios" id="btnProceder" />
            </form>             

            <form id="formaCancelarCambioMedioPago" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
              <input name="accion" type="hidden" id="accion" value="verificarMedioPago" />
              <input type="submit" name="btnCancelar" value="Cancelar" id="btnCacelar" />
            </form>
          </div>    

  <?php   break; 
        case 'confirmacionFinal' ?>

          <h2>Confirma Que los Datos son Correctos</h2>
          <p>Estos datos son los que se utilizaran para procesar tu pedido, da clic en confirmar si estos son correctos, si deseas modificar algún dato da clic en Editar</p>

<?php       // Obtener datos del cliente lista de Estados
            $cols_arr = array("aPaterno",           // 0
                              "aMaterno",           // 1
                              "direccionlinea1",    // 2
                              "direccionlinea2",    // 3
                              "ciudad",             // 4
                              "idEstado",           // 5
                              "codPostal",          // 6
                              "noTelefono");        // 7
            $num_cols = count($cols_arr);
            $tables_arr = array("clientes");
            $num_tables = count($tables_arr);
            $where_clause = "idCliente = '$idCliente'";

            $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

            $datosCliente=mysql_fetch_row($result); 

            unset($where_clause); ?>

          <div class="contenedorForma">  
            <form id="formaRevisionFinal" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">              
              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Información de Facturación</th>
                </tr>
                <tr>
                  <th scope="row">Nombre(s) </th>
                  <td><span class="boldspan"><?php echo $_SESSION['loggedUser']['nombreCliente']; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Apellido Paterno </th>
                  <td><span class="boldspan"><?php echo $datosCliente[0]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Apellido Materno </th>
                  <td><span class="boldspan"><?php echo $datosCliente[1]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Direccion (Línea 1) </th>
                  <td><span class="boldspan"><?php echo $datosCliente[2]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Dirección (Línea 2) </th>
                  <td><span class="boldspan"><?php echo $datosCliente[3]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Ciudad </th>
                  <td><span class="boldspan"><?php echo $datosCliente[4]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Estado </th>
                  <td>
<?php
                    // Obtener lista de Estados
                    $cols_arr     = array("estado");
                    $num_cols     = count($cols_arr);
                    $tables_arr   = array("estados");
                    $num_tables   = count($tables_arr);
                    $where_clause = "idEstado = '$datosCliente[5]'"; 

                    $resultEstado = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                    $estadoDireccionCliente=mysql_fetch_row($resultEstado); 
    
?>
                    <span class="boldspan"><?php echo $estadoDireccionCliente[0]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">Código Postal </th>
                  <td><span class="boldspan"><?php echo $datosCliente[6]; ?></span></td>
                </tr>
                <tr>
                  <th scope="row">No. Telefónico </th>
                  <td><span class="boldspan"><?php echo $datosCliente[7]; ?></span></td>
                </tr>
              </table>

<?php     // Obtener id del tipo de medio de pago y ei id del detalle del medio pago
          $cols_arr     = array("idMetodoPago",
                                "idDetalleMedioDePago");
          $num_cols     = count($cols_arr);
          $tables_arr   = array("clientes");
          $num_tables   = count($tables_arr);
          $where_clause = "idCliente = '$idCliente'"; 

          $medioPagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          $medioDePagoActual=mysql_fetch_row($medioPagoResult); ?>

              <table cellspacing="0">
                <tr class="encabezado">
                  <th colspan="2">Forma de Pago</th>
                </tr>   
    <?php switch($medioDePagoActual[0]) { 
            case '1': 
              
              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago",
                                    "nombreInstitucion",
                                    "mesExpiracion",
                                    "anioExpiracion",
                                    "infoVerificacion");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>

                <tr>
                  <th scope="row">No. De Tarjeta de Crédito </th>
                  <td><?php $noCuentaOculta = ocultaCaracteres($medioDetalles[0], 12); echo $noCuentaOculta; ?></td>
                </tr>
                <tr>
                  <th scope="row">Banco Emisor </th>
                  <td><?php echo $medioDetalles[1] ?></td>
                </tr>
                <tr>
                  <th scope="row">Fecha de Vencimiento </th>
                  <td><?php echo $medioDetalles[2] .'/' . $medioDetalles[3] ?></td>
                </tr>
                <tr>
                  <th scope="row">Digito Verificador </th>
                  <td><?php $noDigitoOculta = ocultaCaracteres($medioDetalles[4], 3); echo $noDigitoOculta; ?></td>
                </tr>     
          <?php break; 
            case '2':

              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago",
                                    "nombreInstitucion",
                                    "mesExpiracion",
                                    "anioExpiracion");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>
                
                <tr>
                  <th scope="row">No. De Tarjeta de Débito </th>
                  <td><?php $noCuentaOculta = ocultaCaracteres($medioDetalles[0], 12); echo $noCuentaOculta; ?></td>
                </tr>
                  <tr>
                  <th scope="row">Banco Emisor </th>
                  <td><?php echo $medioDetalles[1] ?></td>
                </tr>
                <tr><?php echo $medioDetalles[2] .'/' . $medioDetalles[3] ?></td>
                </tr>      
          <?php break;
            case '3': 

              // Obtener datos Medio de Pago
              $cols_arr     = array("cuentaMedioPago");
              $num_cols     = count($cols_arr);
              $tables_arr   = array("detallemediodepago");
              $num_tables   = count($tables_arr);
              $where_clause = "idDetalleMedioDePago = '$medioDePagoActual[1]'"; 

              $medioDetallePagoResult = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              $medioDetalles=mysql_fetch_row($medioDetallePagoResult); ?>
                 
                <tr>
                  <th scope="row">PayPal Correo Electrónico </th>
                  <td><?php echo $medioDetalles[0]; ?></td>
                </tr>
                <tr>
                  <th scope="row">Contraseña (Oculta) </th>
                  <td><input disabled="disabled" id="paypalContraMostrar" name="paypalContraMostrar" type="password" size="12" maxlength="12" value="12345678910" /></td>
                </tr>                
          <?php break;
          } // Cierre de switch ?> 
              </table>
              <input name="accion" type="hidden" id="accion" value="revisarDireccion" />
              <input type="submit" name="btnEditarRegistro" value="Editar Datos" id="btnEditarRegistro" />
            </form>  
            <form id="formaConfirmarCompra" class="formaRegistro" action="<?php echo $target_link11; ?>" method="post">  
              <!-- <input name="accion" type="hidden" id="ejecuta" value="enviaPedido" /> -->
              <input type="submit" name="btnConfirmarCompra" value="Terminar Compra" id="btnConfirmarCompra" />
            </form>  
          </div>   



    <?php break; 
        case 'resultadosCompra': ?>
              
          <h2>Compra Finalizada</h2>
          <p> Feliciades!!!, <?php echo $_SESSION['loggedUser']['nombreCliente']; ?>, has concluido exitosamente tu compra, en breve recibirás un correo electronico de confirmación
           con los mismos detalles que aparecen a continuación:</p>

          <div id="contenedorCanasta">

            <table id="tablaCanciones" border="0" cellpadding="0" cellspacing="0">
                <thead>
                  <th>No.Prod</th>
                  <th>Artista</th>  
                  <th>Titulo</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Importe</th>
                </thead>    
                <tbody>

<?php

            $noProductosCanasta = count($_SESSION['carritoCanasta']);  
            $textoImporteItem = 'importeItem';
            $_SESSION['cantidadProductosTotal'] = 0;
            
            for ($i=0; $i < $noProductosCanasta; $i++) { 
              

                $cols_arr     = array("idDisco",           // 0
                                      "artista",           // 1
                                      "titulo",            // 2
                                      "descripcion",       // 3
                                      "precio");           // 4
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("discos", 
                                       "artistas");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idArtista");
                $where_clause  = 'idDisco = \'' . $_SESSION['carritoCanasta'][$i]['id'] . '\'';

                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                $row=mysql_fetch_row($result);

                
                ${$importeItem.$i} = $_SESSION['carritoCanasta'][$i]['cantidad']*$row[4]; 

?>                

                <tr class="<?php $oddevencheck = $i % 2;  
                  if ($oddevencheck == 0) {
                    echo "even";
                  } else {
                    echo "odd";
                  } ?>">

                  <td class="textoCeldasDetalle"><?php echo $row[0]; ?></td>
                  <td class="textoCeldasDetalle"><?php echo $row[1]; ?></td>
                  <td class="textoCeldasDetalle"><?php echo $row[2]; ?></td>
                  <td class="textoCeldasDetalle"><?php echo $row[3]; ?></td>
                  <td class="textoCeldasDetalle"><?php echo $_SESSION['carritoCanasta'][$i]['cantidad']; ?></td>
                  <td class="textoCeldasDetalle"><?php echo $row[4]; ?></td>
                  <td class="textoCeldasDetalle"><?php echo '$' . ${$importeItem.$i}; ?></td>
                </tr> 
<?php
                $importeTotalProductos = $importeTotalProductos + ${$importeItem.$i};
                $_SESSION['cantidadProductosTotal'] =  $_SESSION['cantidadProductosTotal'] + $_SESSION['carritoCanasta'][$i]['cantidad']; 
            } // Cierre For

?>
                <tr>
                  <td></td>
                  <td><form id="volverATienda" name="volverATienda" method="post" action="<?php echo $target_link10; ?>" target="_top">
                          <!-- <input type="hidden" name="accion" id="accion" value="vaciarCarrito" /> -->
                          <input name="btnRegresarATienda" type="submit" id="btnRegresarATienda" value="Regresar A Explorar la Tienda" />
                        </form></td>
                  <td></td>
                  <td class="derechaCelda">Total de Productos:</td>
                  <td><span class="boldspan"><?php echo $_SESSION['cantidadProductosTotal']; ?></span></td>
                  <td>Importe Total:</td>
                  <td><?php echo '$' . $importeTotalProductos; ?></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>I.V.A:</td>
                  <td><?php $importeIVA = $importeTotalProductos*0.16; echo '$' . $importeIVA; ?></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Envio:</td>
                  <td><?php 
                            if ($importeTotalProductos > 1500)  {
                              $gastosEnvio = 0;
                            } else {
                              $gastosEnvio = 300;
                            }      
                            echo '$' . $gastosEnvio; ?></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>:Total:</td>
                  <td><?php $totalCompra = $importeTotalProductos+importeIVA+$gastosEnvio;
                            echo $totalCompra; ?></td>
                </tr>

              </tbody>
          </table>
        </div>


<?php   $_SESSION['cantidadProductosTotal'] = 0;
        unset($_SESSION['carritoCanasta']);
        break;    

       } // Cierre de Switch
    ?>      


 





      </div>
      <!-- CIERRE DIV CONTENEDOR BORDES -->

    </section>    
    <!-- CIERRE SECCION FINALIZAR COMPRA -->

  </section>
  <!-- CIERRE SECCION CONTENIDO -->

   
  <!-- PIE DE PAGINA -->
  <footer id="footerPlasticos">
    &copy; 2012 Plasticos Sonoros
  </footer>




  <div id="variabletest">

<?php 

    include 'variable_test.php';

 ?>

  </div>

</body>
</html>

