<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Curso de PHP | mayo de 2016 | ejer08.php</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/colors.css">
    <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
<h1>Ejercicio 8</h1>

<p>Modificar el ejemplo 21 para que además de borrar, nos permita modifica una entrada ya existente.</p>

<p>Como pista, pensad que en el ejemplo 20 ya teneis el formulario y la inserción de datos, tendreis que modificarlo
    para que haga una UPDATE de SQL en vez de una INSERT.</p>
</body>
<?php
    // Abrir la conexión
    $conexion = mysqli_connect("localhost", "root", "root", "blog");


    // BORRADO, si es que nos pasan un id
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
    }
/**  Cuando del formulario de del la página ejer08_editar le dan a modificar, vuelve a está página
     y en la url tendremos todos los datos
    ejer08.php?titulo=Segundo+post&texto=aaa&fecha=2016-05-20+20%3A15%3A19&activo=on&enviar=Modificar*/

    // Update si enivar=modificar
  /**  if (isset($_GET['enviar'])){

            // comprobamos el campo checkbox
            $activo = 0;
            if (isset($_GET['activo'])) {
                $activo = 1;
            }

            $q_update = "update entrada set titulo='" . $_GET['titulo'] .
                "', texto='" . $_GET['texto'] .
                "', fecha='" . $_GET['fecha'] .
                "', activo= '" . $activo . "' where id=" . $id;

            // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
            $r_update = mysqli_query($conexion, $q_update) or die(mysqli_error($conexion));


    }*/




    // Formar la consulta (seleccionando todas las filas)
    $q = "select * from entrada";

    // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Calcular el número de filas
    $total = mysqli_num_rows($r);

    // Mostrar el contenido de las filas, creando una tabla XHTML
    if ($total > 0) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th><th>Editar</th></tr>';

        while ($fila = mysqli_fetch_assoc($r)) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['titulo'] . "</td>";
            echo "<td>" . $fila['texto'] . "</td>";
            echo "<td>" . $fila['fecha'] . "</td>";
            echo "<td>" . $fila['activo'] . "</td>";
          // $href = "ejer08_editar.php?id=".$_fila['id'];
            echo "<td><a href='ejer08_editar.php?id=".$fila['id']."'>Editar</a></td>";
            echo "</tr>";
        }

        echo '</table>';
    }
    ?>

<?php
// Cerrar la conexión
mysqli_close($conexion);
?>


<p><a class="blue" href="ejer08.php">Recargar la página</a></p>


</html>
