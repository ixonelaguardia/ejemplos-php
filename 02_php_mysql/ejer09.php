<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer09.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 9</h1>
  <p>Partiendo del ejemplo 21, hacer que muestre también los comentarios asociados a cada entrada.</p>
  <p>Cuando se pinche en el título de una entrada, debería mostrarse otra página con el contenido de la misma y todos
    los comentarios asociados.</p>
  <p>Al final de esa página tenemos que dar la opción de introducir un nuevo comentario, pidiendo los datos que sean
    necesarios.</p>

  <?php
  // Abrir la conexión
  $conexion = mysqli_connect("localhost", "root", "root", "blog");
/*
  // Borrado, si es que nos pasan un id
  if (isset($_GET['id'])) {
    // Borramos los comentarios correspondientes a la entrada
    $q = "delete from comentario where entrada_id='" . $_GET['id'] . "'";
    // Ejecutar la consulta en la conexión abierta. No hay "resultset"
    mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Formar la consulta (borrado de una fila)
    $q = "delete from entrada where id='" . $_GET['id'] . "'";

    // Ejecutar la consulta en la conexión abierta. No hay "resultset"
    mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Comprobar si hemos afectado a alguna fila
    echo "<p class='red'>";

    if (mysqli_affected_rows($conexion) > 0)
      echo "Se ha borrado la entrada on ID " . $_GET['id'] . ".";
    else
      echo "No se ha borrado ninguna entrada.";

    echo "</p>";
  }*/

  // Formar la consulta (seleccionando todas las filas)
  $q = "select * from entrada";
/*  $q = "select e.id e.titulo e.texto e.fecha e.activo c.email c.texto c.fecha
        from entrada as e inner JOIN  comentario as c
        where e.id = c.entrada_id";*/

  // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
  $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

  // Calcular el número de filas
  $total = mysqli_num_rows($r);

  // Mostrar el contenido de las filas, creando una tabla XHTML
  if ($total > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th><th>comentario</th><th>Email</th></tr>';

    while ($fila = mysqli_fetch_assoc($r)) {
      echo "<tr>";
      echo "<td>" . $fila['id'] . "</td>";
      echo "<td><a href='ejer09_mostrar.php?id=".$fila['id']."'>".$fila['titulo']."</a></td>";

      echo "<td>" . $fila['texto'] . "</td>";
      echo "<td>" . $fila['fecha'] . "</td>";
      echo "<td>" . $fila['activo'] . "</td>";

      $q1 = "select email, texto from comentario where entrada_id= ".$fila['id'];
      $r1 = mysqli_query($conexion,$q1) or die(mysqli_error($conexion));
      $total1 = mysqli_num_rows($r1);

      if ($total > 0) {
        while ($fila1 = mysqli_fetch_assoc($r1)) {
          echo "<td>" . $fila1['texto'] . "</td>";
          echo "<td>" . $fila1['email'] . "</td>";
          echo "</tr>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
        }
      }
      echo "</tr>";
    }

    echo '</table>';
  }

  // Cerrar la conexión
  mysqli_close($conexion);
  ?>
  <p><a class="blue" href="ejemplo21.php">Recargar la página</a></p>


</body>
</html>
