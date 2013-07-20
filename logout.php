<?php

session_start(); // inicia/continua session

unset($_SESSION['loggedUser']); // Cierra la sesion del cliente

Header('Location: index.php');
exit;

?>