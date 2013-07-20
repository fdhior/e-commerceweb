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

      <h2>Soporte Al Cliente</h2>

      <div class="contenedorBordes">
        <h2>Ayuda en el proceso de compra</h2>
        
        <p>El proceso de compra en nuestra tienda es bastante facil y rapido, basta con hacer una 
           busqueda en el campo que aparece en la barra de titulo o realizar una busqueda avanzada 
           para obtener un listado de productos, al dar clic en detalles se mostrara una pantalla con
           del detalle del producto que hayamos elegido, y la opcion para agregarlo al carrito de
           compras</p>

        <p>Una vez que el producto está en la canasta se puede ya sea modificar la cantidad de 
           productos que hayamos elegido, vaciar el carrito de compras, o finalizar la compra, con 
           lo que se da paso a el proceso de compra propiamente dicho</p>

        <p>Primero se debe iniciar sesión en la tienda para lo que se necesita tener un usuario y 
           con usuario y contraseña validos, en caso de no tenerla el sistema te da la opcion de 
           registrarte, una vez registrado correctamente, se utilizan esas credenciales para 
           iniciar tu sesión automaticamente, a partir de ese momento ya puedes iniciar el
           proceso de tu pedido.</p>  

        <p>Al dar clic en Procesar Pedido, el sistema te pedirá que confirmes que los datos que 
           posee son los correctos para realizar la compra, te muestra varias opciones que puedes 
           elegir a la hora de verificarlos, como editar los datos de facturación existentes o 
           ayudarte a cambiar el medio de pago que hayas elegido (puedes elegir entre pagar con 
           tarjeta de credito, debito o usar una cuenta PayPal</p>

        <p>Verificados los datos, terminas la compra cofirmando que todos los datos estén correctos,
           aún en este paso cuentas con la opcion de regresar a editar algun dato que necesites cambiar,
           cuando estes completamente seguro de tus elecciones, procede a enviar el pedido, al confirmarse
           este te llegará un correo electronico a la cuenta que hayas dado de alta con los detalles 
           del pedido, el tiempo estimado de entrega y otros detalles.</p>

        <p>Sin embargo el proceso no acaba ahi, te notificaremos el estado de tu pedido a medida que
           vaya evolucionando, cuando hayamos confirmado el pago, se encuentre en proceso de entrega
           y cuando se nos notifique que has recibido el producto, gracias por comprar con nosotros.</p>             

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