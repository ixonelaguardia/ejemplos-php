<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Curso de PHP | mayo de 2010 | ejer01.php</title>
  </head>
  <body>
    <h1>Ejercicio 1</h1>
    <p>Recoger dos valores A y B, mostrando un mensaje diciendo cual de ellos
     es mayor que el otro.</p>
    <p>Habrá que llamarlo así: /ejer01.php?A=7&B=3</p>
    <p>Dará errores a menos que "A" y "B" tengan algún valor.</p>

    <p>
    <?php 

      // Mejor
      $A=0;
      if( isset( $_GET['A'] ) )
      {
        $A = $_GET['A'];
      }
      
      // Peor
      $B = $_GET['B'];
      
      if( $A > $B )
      {
        echo "$A es mayor que $B";
      }
      else
        if( $A < $B )
          echo "$A es menor que $B";
        else
          echo "$A y $B son iguales";
    ?>
    </p>
  </body>
</html>
