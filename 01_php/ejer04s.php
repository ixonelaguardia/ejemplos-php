<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer04.php</title>
  </head>
  <body>
    <h1>Ejercicio 4</h1>
    <p>Partiendo de este formulario, hacer que esta página muestre la tabla de
    multiplicar (de 1 a 10) del número que el usuario escriba en el formulario.</p>
    <p>El resultado tiene que ser obligatoriamente una tabla XHTML.</p>

    <h2>El formulario</h2>
    <form action="ejer04s.php" method="get">
      <input type="text" id="N" name="N" value="" />
      <input type="submit" id="enviar" name="enviar" value="Enviar" />
    </form>

    <table border="1">
    <?php 
    	  $N = $_GET['N'];
      
      for( $i=1; $i<=10 ; $i++ )
      {
      	   $r = $N*$i;
         echo "<tr><td>$N</td><td>$i</td><td>$r</td></tr>";
      }
    ?>
    </table>
  </body>
</html>
