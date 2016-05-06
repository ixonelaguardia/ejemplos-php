<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer09s2.php</title>
  </head>
  <body>

    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
    ?>

    <?php 
      // Recoger los valores
      $entrada_id=0;
      if( isset( $_GET['entrada_id'] ) )
        $entrada_id=$_GET['entrada_id'];
    ?>    

    <?php if( $entrada_id > 0 ) { ?>

    <?php 
    // Insertar el comentario
      $email="";
      if( isset( $_GET['email'] ) )
        $email=$_GET['email'];

      $texto="";
      if( isset( $_GET['texto'] ) )
        $texto=$_GET['texto'];
    ?>

    <?php
      // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
      date_default_timezone_set('Europe/Madrid');
      $fecha_actual = date("Y-m-d H:i:s");
    ?> 

    <?php 
      $q = "insert into comentario values( 0, '".$email."', '".$texto."', '".$fecha_actual."', 1, '".$entrada_id."' )";
      mysql_query($q, $conexion) or die( mysql_error() );
    ?>
    
    <?php } ?>


 
    <?php 
      // Recoger los valores
      $id=$entrada_id;
      if( isset( $_GET['id'] ) )
        $id=$_GET['id'];
    ?>    

    <?php       
      // Formar la consulta (seleccionando todas las filas)
      $q = "select * from entrada where activo = 1 and id=".$id;
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );

      $fila = mysql_fetch_assoc( $r );

      echo "<div>"; 
      echo "<h1>".$fila['titulo']."</h1>";
      echo '<div class="descr">'.$fila['fecha'].'</div>';       
      echo "<p>".$fila['texto']."</p>";
      echo "</div>";

      echo "<h2>Comentarios:</h2>";
      
      // A partir de aquí mostramos los comentarios, en función de entrada_id
      $q = "select * from comentario where entrada_id=".$id;
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );
      
      // Calcular el número de filas
      $total = mysql_num_rows( $r );  

      if( $total > 0 )
      {        
        while( $fila = mysql_fetch_assoc( $r ) )
        {
          echo "<div>";
          echo "<p>".$fila['fecha']."</p>";
          echo "<h3>".$fila['email']."</h3>";
          echo "<p>".$fila['texto']."</p>";
          echo "</div>";
        }
      }
      
      // Cerrar la conexión
      mysql_close($conexion);
    ?>

    <h2>Añade tu comentario:</h2>    
    <form action="ejer09s2.php" method="get">
      <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="" />
      </div>
      <div>
        <label for="texto">Texto:</label>
        <textarea id="texto" name="texto" rows="4" cols="40"></textarea>
      </div>
        <input type="hidden" id="entrada_id" name="entrada_id" value="<?php echo $id; ?>" />
      <div>
        <input type="reset" id="limpiar" name="limpiar" value="Limpiar" />
        <input type="submit" id="enviar" name="enviar" value="Guardar" />
      </div>
    </form>
    
    <p><a href="ejer09s1.php">Volver al blog</a></p>

  </body>
</html>
