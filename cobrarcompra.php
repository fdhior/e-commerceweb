<?php
  
    session_start();

    $rutafunciones = $_SERVER['DOCUMENT_ROOT'].'/e-commerceweb/funciones/';
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

    $totalCompra = $importeTotalProductos+importeIVA+$gastosEnvio;



    $colsvalarr   = array("cantProductos = '$cantidadProductosTotal'",
                          "montoEnvio    = '$gastosEnvio'",
                          "subtotal      = '$importeTotalProductos'",
                          "iva           = '$importeIVA'",
                          "total         = '$totalCompra'");
    $numcols      = count($colsvalarr); 
    $aff_table    = "pedidos";
    $where_clause = "idPedido = '$idPedido[0]'";

    $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


?>