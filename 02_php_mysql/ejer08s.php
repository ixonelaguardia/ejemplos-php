<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer08.php</title>
  </head>
  <body>
    <h1>Editar una entrada del blog</h1>

    <?php
      // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
      date_default_timezone_set('Europe/Madrid');
      $fecha_actual = date("Y-m-d H:i:s");
    ?> 
 
    <?php if( !isset( $_GET['enviar'] ) ) { ?> 

    <?php 
      // Si enviar no está fijado, significa que tenemos que mostrar el 
      // contenido del registro que vamos a editar
    ?>

    <?php 
      // Recoger los valores
      $id=0;
      if( isset( $_GET['id'] ) )
        $id=$_GET['id'];
    ?>    

    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
    
      // Formar la consulta (seleccionando todas las filas)
      $q = "select * from entrada where id=".$id;
      
      // Ejecutar la consulta en la conexión abierta y obtener el "resultset"
      $r = mysql_query($q, $conexion) or die( mysql_error() );

      $fila = mysql_fetch_assoc( $r );

    ?>
        
    <form action="ejer08s.php" method="get">
      <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $fila['titulo']; ?>" />
      </div>
      <div>
        <label for="texto">Texto:</label>
        <textarea id="texto" name="texto" rows="4" cols="40"><?php echo $fila['texto']; ?></textarea>
      </div>
      <div>
        <label for="fecha">Fecha:</label>
        <input type="text" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>" />
      </div>
      <div>
        <label for="activo">Activo:</label>
        <input type="checkbox" id="activo" name="activo"
         <?php 
          if( $fila['activo'] == 1 )
            echo 'checked="checked"'; 
         ?>
         />
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
      </div>
      <div>
        <input type="reset" id="limpiar" name="limpiar" value="Limpiar" />
        <input type="submit" id="enviar" name="enviar" value="Guardar" />
      </div>
    </form>

    <?php 
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
    
    <?php } else { ?>

    <?php 
      // El usuario ha pulsado guardar y escribimos los cambios
    ?>

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
      
      // Este campo no lo recogíamos hasta ahora
      $id=0;
      if( isset( $_GET['id'] ) )
        $id=$_GET['id'];
    ?>
     
    <?php 
      // Abrir la conexión
      $conexion = mysql_connect("localhost", "root", "");
      
      // Elegir la base de datos
      mysql_select_db("blog", $conexion);
    
      // Formar la consulta (actualizar una fila)
            
      $q = "update entrada set titulo = '".$titulo."', texto = '".$texto."', fecha='".$fecha."', activo='".$activo."' where id=".$id; 
      //echo "<p>".$q."</p>";
      //die();
      
      // Ejecutar la consulta en la conexión abierta. No hay "resultset"
      mysql_query($q, $conexion) or die( mysql_error() );

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
        echo '<tr><th>ID</th><th>Título</th><th>Texto</th><th>Fecha</th>';
        echo '<th>Activo</th><th>Acciones</th></tr>';
        
        while( $fila = mysql_fetch_assoc( $r ) )
        {
          echo "<tr>";
          echo "<td>".$fila['id']."</td>";
          echo "<td>".$fila['titulo']."</td>";
          echo "<td>".$fila['texto']."</td>";
          echo "<td>".$fila['fecha']."</td>";
          echo "<td>".$fila['activo']."</td>";

          echo "<td><a href='ejer08.php?id=".$fila['id']."'>Borrar</a>";
          echo "&nbsp;<a href='editar.php?id=".$fila['id']."'>Editar</a>";
          echo "</td>";
          
          echo "</tr>";
        }
        
        echo '</table>';
      }
                  
      // Cerrar la conexión
      mysql_close($conexion);
    ?>
    
    <?php } ?>
  </body>
</html>
