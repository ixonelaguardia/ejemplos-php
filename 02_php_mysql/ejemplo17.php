<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejemplo17.php</title>
  </head>
  <body>
    <h1>Contar filas en una tabla de MySQL</h1>
    <p>Se conecta a una base de datos llamada "blog" en la máquina "localhost",
    con el usuario "root" y sin contraseña.</p>
    <p>Cuenta las filas de la tabla "entrada".</p>
    <p>No hace comprobación de errores.</p>
     
    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
    
      // Formar la consulta (seleccionando todas las filas)
      $q = "select * from entrada";
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );

      // Calcular el número de filas y mostrarlo
      $total = mysql_num_rows( $r );  
      echo "Total de filas: $total";
      
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
  </body>
</html>
