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

      <h2>¿Quienes Somos?</h2>

      <div class="contenedorBordes">
        <h2>Nosotros</h2>
        <p>Somos una empresa dedicada a la venta de discos en formato Vinil, contamos con un amplio surtido de productos
           de una variedad de artistas, géneros  y compañías discográficas, que aún editan grabaciones en este formato, 
           pretendemos llegar a ser la mejor opción en el mercado como negocio en nuestro tipo, nuestro objetivo es para
           satisfacer un mercado expansión en nuestros días, y ofrecer a nuestros clientes la mejor experiencia de compra
           y disfrute mientras adquiere y disfruta de los productos que comercializamos.</p>

        <h2> Historia</h2>
        <p>Establecidos México, en 2012, el proyecto nace de la inquietud de explorar un mercado en la que ninguna empresa
           mexicana se ha especializado, nuestro deseo es consolidarnos como la mejor de clientes en los años por venir</p>

        <h2>Misión</h2>
        <p>Nuestra misión es ofrecer el mejor servicio en la comercialización de música grabada en el formato vinil, dándole
           prioridad a la satisfacción del cliente, mientras adquiere, recibe y usaba nuestros productos, apegándonos a los
           altos estándares de calidad necesarios, para que nuestros clientes reciban la mejor experiencia de compra, tiempos
           de entrega reducidos y el disfruta de por vida de los discos que adquieran en nuestra tienda</p>

        <h2>Visión</h2>
        <p>Creemos que establecer una relación duradera con nuestros clientes, nos permitirá alcanzar nuestros objetivos de
           ser la mejor opción en el mercado de venta de discos en Vinil, buscamos llegar a esos clientes que buscan gran
           calidad y tienen los gustos más exigentes en cuanto al género, variedad de artistas, paquetes y ediciones especiales
           de discos que suelen ser difíciles de encontrar, estamos seguros que apegarnos a estos estándares nos llevará
           establecernos en el gusto de los clientes</p>

        <h2>¿Que ofrecemos?</h2>
        <p>Una tienda virtual fácil de usar, un proceso de compra rápido y eficiente, con tiempos de entrega reducidos y
           la garantía que todo cliente recibirá sus productos en el mejor estado posible, contamos con promociones, preventas, 
           una lista de deseos en caso de que el producto que se busque no este disponible en nuestro inventario, el cliente
           recibirá notificaciones del proceso de compra en todo momento y tendrá la opción de registrarse para recibir
           Nuestro boletín de noticias con novedades, promociones y preventas que tengamos disponibles, en su momento. 
           En compras mayores de $1500 el envio será gratis, pronto contaremos con más servicios y promociones disponibles
           que ofrecer</p>   

        <p>Cualquier duda o comentario acerca de nuestro sitio hasnosla llegar a través de nuestra dirección electrónica: 
           <a href="mailto: li094106303@rigel.fca.unam.mx">tiendavirtual@plasticossonoros.com</a></p>   




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