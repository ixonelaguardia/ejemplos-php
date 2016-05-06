<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejemplo20.php</title>
  </head>
  <body>
    <h1>Insertar una fila en una tabla de MySQL</h1>
    <p>Se conecta a una base de datos llamada "blog" en la máquina "localhost",
    con el usuario "root" y sin contraseña.</p>
    <p>Inserta un nuevo post en la tabla "entrada".</p>
    <p>No hace comprobación de errores.</p>
    
    <h2>Nuevo post</h2>
    
    <?php
      // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
      date_default_timezone_set('Europe/Madrid');
      $fecha_actual = date("Y-m-d H:i:s");
    ?> 
    
    
    <form action="ejemplo20.php" method="get">
      <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="" />
      </div>
      <div>
        <label for="texto">Texto:</label>
        <textarea id="texto" name="texto" rows="4" cols="40"></textarea>
      </div>
      <div>
        <label for="fecha">Fecha:</label>
        <input type="text" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>" />
      </div>
      <div>
        <label for="activo">Activo:</label>
        <input type="checkbox" id="activo" name="activo" checked="checked" />
      </div>
      <div>
        <input type="reset" id="limpiar" name="limpiar" value="Limpiar" />
        <input type="submit" id="enviar" name="enviar" value="Guardar" />
      </div>
    </form>

    <?php if( isset( $_GET['enviar'] ) ) { ?>

    <?php 
      // Recoger los valores
      $titulo="";
      if( isset( $_GET['titulo'] ) )
        $titulo=$_GET['titulo'];

      $texto="";
      if( isset( $_GET['texto'] ) )
        $texto=$_GET['texto'];

      $fecha=$fecha_actual;
      if( isset( $_GET['fecha'] ) && $_GET['fecha'] != "" )
        $fecha=$_GET['fecha'];
      
      $activo=0;
      if( isset( $_GET['activo'] ) )
        $activo=1;  
    ?>
     
    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
    
      // Formar la consulta (insertar una fila)
      
      /*
        $q = "insert into entrada values( 0, '', '', '', '' )";
        Cortar en los puntos en los que queremos introducir variables con ".."
        $q = "insert into entrada values( 0, '".$titulo."', '".$texto."', '".$fecha."', '".$activo."' )";
        echo $q;      
      */
      
      $q = "insert into entrada values ( 0,'".$titulo."','".$texto."','".$fecha."','".$activo."' )";
      
      // Ejecutar la consulta en la conexión abierta. No hay "resultset"
      mysql_query($q, $conexion) or die( mysql_error() );

      // Formar la consulta (seleccionando todas las filas)
      $q = "select * from entrada";
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );
      
      // Calcular el número de filas
      $total = mysql_num_rows( $r );  

      // Mostrar el contenido de las filas
      if( $total > 0 )
      {
        while( $fila = mysql_fetch_assoc( $r ) )
        {
	        echo "<br /><strong>" . $fila['titulo'] . "</strong><br />";
	        echo "Texto: " . $fila['texto'] . "<br />";
	        echo "Fecha: " . $fila['fecha'] . "<br />";
        }
      }
      
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
    
    <?php } ?>
  </body>
</html>
