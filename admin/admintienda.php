<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Plasticos Sonoros-Proyecto E-Commerce - Administracion de Pedidos y Ventas</title>
    <script src="../js/jquery-1.6.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/admintienda.js" type="text/javascript" charset="utf-8"></script>
    <link href="../css/estilossonoros.css" type="text/css" rel="stylesheet" />
    <link href="css/tablasedicion.css"     type="text/css" rel="stylesheet" />
    
    <!-- Start css3menu.com HEAD section -->
    <link rel="stylesheet" href="css/adminnavbar.css" type="text/css" />
    <!-- End css3menu.com HEAD section -->

<?php 
  
 

    /* if (!isset($_SESSION['carritoCanasta'])) {
      $_SESSION['cantidadProductosTotal'] = 0;
    }  

    if(isset($_SESSION['var_return'])) {
      unset($_SESSION['var_return']);
    } */

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

    include '../variable_test.php';
    // unset($_SESSION['carritoCanasta']);

 ?>

  </div>

    <!-- ENCABEZADO -->
    <header id="main-header-admin">
        <div id="logo">
          <img src="../images/logo.png" alt="LOGO">
        </div>
	  </header>
    <!-- FIN DE ENCABEZADO -->

  <!-- DIV contenedor -->
  <div id="contenido">
    

    <!-- BARRA DE NAVEGACION -->   
    <nav id="adminNavBar">

<?php

        include 'adminnavbar.htm';
  
?> 

    </nav> 
    <!-- FIN DE BARRA DE NAVEGACION -->
 
    <!-- SECCION DETALLES PEDIDO -->
    <section id="detallePedidoAdmin">
      <h2>Lista de Pedidos Registrados</h2>
        
      <div class="contenedorBordes">    
     
        <!-- Lista de Pedidos -->
        <h2>Pediddos Hechos a la Tienda</h2>

  <?php $encabezado = ''; 
        $encabezado .= '<div class="colNumero">No.</div>';
        $encabezado .= '<div class="colNombres">Cliente</div>';
        $encabezado .= '<div class="colNumero">Cantidad</div>';
        $encabezado .= '<div class="colMonto">Envio</div>';
        $encabezado .= '<div class="colMonto">Subtotal</div>';
        $encabezado .= '<div class="colMonto">I.v.a.</div>';
        $encabezado .= '<div class="colMonto">Total</div>';
        $encabezado .= '<div class="colFecha">Fecha</div>';
        $encabezado .= '<div class="colTextoCorto">Estado</div>';
        $encabezado .= '<div class="colTextoCorto">Detalles</div>'; ?>
          
        <section id="encabezado">
          <?php echo $encabezado; ?>
        </section>

        <section id="listadoTabla"></section>
        <section class="contenedorSeccion">
          
          <input  id="pedidosRecientes" name="selTipoPedido" type="radio" value="recientes" checked="checked" onclick="javascript: mostrarPedidosRecientes()" />
          <label>Recientes</label>
          <input  id="pedidosConfirmados" name="selTipoPedido" type="radio" value="confimados" onclick="javascript: mostrarPedidosConfirmados()" />
          <label>Pago Confirmado</label>
          <input  id="pedidosEnEntrega" name="selTipoPedido" type="radio" value="enEntrega" onclick="javascript: mostrarPedidosEnEntrega()" />
          <label>En Entrega</label>
          <input  id="pedidosEntregados" name="selTipoPedido" type="radio" value="entregados" onclick="javascript: mostrarPedidosEntregados()" />
          <label>Entregados</label>
          <input  id="pedidosCancelados" name="selTipoPedido" type="radio" value="candelados" onclick="javascript: mostrarPedidosCandelados()" />
          <label>Cancelados</label>


        </section>
    
      </div>
      <!-- Cierre DIV contenedorBordes -->
    
    </section>
    <!-- CIERRE DETALLES PEDIDO -->


   
   <!-- <p><a id="muestraNodos" href="#">Mira Lo Nodo</a></p>
   <p><a id="muestraEstado" href="#">Mira El Estado</a></p>
   <p><a id="cambiaTitulo" href="#">Cambia el Titulo</a></p> -->
  <!-- PIE DE PAGINA -->
 <!-- <footer id="footerPlasticos">
    &copy; 2012 Plasticos Sonoros
  </footer> -->

	</div>
  <!-- Cierre DIV Contenido -->

</body>
</html>