<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer05.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 5</h1>
  <p>Partiendo de este formulario, hacer que esta página muestre la tabla de multiplicar del número que el usuario
    escriba en el formulario.</p>
  <p>Hemos modificado el formulario para que también nos escriban el rango de números por los que vamos a multiplicar
    (no sólo de 1 a 10).</p>
  <p>El resultado tiene que ser obligatoriamente una tabla HTML.</p>

  <h2>El formulario</h2>
  <form action="ejer05.php" method="get">
    <label for="N">Numero:</label>
    <input type="text" id="N" name="N" value=""/>
    <label for="I">Límite inferior:</label>
    <input type="text" id="I" name="I" value=""/>
    <label for="F">Límite superior:</label>
    <input type="text" id="F" name="F" value=""/>
    <input type="submit" id="enviar" name="enviar" value="Enviar"/>
  </form>
</body>
<?php
  if (isset($_GET['enviar'])){
    $n = $_GET['N'];
    $i = $_GET['I'];
    if (empty($i)){
        $i = 1;
      echo $i;
    }
    $f = $_GET['F'];
    if (empty($f)) {
      $f = 10;
      echo $f;
    }
    if ($f < $i){
      $aux = $i;
      $i = $f;
      $f = $aux;
    }

    if (!empty($n)){
      echo "<p>Tabla de multiplicar del " .$n . ".</p>";
      echo '<table border="1">';
      echo '<tr><th>'.$n.' x</th><th>=</th></tr>';
      for ($x=$i; $x<=$f; $x++){
        echo "<tr>";
        echo "<td>" . $x . "</td>";
        echo "<td>" . $x * $n . "</td>";
        echo "</tr>";
      }
    }
  }
?>
</html>
