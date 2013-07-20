<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Plasticos Sonoros-Proyecto E-Commerce</title>
    <link href="css/estilossonoros.css" type="text/css" rel="stylesheet" />

    <!-- Start css3menu.com HEAD section -->
    <link rel="stylesheet" href="css/navbar.css" type="text/css" />
    <!-- End css3menu.com HEAD section -->
    <script src="js/busquedaavanzada.js" type="text/javascript"></script>

<?php
    
    $rutafunciones = 'funciones/';
    include $rutafunciones . 'consultas.php'; 

    include 'target_links.php';

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

    <!-- BARRA DE NAVEGACION -->   
    <nav>

<?php

        include 'navbar.htm';
  
?> 
    </nav>  
    <!-- FIN DE BARRA DE NAVEGACION -->
 
    <!-- SECCION BUSQUEDA AVANZADA -->
    <section class="contenedorSeccion2">

      <h2>Busqueda Avanzada</h2>

      <div class="contenedorBordes">
        <h2>Opciones de Busqueda</h2>
        
          <div class="columnaBusqueda">
            <form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>">
            <label>Por Nombre del Artista:</label>
              <input name="textoBusqueda" type="text" id="textoBusqueda" onchange="javascript: porArtista()" size="10" maxlength="10"/>
              <input name="buscar" type="hidden" id="busca" value="porArtista" />
            </form>
            <form id="form1" name="form1" method="post" action="<?php echo $target_link; ?>">
            <label>Por Titulo del Disco:</label>
              <input name="textoBusqueda" type="text" id="textoBusqueda" onchange="javascript: porTituloDisco()" size="10" maxlength="10"/>
              <input name="buscar" type="hidden" id="busca" value="porTituloDisco" />
            </form>
            <form id="form2" name="form2" method="post" action="<?php echo $target_link; ?>">
            <label>Por Formato del Disco:</label>
            <select name="selFormato" onChange="javascript: porFormato()">
<?php         echo '<option selected="selected" value="">Selecciona Un Formato</option>';   
                    
              // Obtener lista de Formatos
              $cols_arr = array("idFormato", 
                                "formato");
              $num_cols = count($cols_arr);
              $tables_arr = array("formatos");
              $num_tables = count($tables_arr);

              $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              while($row=mysql_fetch_row($result)) {    
                /* if (isset($err_return) and $row[0] == $selEstado) {
                  echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                } else { */
                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';                        
                // }  
              }   // cierre de While ?>
              </select>
              <input name="textoBusqueda" type="hidden" id="textoBusqueda" value="seleccion" />
              <input name="buscar" type="hidden" id="busca" value="porFormato" />
            </form>
            
          </div>
          <div class="columnaBusqueda">
          <form id="form3" name="form3" method="post" action="<?php echo $target_link; ?>">
            <label>Por Disquera Que Edita el Disco:</label>
            <select name="selDisquera" onChange="javascript: porDisquera()">
<?php         echo '<option selected="selected" value="">Selecciona Una Disquera</option>';   
                    
              // Obtener lista de Formatos
              $cols_arr = array("idDisquera", 
                                "disquera");
              $num_cols = count($cols_arr);
              $tables_arr = array("disqueras");
              $num_tables = count($tables_arr);

              $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              while($row=mysql_fetch_row($result)) {    
                /* if (isset($err_return) and $row[0] == $selEstado) {
                  echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                } else { */
                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';                        
                // }  
              }   // cierre de While ?>
              </select>
              <input name="textoBusqueda" type="hidden" id="textoBusqueda" value="seleccion" />
              <input name="buscar" type="hidden" id="buscar" value="porDisquera" />
            </form>

          <form id="form4" name="form4" method="post" action="<?php echo $target_link; ?>">
            <label>Por Genero del Disco:</label>
            <select name="selGenero" onChange="javascript: porGenero()">
<?php         echo '<option selected="selected" value="">Selecciona Un Genero Musical</option>';   
                    
              // Obtener lista de Formatos
              $cols_arr = array("idGenero", 
                                "genero");
              $num_cols = count($cols_arr);
              $tables_arr = array("generos");
              $num_tables = count($tables_arr);

              $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

              while($row=mysql_fetch_row($result)) {    
                /* if (isset($err_return) and $row[0] == $selEstado) {
                  echo '<option value="' . $row[0] . '" selected="selected">' . $row[1] . '</option>';
                } else { */
                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';                        
                // }  
              }   // cierre de While ?>
              </select>
              <input name="textoBusqueda" type="hidden" id="textoBusqueda" value="seleccion" />
              <input name="buscar" type="hidden" id="buscar" value="porGenero" />
            </form>
            <form id="form5" name="form5" method="post" action="<?php echo $target_link; ?>">
              <label>Por Año de Lanzamiento:</label>
              <input name="textoBusqueda" type="text" id="textoBusqueda" onchange="javascript: porAnioLanzamiento()" size="4" maxlength="4"/>
              <input name="buscar" type="hidden" id="buscar" value="porAnioLanzamiento" />
            </form>
      
          </div> 


        </form>  
        <p>Nota: La busqueda se realiza al presionar enter una vez habiendo escrito en los campos de texto o
           al seleccionar una opcion diferente en las listas de selección</p>

      </div>  
    </section>


  </section>
    <!-- Cierre DIV Contenido -->

   
  <!-- PIE DE PAGINA -->
  <footer id="footerPlasticos">
    &copy; 2012 Plasticos Sonoros
  </footer>


</div>
<!-- Cierre DIV wrapper -->

</body>
</html>