<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Curso de PHP | mayo de 2016 | ejer08.php</title>
    <?php
    include("../inc/inc_css.php");
    ?>
</head>
<body>
<?php
include("../inc/inc_header.php");
include("../inc/abrir_body.php");
?>

<h1 >Visualizar y añadir comentarios</h1>
<?php
    // Abrir la conexión
    $conexion = mysqli_connect("localhost", "root", "root", "blog");

    if (isset($_GET['enviar'])) {


        // comprobamos el campo checkbox
        $activo = 0;
        if (isset($_GET['activo'])) {
            $activo = 1;

        }

        $q_insert = "insert into comentario (email,texto,fecha,activo,entrada_id) values ('" . $_GET["email"] . "','" . $_GET["texto"] . "' ,'" . $_GET["fecha"] . "'," . $activo . ", " . $_GET["id"] . ")";

        // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
        mysqli_query($conexion, $q_insert) or die(mysqli_error($conexion));


        if (mysqli_affected_rows($conexion) > 0) {
            echo "<p>Se ha añadido un comentario</p>";
        }
    }

    // MOSTRAR, si es que nos pasan un id
    if (isset($_GET['id'])) {
        // Formar la consulta (seleccionando todas las filas)
        $q = "select * from entrada where id='" . $_GET['id'] . "'";

        // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
        $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

        // Calcular el número de filas y mostrarlo
        $total = mysqli_num_rows($r);

        if ($total == 1) {
            echo "<h2>Entrada</h2>";
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th></tr>';

            while ($fila = mysqli_fetch_assoc($r)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['titulo'] . "</td>";

                echo "<td>" . $fila['texto'] . "</td>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>" . $fila['activo'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }


        $q1 = "select * from comentario where entrada_id= " . $_GET['id'];
        $r1 = mysqli_query($conexion, $q1) or die(mysqli_error($conexion));
        $total1 = mysqli_num_rows($r1);

        if ($total1 > 0) {
            echo "<h2>Comentarios</h2>";
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Email</th><th>Texto</th><th>Fecha</th><th>Activo</th></tr>';

            while ($fila1 = mysqli_fetch_assoc($r1)) {
                echo "<tr>";
                echo "<td>" . $fila1['id'] . "</td>";
                echo "<td>" . $fila1['email'] . "</td>";

                echo "<td>" . $fila1['texto'] . "</td>";
                echo "<td>" . $fila1['fecha'] . "</td>";
                echo "<td>" . $fila1['activo'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Esta entrada no tiene comentarios.</p>";
        }

        echo "<h2>Añadir comentario</h2>";

        date_default_timezone_set('Europe/Madrid');
        $fecha_actual = date("Y-m-d H:i:s");

        echo '<form action="ejer09_mostrar.php" method="get">
            <div>
                <label for="titulo">Email:</label>
                 <input type="email" id="email" name="email" value="" placeholder="email@email.com"/>
            </div>
            <div>
              <label for="texto">Texto:</label>
              <textarea id="texto" name="texto" rows="4" cols="40"></textarea>
            </div>
            <div>
              <label for="fecha">Fecha:</label>
              <input type="text" id="fecha" name="fecha" value=' . $fecha_actual . '/>
            </div>
            <div>
              <label for="activo">Activo:</label>
              <input type="checkbox" id="activo" name="activo" checked="checked"/>
            </div>
            <div>
              <input type="reset" id="limpiar" name="limpiar" value="Limpiar"/>
              <input type="submit" id="enviar" name="enviar" value="Guardar"/>
            </div>
               <input type="hidden"  id="id" name="id" value="'. $_GET['id'] . '"/>

      </form>';
    }


        // Cerrar la conexión
        mysqli_close($conexion);

include ("../inc/inc_footer.php");
include ("../inc/inc_scripts.php");
?>

</body>
</html>