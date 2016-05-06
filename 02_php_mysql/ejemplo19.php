<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejemplo19.php</title>
  </head>
  <body>
    <h1>Mostrar todas las filas de una tabla de MySQL</h1>
    <p>Se conecta a una base de datos llamada "blog" en la máquina "localhost",
    con el usuario "root" y sin contraseña.</p>
    <p>Muestra las filas de la tabla "entrada".</p>
    <p>El resultado se muestra también en forma de tabla XHTML.</p>
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

      // Calcular el número de filas
      $total = mysql_num_rows( $r );  

      // Mostrar el contenido de las filas, creando una tabla XHTML
      if( $total > 0 )
      {
        echo '<table border="1">';
        echo '<tr><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th></tr>';
        
        while( $fila = mysql_fetch_assoc( $r ) )
        {
	        echo "<tr>";
	        echo "<td>".$fila['titulo']."</td>";
	        echo "<td>".$fila['texto']."</td>";
	        echo "<td>".$fila['fecha']."</td>";
          echo "<td>".$fila['activo']."</td>";
	        echo "</tr>";
        }
        
        echo '</table>';
      }
      
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
  </body>
</html>
