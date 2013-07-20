<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Plasticos Sonoros-Proyecto E-Commerce</title>
    <script src="js/jquery-1.6.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.validationEngine-es.js"  type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    
    <link href="css/estilossonoros.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css" />
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

      <h2>Servicio Al Cliente</h2>

      <div class="contenedorBordes">
        <h2>Bievenido a la sección de soporte al cliente</h2>
          
        <p>Sabemos que puede haber ocasiones en las que aún cuando cuidemos todos los detalles, ustedes como nuestros clientes
           lleguen a tener problemas con el proceso de compra, tanto a la hora de ordenar, o recibir los productos, incluso
           tratamos de prevenir que haya equivocaciones a la hora de registrar los datos que se usan para el cobro, sin embargo
           siempre pueden haber casos en los que a pesar de seguir nuestros tutoriales del proceso de venta se encuentren en con
           un problema técnico, el cual impida que se lleve a cabo la compra, o tal vez desea presentar una reclamación o devolución
           del producto, para tales casos y situaciones que se presentan de improviso, ponemos a su disposición el siguiente medio
           de contacto, ingrese sus datos y detalle lo más que pueda el problema que tiene en nuestra tienda y a la brevedad lo
           contactaremos, contamos con personal especializado que atenderá su caso en las proximas horas y de creerlo pertinente 
           intentará contactarlo por varios medios hasta que se haya resulto su problema.</p>

        <p>No dude en contactanos por este medio tambien se tiene algún commentario o requiere alguna otra informacion relacionada
           con nuestros productos, sugerencia para el mejoramiento de nuestros servicios y cualquier otro asunto relacionado con 
           nuestro negocio, en Plasticos Sonoros usted cuenta con nosotros.</p>

  <script>
    jQuery(document).ready(function(){
      // binds form submission and fields to the validation engine
      jQuery("#envFormulario").validationEngine();
    });

  </script>

      <div id="contenedorFormularioContacto">
        <form id="envFormulario" class="style1" method="POST" action="<?php echo $target_link21; ?>">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><label for="nombre" class="ws8">Nombre</label>
            <input type="text" name="nombrermt" id="nombrermt" class="validate[required,custom[onlyLetterSp]] text-input"><br>
            <label for="correoe">Correo Electronico</label>
            <input type="text" name="correoe" id="correoe" class="validate[required,custom[email]] text-input"><br>
            <label for="asunto" class="ws8">Asunto</label>
            <input name="asunto" type="text" id="asunto" size="30" maxlength="40" class="validate[required] text-input"><br>
            <label for="mensaje"><span class="ws8">Descripción del problema<br></label>
            <textarea name="mensaje" id="mensaje" cols="45" rows="5" class="validate[required] text-input"></textarea>
            <br /><br>
            <input type="submit" name="enviar" id="enviar" value="Enviar" onClick="enviaDatos(document.forms.envFormulario, datos)">
           <br>
            &nbsp;</td>
          </tr>
          </table>
        </form> 
    </div>

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