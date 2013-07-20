<?php 

    $rutafunciones = '../funciones/';
    include $rutafunciones.'consultas.php'; 

    include '../target_links.php';
    
    foreach ($_GET as $nombre => $valor) {
      if(stristr($nombre, 'button') === FALSE) {
        ${$nombre} = $valor;
      } // Cierre de if
    }// Cierre foreach  

    switch ($accion) {
      case 'muestraLista':

        $cols_arr      = array("idPedido",        // 0
                               "nombres",         // 1
                               "aPaterno",        // 2
                               "aMaterno",        // 3
                               "cantProductos",   // 4
                               "montoEnvio",      // 5
                               "subtotal",        // 6
                               "iva",             // 7
                               "total",           // 8
                               "fechaAlta",       // 9  
                               "status");         // 10
        $num_cols      = count($cols_arr);
        $join_tables   = 1;
        $tables_arr    = array("clientes",
                               "pedidos",
                               "pedidostatus");
        $connect       = 1;
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idCliente",
                               "idPedidoStatus",
                               "idPedido");
        $order         = "idPedido";
        $dir           = "DESC";    
        
        switch ($filtro) {

          case 'recientes':
            $where_clause = "pedidos.idPedidoStatus = 1";
            break;

          case 'pagoConfirmado':
            $where_clause = "pedidos.idPedidoStatus = 2";
            break;
          
          case 'enProcesoDeEntrega':
            $where_clause = "pedidos.idPedidoStatus = 3";
            break;

          case 'pedidoEntregado':
            $where_clause = "pedidos.idPedidoStatus = 4";
            break;

          case 'pedidoCancelado':
            $where_clause = "pedidos.idPedidoStatus = 5";  
            break;

          default:
            # code...
            break;
        }
        

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);


        
        $jsondata = array(); 
        $i = 0; 
        while ($datosPedidos = mysql_fetch_assoc($result)) { 
          $jsondata[$i]['idPedido']      = $datosPedidos['idPedido']; 
          $jsondata[$i]['nombres']       = $datosPedidos['nombres']; 
          $jsondata[$i]['aPaterno']      = $datosPedidos['aPaterno']; 
          $jsondata[$i]['aMaterno']      = $datosPedidos['aMaterno']; 
          $jsondata[$i]['cantProductos'] = $datosPedidos['cantProductos']; 
          $jsondata[$i]['montoEnvio']    = $datosPedidos['montoEnvio'];
          $jsondata[$i]['subtotal']      = $datosPedidos['subtotal'];  
          $jsondata[$i]['iva']           = $datosPedidos['iva'];
          $jsondata[$i]['total']         = $datosPedidos['total'];
          $jsondata[$i]['fechaAlta']     = $datosPedidos['fechaAlta']; 
          $jsondata[$i]['status']        = $datosPedidos['status']; 
          $i++; 
        } 

        echo json_encode($jsondata);

        # code...
        break;
      case 'obtenerEstadosPedido':

        $cols_arr      = array("status");
        $num_cols      = count($cols_arr);
        $tables_arr    = array("pedidostatus");

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $jsondata = array(); 
        $i = 0; 
        while ($row = mysql_fetch_row($result)) { 
          $jsondata[$i]['status'] = $row[0]; 
          $i++; 
        } 

        echo json_encode($jsondata);
        break;  

      case 'actualizaEstadoPedido':

        $colsvalarr   = array("idPedidoStatus = '$selEstado'");
        $numcols      = count($colsvalarr); 
        $aff_table    = "pedidos";
        $where_clause = "idPedido = '$idPedido'";

        $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); # code...
    
        include '../variable_test.php';        
        break;  
     }


  
   /*Fuente: http://www.bloogie.es/tecnologia/programacion/34-ajax-con-jquery-php-y-json-ejemplo-paso-a-paso#ixzz1wgXllylW 
Under Creative Commons License: Attribution Share Alike */

?>

