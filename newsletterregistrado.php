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
    
    include 'target_links.php';

    $correoeRegistrado = $_SESSION['correoeRegistrado'];
    unset($_SESSION['correoeRegistrado']);

?>

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

      <h2>Registro Exitoso</h2>

      <div class="contenedorBordes">
        
        <h2>Has sido agregado a nuestra lista</h2>

        <p>Tu dirección de correo electrónico <span class="boldspan"><?php echo $correoeRegistrado; ?></span> quedó registrada en nuestra base de datos
           recibirás nuestro boletin de noticias mesual, con novedades, promociones y más, mantente pendiente, gracias por registrate</p>

       </div>

    </section>
    <!-- CIERRE SECCION TEXTO NOSOTROS -->

	</section>
  <!-- CIERRE SECCION CONTENIDO -->
   
  <!-- PIE DE PAGINA -->
  <footer id="footerPlasticos">
    &copy; 2012 Plasticos Sonoros
  </footer>




</body>
</html>