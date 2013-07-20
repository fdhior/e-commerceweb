<?php /** VARIBALE TEST AREA **/

   // echo '<p>Valor de SERVER[DOCUMENT_ROOT]: ' . $_SERVER['DOCUMENT_ROOT'] . '</p>';


    // Mostrar los valores de _POST
    /*echo "<p>Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
      if(stristr($nombre, 'button') === FALSE) {
        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
      }
    }
    echo '</p>';

    echo "<p>Valores de _GET <br />";
    foreach ($_GET as $nombre => $valor) {
      if(stristr($nombre, 'button') === FALSE) {
        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
      }
    }
    echo '</p>';

    echo "<p>Valores de _SESSION <br />";
    foreach ($_SESSION as $nombre => $valor) {
      if(stristr($nombre, 'button') === FALSE) {
        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
      }
    }
    echo '</p>';

    // echo '<p>Valor de target_link: ' . $target_link . '</p>'; 

    // echo '<p>Valor de textoBusqueda: ' . $textoBusqueda . ' </p>';

    echo '<p>Valor de (array) carritoCanasta: ';

    print_r($_SESSION['carritoCanasta']);

    echo '</p>';


    echo '<p>Valor de (array) loggedUser: ';

    print_r($_SESSION['loggedUser']);

    echo '</p>';


    echo '<p>Valor de accion: ' . $accion . '</p>';
    /* echo '<p>Valor de (array) carritoCanasta (Local): ';

    print_r($carritoCanasta);

    echo '</p>'; 

    echo '<p>Valor de (array) var_return: ';

    print_r($_SESSION['var_return']);

    echo '</p>'; */

?>