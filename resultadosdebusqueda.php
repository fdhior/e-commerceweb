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

    foreach ($_POST as $nombre => $valor) {
      if(stristr($nombre, 'button') === FALSE) {
        ${$nombre} = $valor;
      } // Cierre de if
    }// Cierre foreach  

    if(isset($_SESSION['var_return'])) {
      unset($_SESSION['var_return']);
    }
    
    if(isset($_SESSION['ejecutaDeseo'])) {
      unset($_SESSION['ejecutaDeseo']);
    }

?>

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
 
    <!-- SECCION RESULTADOS DE BUSQUEDA -->
    <section class="contenedorSeccion2">
          <h2>Resultados de la busqueda</h2>
          
          <!-- DIV CONTENEDOR BORDES -->
          <div class="contenedorBordes"> 

<?php

        if ($_POST['textoBusqueda'] == "") {

?>          
        
        <p class="sinEntradaPalabra">No has ingresado texto para realizar la busqueda</p>    
         
<?php          
        
        } else {


                $cols_arr     = array("caratula",             // 0
                                      "titulo",               // 1
                                      "artista",              // 2
                                      "formatos.formato",     // 3 
                                      "precio",               // 4
                                      "idDisco",              // 5
                                      "preventa",             // 6
                                      "existencia");          // 7
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("artistas", 
                                       "discos",
                                       "formatos");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idArtista", 
                                       "idFormato");
                $connect       = "1";    
                $order         = "discos.idDisco";
                $limit         = "8";   
                $dir           = "DESC";

                switch ($buscar) {
                    case 'porArtista':
                      $where_clause  = "artista LIKE '%$textoBusqueda%'";
                      break;
                    case 'porTituloDisco':
                      $where_clause = "titulo LIKE '%$textoBusqueda%'";
                      break;
                    case 'porFormato':
                      $where_clause = "discos.idFormato = '$selFormato'";
                      break; 
                    case 'porDisquera':
                      $where_clause = "discos.idDisquera = '$selDisquera'";
                        break;  
                    case 'porGenero':
                        $where_clause = "discos.idGenero = '$selGenero'";
                        break;   
                    case 'porAnioLanzamiento':
                        $where_clause = "anioLanzamiento = '$textoBusqueda'";
                        break;
                    default:
                      $where_clause  = "titulo LIKE '%$textoBusqueda%' OR artista LIKE '%$textoBusqueda%'";
                      break;
                  }  


                


                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
               
                if (mysql_num_rows($result) > 0) {  
                  if ($textoBusqueda == 'seleccion') { ?>
                    <p>Resultados de la busqueda</p>            
          <?php } else { ?>
                    <p class="resultados">Resultados de la busqueda con la palabra <span class="boldspan"><?php echo $textoBusqueda; ?></span></p>
          <?php }

                  $i = 0;
                  while($row=mysql_fetch_row($result)) {

?>
                    <div class="vistaProductos">
                      <div class="caratula">
                        <img src="images/<?php echo $row[0]; ?>.jpg">
                      </div>
                      <div class="detallepromo">
                        <p><span class="boldspan">Titulo:</span> <?php echo $row[1]; ?></p>  
                        <p><span class="boldspan">Artista:</span> <?php echo $row[2]; ?></p>
                        <p><span class="boldspan">Formato:</span> <?php echo $row[3]; ?></p>
                        <p><span class="boldspan">Precio:</span> $<?php echo $row[4]; ?></p>
                        <?php if ($row[6] == 1) { ?><p><span class="preventaSpan">&nbsp;PREVENTA&nbsp;</span></p><?php } ?>  
                      <div class="centrarBotones"> 
                <?php if($row[7] == 0 and $row[6] == 0) { ?>
                        <p>Sin Existencia</p>
                        <form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $target_link20; ?>" target="_top">
                          <input type="hidden" name="idDisco" id="idDisco" value="<?php echo $row[5]; ?>" />
                          <input type="hidden" name="ejecuta" id="ejecuta" value="agregaDiscoDeseo" />
                          <input name="btnVerDetalle" type="submit" id="btnVerDetalle" value="Agregar A Tu Lista de Deseos" />
                        </form> 
                <?php } ?>         
                        <form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $target_link2; ?>" target="_top">
                          <input type="hidden" name="idDisco" id="idDisco" value="<?php echo $row[5]; ?>" />
                          <input name="btnVerDetalle" type="submit" id="btnVerDetalle" value="Ver Detalle" />
                        </form>  
                      </div>  
                      </div> 
                    </div>
<?php
                  $i++;
                } // Cierre de While  
              
              } else {
                if ($textoBusqueda == 'seleccion') { ?>
                  <p>No se encontraron resultados con el criterio de busqueda seleccionado</p>            
          <?php } else { ?>
                  <p class="resultados">No hay resultados de la busqueda con la palabra <span class="boldspan"><?php echo $textoBusqueda; ?></span></p>            
          <?php }
                
            } // Cierre de Else 
        } // Cierre de Else  

?>
        </div>
        <!-- CIERRE CONTENEDOR BORDES -->  

    </section>    
    <!-- CIERRE SECCION RESULTADOS DE BUSQUEDA -->

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