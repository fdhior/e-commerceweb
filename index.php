<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Plasticos Sonoros-Proyecto E-Commerce</title>
    
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>
    <script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script> 
    <script type="text/javascript" src="js/coda-slider.1.1.1.pack.js"></script>
    <script type="text/javascript" src="js/newproductslider.js"></script> 
    <!-- <script type="text/javascript" src="js/prototype1.6.js"></script> 
    <script type="text/javascript" src="js/scriptaculous.js"></script> 
    <script type="text/javascript" src="js/AjaxLib.js"></script> 
    <script type="text/javascript" src="index.js"></script> -->
    
    <link href="css/estilossonoros.css" type="text/css" rel="stylesheet" />
    <link href="css/sliderstyle.css"    type="text/css" rel="stylesheet" />
    
    <!-- Start css3menu.com HEAD section -->
    <link rel="stylesheet" href="css/navbar.css" type="text/css" />
    <!-- End css3menu.com HEAD section -->

<?php 
  
    $rutafunciones = 'funciones/';
    include $rutafunciones.'consultas.php'; 

    include 'target_links.php';
  

    if (!isset($_SESSION['carritoCanasta'])) {
      $_SESSION['cantidadProductosTotal'] = 0;
    }  

    if(isset($_SESSION['var_return'])) {
      unset($_SESSION['var_return']);
    }

    if(isset($_SESSION['ejecutaDeseo'])) {
      unset($_SESSION['ejecutaDeseo']);
    }

    // unset($_SESSION['loggedUser']);

    /* if (!isset($_SESSION['carritoCanasta'])) {
    
      $_SESSION['carritoCanasta'][] = array("id" => "1", "cantidad" => "2"); 
      $_SESSION['carritoCanasta'][] = array("id" => "2", "cantidad" => "1");
    } */




?>

</head>
<body>

  <div id="variabletest">
 
 <?php 

    include 'variable_test.php';
    // unset($_SESSION['carritoCanasta']);

 ?>

  </div>

  
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

   

<!-- DIV wrapper (envuelve y centra el contenido) -->
<!-- <div id="wrapper"> -->
  
  <!-- SECCION contenido -->
  <section id="contenido">


    <!-- BARRA DE NAVEGACION -->   
    <nav>

<?php

        include 'navbar.htm';
  
?> 
    </nav>  
    <!-- FIN DE BARRA DE NAVEGACION -->
 
    <section id="contenedorSeccionAside">

    <!-- SECCION NOVEDADES -->
    <section class="contenedorSeccion1">
          <h2>Nuevos Productos</h2>
          
          <!-- <div id="cargando"><img src="images/ajax-loader.gif"></div> --> 
          
      <div class="contenedorBordes">    
      
          <!-- DIV page-wrap -->
          <div id="page-wrap">
  
            <!-- SLIDER slider-wrap -->                     
            <div class="slider-wrap">
              
              <!-- DIV main-photo-slider -->
              <div id="main-photo-slider" class="csw">
                
                <!-- DIV Panel Container -->
                <div id="panelContainer" class="panelContainer">

<?php

                $cols_arr     = array("caratula",           // 0
                                      "titulo",             // 1
                                      "artista",            // 2
                                      "descripcion",        // 3
                                      "idDisco");           // 4
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("discos", 
                                       "artistas");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idArtista");
                $order         = "discos.idDisco";
                $limit         = "6";   
                $dir           = "DESC";
                $where_clause  = "idDiscoStatus = 1 AND  promocion = 0";

                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                $discosArray = array();                  
                
                $i = 0;
                while($row=mysql_fetch_row($result)) {
                  $discosArray[] = $row[0]; 

?>


                  <div class="panel" title="Panel <?php echo $i+1 ?>">
                    <div class="wrapper">
                      <img src="images/<?php echo $row[0]; ?>.jpg" alt="temp" />
                      <div class="photo-meta-data">
                        <a href="<?php echo $target_link2; ?>?idDisco=<?php echo $row[4]; ?>">"<?php echo $row[1]; ?></a> de <?php echo $row[2]; ?><br />
                        <span class="boldspan"><?php echo $row[3]; ?></span>
                      </div>
                    </div>
                  </div>  
<?php

                $i++;
              } // Cierre de While 

?>


                </div> 
                <!-- Cierre DIV Panel Container -->  
              
              </div>
              <!-- Cierre DIV main-photo-slider -->

              <a href="#1" class="cross-link active-thumb"><img src="images/<?php echo $discosArray[0]; ?>.jpg" class="nav-thumb" alt="temp-thumb" /></a>
              <div id="movers-row">
                <div><a href="#2" class="cross-link"><img src="images/<?php echo $discosArray[1]; ?>.jpg" class="nav-thumb" alt="temp-thumb" /></a></div>
                <div><a href="#3" class="cross-link"><img src="images/<?php echo $discosArray[2]; ?>.jpg" class="nav-thumb" alt="temp-thumb" /></a></div>
                <div><a href="#4" class="cross-link"><img src="images/<?php echo $discosArray[3]; ?>.jpg" class="nav-thumb" alt="temp-thumb" /></a></div>
                <div><a href="#5" class="cross-link"><img src="images/<?php echo $discosArray[4]; ?>.jpg" class="nav-thumb" alt="temp-thumb" /></a></div>
                <div><a href="#6" class="cross-link"><img src="images/<?php echo $discosArray[5]; ?>.jpg" class="nav-thumb" alt="temp-thumb" /></a></div>
              </div>

            </div>
            <!-- Cierre DIV slider-wrap -->
          
          </div>      
          <!-- Cierre DIV page-wrap -->
        
        </div>
        <!-- Cierre DIV contenedorBordes -->
    
    </section>
    <!-- CIERRE SECCION NOVEDADES -->

    <aside id="asideFunciones">
      
<?php

      include 'asidefunciones.htm';

?>

    </aside>
  </section>

    <!-- DIV PROMOCIONES -->
    <section class="contenedorSeccion1">

        <h2>Promociones del mes</h2>

        <div class="contenedorBordes">   
<?php

                $cols_arr     = array("caratula",              // 0
                                      "titulo",                // 1
                                      "artista",               // 2
                                      "formatos.formato",      // 3 
                                      "precio",                // 4 
                                      "idDisco");              // 5  
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
                $where_clause  = "promocion = 1";


                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
               
                $i = 0;
                while($row=mysql_fetch_row($result)) {
                  // $discosArray[] = $row[0]; 

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
                    <div class="centrarBotones"> 
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
  

?>

        </div>
        <!-- Cierre de DIV contenedorBordes -->
    </section>    
    <!-- CIERRE SECCION PROMOCIONES -->





  </section>
  <!-- Cierre SECCCION Contenido -->

<!-- </div> -->
<!-- Cierre DIV wrapper -->
   
  <!-- PIE DE PAGINA -->
  <footer id="footerPlasticos">
    &copy; 2012 Plasticos Sonoros
  </footer>


</body>
</html>