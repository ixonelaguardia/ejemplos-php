<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer09s1.php</title>
  </head>
  <body>
    <h1>Mi blog</h1>     
    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
      
      // Formar la consulta (seleccionando todas las filas)
      $q = "select * from entrada where activo = 1";
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );

      // Calcular el número de filas
      $total = mysql_num_rows( $r );  

      // Mostrar el contenido de las filas, creando una tabla XHTML
      if( $total > 0 )
      {      	        
        while( $fila = mysql_fetch_assoc( $r ) )
        {
        	  echo "<div>"; 
          echo "<p>".$fila['fecha']."</p>";
          echo "<a href='ejer09s2.php?id=".$fila['id']."'><h2>".$fila['titulo']."</h2></a>";
          echo "<p>".$fila['texto']."</p>";
          echo "</div>";
        }
      }
            
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
  </body>
</html>
