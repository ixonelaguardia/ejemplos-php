<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer03.php</title>
  </head>
  <body>
    <h1>Ejercicio 3</h1>
    <p>Partiendo de este formulario, hacer que esta página muestre una lista
    no ordenada con una secuencia como "Elemento 1", "Elemento 2", etc.</p>
    <p>Empezará en 1 y acabará en el número que el usurio nos escriba en el 
    formulario.</p>

    <h2>El formulario</h2>
    <form action="ejer03s.php" method="get">
      <input type="text" id="N" name="N" value="" />
      <input type="submit" id="enviar" name="enviar" value="Enviar" />
    </form>

    <ul>
    <?php 
      $N = $_GET['N'];
      
      for( $i=0; $i<$N ; $i++ )
      {
      	   echo "<li>Elemento $i</li>";
      }
    ?>
    </ul>
  </body>
</html>
