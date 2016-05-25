<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer04.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 4</h1>
  <p>Partiendo de este formulario, hacer que esta página muestre la tabla de multiplicar (de 1 a 10) del número que el
    usuario escriba en el formulario.</p>
  <p>El resultado tiene que ser obligatoriamente una tabla HTML.</p>

  <h2>El formulario</h2>
  <form action="ejer04.php" method="get">
    <input type="text" id="N" name="N" value=""/>
    <input type="submit" id="enviar" name="enviar" value="Enviar"/>
  </form>
  <?php
  $n = $_GET['N'];
  if (!empty($n)){
    echo "<p>Tabla de multiplicar del " .$n . ".</p>";
    echo '<table border="1">';
    echo '<tr><th>'.$n.' x</th><th>=</th></tr>';
    for ($i=1; $i<=10; $i++){
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $i * $n . "</td>";
        echo "</tr>";
    }
  }
  ?>
</body>
</html>
