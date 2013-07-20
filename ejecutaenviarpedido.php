<?php session_start();

    $rutafunciones = 'funciones/';
    include $rutafunciones.'consultas.php';    

    $idCliente = $_SESSION['loggedUser']['idCliente'];

    $noProductosCanasta = count($_SESSION['carritoCanasta']);  
    $textoImporteItem = 'importeItem';
    $_SESSION['cantidadProductosTotal'] = 0;

  
    /* --------------------------------------- INSERTA LOS DATOS EN LA BASE DE DATOS ---------------------------- */

    // Insertar el pedido
    $colsarr = array("idPedido",
                     "idCliente",
                     "fechaAlta",
                     "idPedidoStatus"); 
    $numcols = count($colsarr);
    $valarr  = array("NULL",
                     "'$idCliente'",
                     "CURRENT_TIMESTAMP",
                     "1");
    $aff_table = "pedidos";

    $result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

    // Recuperar el id del pedido recien insertado
    $cols_arr      = array("MAX(idPedido)");
    $num_cols      = count($cols_arr);
    $tables_arr    = array("pedidos");

    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $idPedido=mysql_fetch_row($result);


    // discos por pedido        
   for ($i=0; $i < $noProductosCanasta; $i++) { 
              

      $cols_arr     = array("precio");           
      $num_cols      = count($cols_arr);
      $tables_arr    = array("discos");
      $where_clause  = 'idDisco = \'' . $_SESSION['carritoCanasta'][$i]['id'] . '\'';

      $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

      $precioDisco=mysql_fetch_row($result);

      $idDisco = $_SESSION['carritoCanasta'][$i]['id'];
      $cantidadItem = $_SESSION['carritoCanasta'][$i]['cantidad'];
      ${$importeItem.$i} = $_SESSION['carritoCanasta'][$i]['cantidad']*$precioDisco[0]; 

      // Insertar productos
      $colsarr = array("idDisco",
                       "idPedido",
                       "cantidad",
                       "importeItems"); 
      $numcols = count($colsarr);
      $valarr  = array("'$idDisco'",
                       "'$idPedido[0]'",
                       "'$cantidadItem'",
                       "${$importeItem.$i}");
      $aff_table = "discosporpedido";

      $result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

      $importeTotalProductos = $importeTotalProductos + ${$importeItem.$i};
    
      $_SESSION['cantidadProductosTotal'] =  $_SESSION['cantidadProductosTotal'] + $_SESSION['carritoCanasta'][$i]['cantidad']; 
    
    } // Cierre For */

    $cantidadProductosTotal = $_SESSION['cantidadProductosTotal'];

    if ($importeTotalProductos > 1500)  {
      $gastosEnvio = 0;
    } else {
      $gastosEnvio = 300;
    } 

    $importeIVA = $importeTotalProductos*0.16;  

    $totalCompra = $importeTotalProductos+$importeIVA+$gastosEnvio;



    $colsvalarr   = array("cantProductos = '$cantidadProductosTotal'",
                          "montoEnvio    = '$gastosEnvio'",
                          "subtotal      = '$importeTotalProductos'",
                          "iva           = '$importeIVA'",
                          "total         = '$totalCompra'");
    $numcols      = count($colsvalarr); 
    $aff_table    = "pedidos";
    $where_clause = "idPedido = '$idPedido[0]'";

    $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

    /* --------------------------------------------------------------------------------------------------------------------------------------*/

    /* ENVIO DE CORREO DE CONFIRMACION */

    // Recuperar el correo electronico del cliente
    $cols_arr      = array("correoe");
    $num_cols      = count($cols_arr);
    $tables_arr    = array("clientes");
    $where_clause  = "idCliente = '$idCliente'";

    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $direc_destino=mysql_fetch_row($result);

    // Construir e-mail de confrmacion del pedido
    $encabezado = "MIME-Version: 1.0\r\n";
    $encabezado .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $encabezado .= "From: PLASTICOS SONOROS <ventas@plasticossonoros.com>";
    $encabezado .= "Reply-To: li094106303@rigel.fca.unam.mx\r\n"; 
    $encabezado .= "Return-path: li094106303@rigel.fca.unam.mx\r\n"; 
    $encabezado .= "BCc: li094106303@rigel.fca.unam.mx\r\n"; 
    $asunto = "PLASTICOS SONOROS - DETALLE DE PEDIDO";

    // Contruir el cuerpo HTML del correo de confirmacion
    $cuerpoHTML = '<h2>Detalle del Pedido</h2>';
    $cuerpoHTML .= '<p>' . $_SESSION['loggedUser']['nombreCliente'] . ' ' . $_SESSION['loggedUser']['apellidosCliente'] . ' ';
    $cuerpoHTML .= 'este es el detalle del Pedido que acabas de hacer a nuestra tienda</p>';
  

    $cuerpoHTML .= '
        <div id="contenedorCanasta">

            <table border="0" cellpadding="0" cellspacing="0">
                <thead>
                  <th>No.Prod</th>
                  <th>Artista</th>  
                  <th>Titulo</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Importe</th>
                </thead>    
                <tbody>';

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

    $cuerpoHTML .= '<tr>';

    $cuerpoHTML .= '<td>' . $row[0] . '</td>
                  <td>' . $row[1] . '</td>
                  <td>' . $row[2] . '</td>
                  <td>' . $row[3] . '</td>
                  <td>' . $_SESSION['carritoCanasta'][$i]['cantidad'] . '</td>
                  <td>' . $row[4] .'</td>
                  <td>$' . ${$importeItem.$i} . '</td>
                </tr>'; 

                $importeTotalProductos = $importeTotalProductos + ${$importeItem.$i};
                // if ($_SESSION['cantidadProductosTotal'] == 0) {
                  // $_SESSION['cantidadProductosTotal'] = $_SESSION['carritoCanasta'][$i]['cantidad'];
                // } else {
                $cantidadProductosTotal =  $cantidadProductosTotal + $_SESSION['carritoCanasta'][$i]['cantidad']; 
                // }  
            } // Cierre For
                $importeIVA = $importeTotalProductos*0.16;

                if ($importeTotalProductos > 1500)  {
                  $gastosEnvio = 0;
                } else {
                  $gastosEnvio = 300;
                }      

                $totalCompra = $importeTotalProductos+importeIVA+$gastosEnvio;

    $cuerpoHTML .= '<tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total de Productos:</td>
                  <td>' . $_SESSION['cantidadProductosTotal'] . '</td>
                  <td>Importe Total:</td>
                  <td>$ ' . $importeTotalProductos . '</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>I.V.A:</td>
                  <td>$ ' . $importeIVA . '</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Envio:</td>
                  <td>' . $gastosEnvio . '</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>:Total:</td>
                  <td>' . $totalCompra . '</td>
                </tr>

              </tbody>
          </table>
        </div>';

    // Enviar Correo 
    $cuerpoHTML .= '<p>En el momento que hayamos confirmado tu pago te notificaremos con 
                      otro correo de confirmación. El pedido tardara en llegar a tu domicilio
                      dentro de los primeros 5 dias despues de ser enviado, cualquier duda
                      sobre el proceso de compra envianos un correo a:
                      <a href="mailto: li094106303@rigel.fca.unam.mx">tiendavirtual@plasticossonoros.com</a></p>';

    $success = mail($direc_destino[0], $asunto, $cuerpoHTML, $encabezado); 

    $_SESSION['accion'] = "resultadosCompra";
 
    header("Location: ".$_SERVER['HTTP_REFERER']."");
    exit(); ?>