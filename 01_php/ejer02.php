<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer02.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 2</h1>

  <form action="ejer02.php" method="get">
    <div>
      <label for="A">Valor A:</label>
      <textarea id="a" name="A"></textarea>
    </div>
    <div>
      <label for="B">Valor B:</label>
      <textarea id="b" name="B"></textarea>
    </div>
    <div>
      <input type="submit" id="comparar" name="comparar" value="Comparar"/>
    </div>
  </form>

  <?php
/**  if (isset($_GET['comparar'])){
    if (isset($_GET['A'])){
      $a = $_GET['A'];
      if  (isset($_GET['B'])) {
        $b = $_GET['B'];
        if ($a > $b){
          echo "<p>" . $a . " es mayor que " . $b . "</p>";
        }elseif ($a < $b){
          echo "<p>" . $b . " es mayor que " . $a . "</p>";
        }else{
          echo "<p>Los dos son iguales</p>";
        }
      }else{
        echo "<p>B debe tener valor</p>";
      }
    } else{
      echo "<p>A debe tener valor</p>";
    }
  }*/
  if (isset($_GET['comparar'])){

    $a = $_GET['A'];
      $b = $_GET['B'];
   if (empty($a) or empty($b) ){
     echo "<p>A y B deben tener valor</p>";
   }else{
     if ($a > $b){
       echo "<p>" . $a . " es mayor que " . $b . "</p>";
     }elseif ($a < $b){
       echo "<p>" . $b . " es mayor que " . $a . "</p>";
     }else{
       echo "<p>Los dos son iguales</p>";
     }
   }
  }
  ?>
</body>
</html>
