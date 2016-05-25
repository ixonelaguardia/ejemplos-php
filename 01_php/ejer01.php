<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer01.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 1</h1>
  <p>Recoger dos valores A y B, mostrando un mensaje diciendo cual de ellos es mayor que el otro.</p>
  <p>Habrá que llamarlo así: /ejer01.php?A=7&B=3</p>
  <p>Dará errores a menos que "A" y "B" tengan algún valor.</p>

  <?php
  $a = $_GET['A'];
  $b = $_GET['B'];

  if ($a > $b){
    echo "<p>" . $a . " es mayor que " . $b . "</p>";
  }elseif ($a < $b){
    echo "<p>" . $b . " es mayor que " . $a . "</p>";
  }else{
    echo "<p>Los dos son iguales</p>";
  }
?>


</body>
</html>
