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

<?php       $noProductosCanasta = count($_SESSION['carritoCanasta']);  
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

                
                ${$importeItem.$i} = $_SESSION['carritoCanasta'][$i]['cantidad']*$row[4]; ?>                

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
                  <td class="textoCeldasDetalle"><a href="<?php echo $retorno; ?>?accion=quitarProducto&idDisco=<?php echo $row[0]; ?>"><img src="images/flechadown.gif" /></a>
                                                 &nbsp;<?php echo $_SESSION['carritoCanasta'][$i]['cantidad']; ?>&nbsp;
                                                 <a href="<?php echo $retorno; ?>?accion=agregarProducto&idDisco=<?php echo $row[0]; ?>"><img src="images/flechaup.gif" /></a></td>
                  <td class="textoCeldasDetalle"><?php echo $row[4]; ?></td>
                  <td class="textoCeldasDetalle"><?php echo '$' . ${$importeItem.$i}; ?></td>
                </tr> 
<?php
                $importeTotalProductos = $importeTotalProductos + ${$importeItem.$i};
                // if ($_SESSION['cantidadProductosTotal'] == 0) {
                  // $_SESSION['cantidadProductosTotal'] = $_SESSION['carritoCanasta'][$i]['cantidad'];
                // } else {
                $_SESSION['cantidadProductosTotal'] =  $_SESSION['cantidadProductosTotal'] + $_SESSION['carritoCanasta'][$i]['cantidad']; 
                // }  
            } // Cierre For

?>

                <tr>
                  <td></td>
                  <td><?php if ($_SESSION['carritoCanasta']) { ?>
                    <form id="formaVaciarCarrito" name="formaVaciarCarrito" method="post" action="<?php echo $target_link4; ?>" target="_top">
                          <input type="hidden" name="accion" id="accion" value="vaciarCarrito" />
                          <input name="btnAgregarAlCarrito" type="submit" id="btnAgregarAlCarrito" value="Vaciar Carrito" />
                        </form><?php } ?></td>
                  <td><?php if ($_SESSION['carritoCanasta']) { ?>
                        <?php if ($accion == "finalizarCompra") { ?>                   
                                <form id="formaCobrarCompra" name="formaCobrarCompra" method="post" action="<?php echo $target_link3; ?>" target="_top">
                                   <input type="hidden" name="accion" id="accion" value="revisarDireccion" /> 
                                  <input name="btnProcesarePedido" type="submit" id="btnProcesarPedido" value="Procesar Pedido" />
                                </form>
                        <?php } else { ?>        
                                <form id="formaFinalizarCompra" name="formaFinalizarCompra" method="post" action="<?php echo $target_link3; ?>" target="_top">
                                  <input type="hidden" name="accion" id="accion" value="finalizarCompra" />
                                  <input name="btnFinalizarCompra" type="submit" id="btnFinalizarCompra" value="Finalizar Compra" />
                                </form>
                        <?php } ?>             
                      <?php } ?></td>
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