<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer07.php</title>
    <link rel="stylesheet" type="text/css" media="screen" href="ejer06.css" />
  </head>
  <body>
    <h1>Ejercicio 7</h1>
    <p>Modificar el ejemplo 19 para que muestre sólo aquellas entradas que esten activas.</p>
    <p>Además, queremos se se muestren ordenadas por fecha, apareciendo primero las más nuevas.</p>
    <p>Como bonus, se plantea que sólo se muestren las 10 últimas entradas.</p>

    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
    
      // Formar la consulta (seleccionando todas las filas)
      $q = "select * from entrada where activo='1' order by fecha desc";
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );

      // Calcular el número de filas
      $total = mysql_num_rows( $r );  

      // Mostrar el contenido de las filas, creando una tabla XHTML
      if( $total > 0 )
      {
        echo '<table border="1">';
        echo '<tr><th>#</th><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th></tr>';

        $i=0;
        // Los dos while son válidos, la precedencia de "and" es mayor que 
        // la de &&
        // while( ($fila = mysql_fetch_assoc( $r )) && $i<10 )
        while( $fila = mysql_fetch_assoc( $r ) and $i<10 )
        {
          echo "<tr>";
          echo "<td>".$i."</td>";
          echo "<td>".$fila['titulo']."</td>";
          echo "<td>".$fila['texto']."</td>";
          echo "<td>".$fila['fecha']."</td>";
          echo "<td>".$fila['activo']."</td>";
          echo "</tr>";
          
          $i++;
        }
        
        echo '</table>';
      }
      
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
  </body>
</html>
