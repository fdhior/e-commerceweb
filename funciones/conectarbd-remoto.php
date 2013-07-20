<?php

$dbhost="localhost:3306";  // host del MySQL (generalmente localhost)
$dbusuario="li094106303"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword="inselectav2076"; // password de acceso para el usuario de la
                      // linea anterior
$db="li094106303";        // Seleccionamos la base con la cual trabajar
$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
@mysql_select_db($db, $conexion) or die("No se puede conectar a la base de datos");

?>
