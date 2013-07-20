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

    include 'target_links.php';

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

  <!-- SECCION CONTENIDO -->
  <section id="contenido">
 		 
    <!-- BARRA DE VAVEGACION -->   
    <nav>

<?php

        include 'navbar.htm';
  
?>     

    </nav> 
    <!-- FIN DE BARRA DE NAVEGACION -->
 
    <!-- SECCION DETALLE DE CARRITO -->
    <section id="detalleCarrito">
          <h2>Detalle de la Canasta del Carrito de Compra</h2>
          
          <!-- DIV CONTENEDOR BORDES -->
        <div class="contenedorBordes"> 


<?php   // Funcionalidad del Carrito
        
        if(isset($_SESSION['carritoCanasta'])) {
          $noProductosCanasta = count($_SESSION['carritoCanasta']);  
        }  

        switch ($accion) {
          
          case 'vaciarCarrito':
              unset($_SESSION['carritoCanasta']);
              $_SESSION['cantidadProductosTotal'] = 0;    
              break;
          
          case 'agregarProducto':
              if (!isset($_SESSION['carritoCanasta'])) {
                $_SESSION['carritoCanasta'][] = array("id" => "$idDisco", "cantidad" => "1");
              } else {
                for ($i=0; $i < $noProductosCanasta; $i++) { 
                  if ($_SESSION['carritoCanasta'][$i]['id'] == $idDisco) {
                    $_SESSION['carritoCanasta'][$i]['cantidad'] = $_SESSION['carritoCanasta'][$i]['cantidad']+1;
                    $productoSumado = true;
                  } // Cierre de If
                } // Cierre de For
                if (!isset($productoSumado)) {
                  $_SESSION['carritoCanasta'][] = array("id" => "$idDisco", "cantidad" => "1");
                } // Cierre de If  
              } // Cierre de Else
              echo "agregado";
              break;

          case 'quitarProducto':
                for ($i=0; $i < $noProductosCanasta; $i++) { 
                if ($idDisco == $_SESSION['carritoCanasta'][$i]['id']) {
                  if ($_SESSION['carritoCanasta'][$i]['cantidad'] == 1) {
                    foreach ($_SESSION['carritoCanasta'] as $itKey => $itVal) { 
                      if ($itKey <> $i) {
                        $tempArray[] = $itVal;
                      }         
                    }
                    if (count($_SESSION['carritoCanasta']) == 0) {
                      unset($_SESSION['carritoCanasta']);
                    } else {  
                      $_SESSION['carritoCanasta'] = $tempArray;       
                    }  
                  } else {
                    $_SESSION['carritoCanasta'][$i]['cantidad'] = $_SESSION['carritoCanasta'][$i]['cantidad']-1;
                  }                   
                }          
              }
              break;

        }

        $noProductosCanasta = count($_SESSION['carritoCanasta']);
        $_SESSION['cantidadProductosTotal'] = 0;

        if(isset($_SESSION['carritoCanasta'])) {  
          for ($i=0; $i < $noProductosCanasta; $i++) {
            $_SESSION['cantidadProductosTotal'] =  $_SESSION['cantidadProductosTotal'] + $_SESSION['carritoCanasta'][$i]['cantidad'];
          } 
        } 

        if (isset($_SESSION['cantidadProductosTotal']) and $_SESSION['cantidadProductosTotal'] == 0) { ?>

          <h2>Carrito de Compras Vacío</h2>
          <p>La canasta del carrito de compras esta vacía, agrega al menos un producto para ver el detalle</p>  
  
  <?php } else { ?>
          
          <h2>Detalle del Carrito de Compras</h2>
          <p>Enseguida aparece el detalle de producto que has agregado a la canasta del carrito de compras, puedes
             realizar cambios en las cantidades o eliminar productos si lo deseas</p>

<?php          include "canastacarrito.php";
       } //Cierre de If ?>

        </div>
       <!-- CIERRE DIV CONTENEDOR BORDES -->

    </section>    
    <!-- CIERRE SECCION DETALLE DE CARRITO -->

  </section>
  <!-- CIERRE DE SECCION CONTENIDO -->

   
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