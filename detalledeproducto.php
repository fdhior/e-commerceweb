<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Plasticos Sonoros-Proyecto E-Commerce</title>
    
    <link href="css/estilossonoros.css" type="text/css" rel="stylesheet" />
    <!-- Start css3menu.com HEAD section -->
    <link rel="stylesheet" href="css/navbar.css" type="text/css" />
    <!-- End css3menu.com HEAD section -->

<?php 

    $rutafunciones = 'funciones/';
    include $rutafunciones.'consultas.php';

    include "target_links.php";

    if ($_GET) {
      $idDisco = $_GET['idDisco'];
    } else {
      $idDisco = $_POST['idDisco'];
    }

    if(isset($_SESSION['var_return'])) {
      unset($_SESSION['var_return']);
    }

?>

</head>
<body>

  <div id="variabletest">
 
 <?php 

    include 'variable_test.php';

 ?>

  </div>


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
 
    <!-- SECCION DETALLE DE PRODUCTO -->
    <section class="contenedorSeccion1">
          <h2>Detalle del Producto</h2>
          
          <!-- DIV CONTENEDOR BORDES -->
          <div class="contenedorBordes"> 
<?php          
        
                $cols_arr     = array("idDisco",              // 0
                                      "caratula",             // 1
                                      "titulo",               // 2
                                      "artista",              // 3
                                      "descripcion",          // 4 
                                      "anioLanzamiento",      // 5
                                      "formato",              // 6
                                      "genero",               // 7
                                      "disquera",             // 8
                                      "duracion",             // 9
                                      "Precio",               // 10  
                                      "resenia",              // 11
                                      "preventa",             // 12
                                      "promocion",            // 13 
                                      "existencia");          // 14
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("artistas", 
                                       "discos",
                                       "formatos",
                                       "generos",
                                       "disqueras");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idArtista", 
                                       "idFormato",
                                       "idGenero",
                                       "idDisquera");
                $connect       = "1";    
                $where_clause  = "idDisco = '$idDisco'";


                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
              
                $row=mysql_fetch_row($result);

                unset($join_tables);
                unset($num_tables);
                unset($on_fields_arr);
                unset($connect);
                

?>
                    
                    <div id="productoDetalle">
                      <div id="caratulaDetalle" >
                        <img src="images/<?php echo $row[1]; ?>.jpg">
                      </div>
                      <div id="listaDetalles">
                        <h3><?php echo $row[2]; 
                        if ($row[12] == 1) { ?> <span class="preventaSpan">&nbsp;PREVENTA&nbsp;</span> <?php } ?>
                  <?php if ($row[13] == 1) { ?> <span class="promocionSpan">&nbsp;PROMOCION&nbsp;</span> <?php } ?></h3>
                        <h4><?php echo $row[3]; ?></h4><br />  
                          <p class="detalleTexto">Descripción: <?php echo $row[4]; ?></p>
                          <p class="detalleTexto">Año de Publicación: <?php echo $row[5]; ?></p>
                          <p class="detalleTexto">Formato: <?php echo $row[6]; ?></p>
                          <p class="detalleTexto">Genero: <?php echo $row[7]; ?></p>
                          <p class="detalleTexto">Disquera: <?php echo $row[8]; ?></p>
                          <p class="detalleTexto">Duracion Total: <?php echo $row[9]; ?></p>
                          <p class="detalleTexto">Existencia:<?php echo $row[14]; ?></p>
                          <p class="detalleTexto">Precio:<span class="boldspan"> $<?php echo $row[10]; ?></span></p>
                  <?php if($row[12] == 0 and $row[14] == 0) { ?>
                        <p>Sin Existencia</p>
                        <form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $target_link20; ?>" target="_top">
                          <input type="hidden" name="idDisco" id="idDisco" value="<?php echo $row[0]; ?>" />
                          <input type="hidden" name="ejecuta" id="ejecuta" value="agregaDiscoDeseo" />
                          <input name="btnVerDetalle" type="submit" id="btnVerDetalle" value="Agregar A Tu Lista de Deseos" />
                        </form> 
                  <?php } else { ?> 
                          <form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $target_link4; ?>" target="_top">
                          <input type="hidden" name="accion" id="accion" value="agregarProducto" />
                          <input type="hidden" name="idDisco" id="idDisco" value="<?php echo $row[0]; ?>" />
                          <input name="btnAgregarAlCarrito" type="submit" id="btnAgregarAlCarrito" value="Agregar a la Compra" />
                        </form> 
                  <?php } ?>       
                      </div>  
                    </div> 
                    <div id="reseniaProducto">
                      <h4>Reseña del Producto</h4><br />
                      <p class="detalleTexto"><?php echo $row[11]; ?></p>
                    </div>     


          </div>
          <!-- CIERRE DIV CONTENEDOR BORDES -->

    </section>    
    <!-- CIERRE SECCION DETALLE DE PRODUCTO -->

    <aside id="asideFunciones">

<?php

      include 'asidefunciones.htm';

?>

    </aside>

    <!-- SECCION LISTA DE CANCIONES -->
    <section class="contenedorSeccion1">

      <h2>Lista de Canciones</h2>
      <div class="contenedorBordes">
        <div id="contenedorLista">
          <table id="tablaCanciones" border="0" cellpadding="0" cellspacing="0">
            <caption><?php echo $row[2]; ?></caption>
              <thead>
                <th>No.</th>
                <th>Titulo</th>  
                <th>Información Adicional</th>
                <th>Duración</th>
              </thead>    
              <tbody>

<?php

                $cols_arr     = array("noCancion",            // 0
                                      "titulo",               // 1
                                      "infoAdicional",        // 2
                                      "duracion");            // 3
                $num_cols      = count($cols_arr);
                // $join_tables   = '1';
                $tables_arr    = array("discoscanciones");
                // $num_tables    = count($tables_arr);
                // $on_fields_arr = array("idArtista", "idFormato", "idGenero", "idDisquera");
                // $connect       = "1";    
                $where_clause = "idDisco = '$idDisco'";
                $order        = "noDisco, noCancion";


                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
              
                $i = 0;
                while($row=mysql_fetch_row($result)) {             

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
                
            </tr>    

<?php
                  $i++;
                }; // Cierre de While
?>
              </tbody>
          </table>
        </div> 
      </div>  
      <!-- CIERRE DIV CONTENEDOR BORDES -->

    </section>
    <!-- CIERRE SECCION LISTA DE CANCIONES -->

  </section>
  <!-- CIERRE SECCION CONTENIDO -->

   
  <!-- PIE DE PAGINA -->
  <footer id="footerPlasticos">
    &copy; 2012 Plasticos Sonoros
  </footer>





</body>
</html>