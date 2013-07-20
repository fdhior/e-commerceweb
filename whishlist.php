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

    if (isset($ejecuta)) {
        $_SESSION['ejecutaDeseo'] = array();
        $_SESSION['ejecutaDeseo']['ejecuta'] = $ejecuta; 
        
        if (isset($idDisco)) {
          $_SESSION['ejecutaDeseo']['idDisco'] = $idDisco;
        }
        
        if (isset($idDeseo)) {
          $_SESSION['ejecutaDeseo']['idDeseo'] = $idDeseo;
        }  
    }
    
 //   $inputUser = trim($_POST['username']);
 //   $inputPass = trim($_POST['password']);

    /* if (isset($_SESSION['err_return'])) {
      $err_return = $_SESSION['err_return'];
      foreach ($err_return as $nombre => $valor) {
        ${$nombre} = $valor;
      } // Cierre foreach     
    } 
    unset($_SESSION['err_return']); */

    if (isset($_SESSION['var_return'])) {
      $var_return = $_SESSION['var_return'];
      foreach ($var_return as $nombre => $valor) {
        ${$nombre} = $valor;
      } // Cierre foreach     
      unset($_SESSION['var_return']); 
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
      <div id="centrar-contenido-header">
        <div id="logo">
          <img src="images/logo.png" alt="LOGO">
        </div> 
        
<?php
        
        include 'campobusqueda.htm';
  
?> 
      </div> 
    </header>
    <!-- FIN DE ENCABEZADO -->
 		 
  <!-- SECCION CONTENIDO -->
  <section id="contenido">

    <!-- BARRA DE VAVEGACION -->   
    <nav>

<?php

        include 'navbar.htm';
  
?>     

    </nav> 
    <!-- FIN DE BARRA DE NAVEGACION -->

    <!-- SECCION TEXTO NOSOTROS -->
    <section class="contenedorSeccion2">

      <h2>Lista de Desesos (Wishlist)</h2>

      <div class="contenedorBordes">

<?php if(!isset($accion)) {
        if (!isset($_SESSION['loggedUser'])) { ?>
        
          <h2>No has iniciado Sesión</h2>
          <p>Antes de poder ver tu lista de deseos, debes iniciar session, puedes
             hacerlo <a href="<? echo $_SERVER['PHP_SELF']; ?>?accion=registroUsuario">aqui</a>
             y despues regresar a esta lista</p>

  <?php } else { ?>

          <h2>¿Que hacer cuando no hay existencia de un producto?</h2>
          <p>Esta lista se usa cuando encuentras un producto que no tiene existencia
             y que quieres adquirir, en cuanto tengamos el producto disponible te lo
             haremos saber para que lo puedas adquirir, a continuacion: ponemos el
             detalle de la lista que has armado</p>
  <?php // Funcionalidad de la lista de deseos 

        if (isset($_SESSION['ejecutaDeseo'])) {
          
          $idDisco = $_SESSION['ejecutaDeseo']['idDisco'];

          switch ($_SESSION['ejecutaDeseo']['ejecuta']) {
            case 'agregaDiscoDeseo':
                
                // Inserta el registro de un nuevo deseo pera el cliente actual
                $colsarr   = array("idDeseo",
                                   "idDisco",
                                   "idCliente");
                $numcols   = count($colsarr);
                $valarr    = array("NULL",
                                   "'$idDisco'", 
                                   "'$idCliente'");
                $aff_table = "whishlist";

                $result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table);
                break;        

            case 'eliminaDiscoDeseo':
                
                $aff_table    = "whishlist";
                $where_clause = "idDeseo = $idDeseo";

                $result = gnrl_delete_query($aff_table, $where_clause);
                break; 

          } // Cierre de swith
          unset($_SESSION['ejecutaDeseo']); 
        } // Cierre de if 
      

                $cols_arr     = array("whishlist.`idDisco`",   // 0
                                      "artista",               // 1
                                      "titulo",                // 2
                                      "descripcion",           // 3
                                      "existencia",            // 4
                                      "precio",                // 5
                                      "idDeseo");              // 6
                $num_cols      = count($cols_arr);
                $join_tables   = 1;
                $connect       = 1;
                $tables_arr    = array("whishlist", 
                                       "discos",
                                       "artistas");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idDisco",
                                       "idArtista");
                $where_clause  = "whishlist.`idCliente` = '$idCliente'";

                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

                if (mysql_num_rows($result) == 0) { ?>

                  <p><span class"bolds  pan">No has ingresado ningun producto a tu lista de deseos, puedes agregar cualquier producto
                     que por el momento no tenga existencia, realizando una busqueda.</span></p>
          
          <?php } else { ?>

          <div id="contenedorCanasta">

            <table id="tablaCanciones" border="0" cellpadding="0" cellspacing="0">
                <thead>
                  <th>No. Lista</th>
                  <th>Artista</th>  
                  <th>Titulo</th>
                  <th>Descripción</th>
                  <th>Existencia</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </thead>    
                <tbody>


         <?php  $i = 0;
                while($row=mysql_fetch_row($result)) { ?>
                

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
                  <td class="textoCeldasDetalle"><?php echo $row[4]; ?></td>
                  <td class="textoCeldasDetalle">$ <?php echo $row[5]; ?></td>
                  <td class="textoCeldasDetalle">
              <?php if($row[4] > 0) { ?>
                    <form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $target_link4; ?>" target="_top">
                      <input type="hidden" name="accion" id="accion" value="agregarProducto" />
                      <input type="hidden" name="idDisco" id="idDisco" value="<?php echo $row[0]; ?>" />
                      <input name="btnAgregarAlCarrito" type="submit" id="btnAgregarAlCarrito" value="Agregar a la Compra" />
                    </form>  
              <?php } else { ?>
                    <form id="formaEliminarDeseo" name="formaEliminarDeseo" method="post" action="<?php echo $target_link20; ?>" target="_top">
                      <input type="hidden" name="ejecuta" id="ejecuta" value="eliminaDiscoDeseo" />
                      <input type="hidden" name="idDeseo" id="idDeseo" value="<?php echo $row[6]; ?>" /> 
                      <input name="btnEliminar" type="submit" id="btnEliminar" value="Eliminar de la Lista" />
                    </form>
              <?php } ?>      
                  </td>
                </tr> 
<?php             $i++;
                } // Cierre de While

?>
              </tbody>
          </table>
       </div>
      
      <p>Cuando el producto tenga existencia, tendrás la opcion de agregarlo
         al carrito de compras como cualquier otro producto que haya en la tienda</p>
 

<?php
          }
        } // Cierre de Else
      } // Cierre de if 

      switch ($accion) {
           case 'registroUsuario': ?>

            <h2>Inicia Sesión en la Tienda o Registrate</h2>

            <div class="contenedorForma">  
              <form id="formaLogin" method="post" action="<?php echo $target_link9; ?>" target="_top">
                <label>Usuario:</label>
                <input type="text" size="10" name="username" /><br />
                <label>Contraseña:</label>
                <input type="password" size="10" name="password" /><br />
                <input name="llamadaLogin" type="hidden" id="llamadaLogin" value="wishlist" />
                <input name="submit" type="submit" class="btnEnviar" value="ingresar" /></td>
              </form><br />
              <p>Registrate <a href="<?php echo $_SERVER['PHP_SELF']; ?>?accion=registrarUsuario">aqui</a> si no eres usuario</p>
            </div>               

        <?php break;
           case 'registrarUsuario': ?>

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
                  <th colspan="2">Informacion Adicional</th>
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
              </table>
              <!-- <input name="ejecuta" type="hidden" id="ejecuta" value="verificaFormaRegistro1" /> -->
              <input name="registroOrigen" type="hidden" id="registroOrigen" value="whishlist" />
              <input type="submit" name="btnEnviarRegistro" value="Enviar Registro" id="btnEnviarRegistro" />
              <input type="reset" name="Submit2" value="Reset"  id="buttonReset" />
            </form>  
            <!-- <p>Registrate <a href="<?php // echo $_SERVER['PHP_SELF']; ?>?accion=registrarUsuario">aqui</a> si no eres usuario</p> -->
          </div>    
           
        <?php break;
         case 'registroParcial':
            // Generar contraseña
            $md5_pass = MD5($pass);     

            // Inserta registro de el resto de los datos del nuevo cliente en la base de datos
            $colsarr = array("idCliente",
                             "nombreusuario", 
                             "nombres", 
                             "aPaterno", 
                             "aMaterno",
                             "correoe",
                             "contra");
            $numcols = count($colsarr);
            $valarr = array("NULL",
                            "'$nombreUsuario'", 
                            "'$nombres'", 
                            "'$apaterno'", 
                            "'$amaterno'",
                            "'$correoe'",
                            "'$md5_pass'");
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
                                            "openSession" => "true"); ?>
  
 
            <h2><?php echo $_SESSION['loggedUser']['nombreCliente']; ?> Has finalizado el registro Exitosamente</h2>

            <p>Has iniciado sesión en el sistema da clic en continuar para seguir ver tu Lista de Deseos</p>

            <div class="contenedorForma">  
              <form id="formaRegistroUsuario2" class="formaRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="submit" name="btnEnviarRegistro" value="Continuar" id="btnEnviarRegistro" />
              </form>
            </div>    

<?php
            break;


           default:
              # code...
              break;
         }   ?>


       </div>

    </section>
    <!-- CIERRE SECCION TEXTO NOSOTROS -->

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