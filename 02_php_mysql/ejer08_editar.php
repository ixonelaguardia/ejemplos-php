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
<h1>Modificar post</h1>


<?php
/**
 * Created by PhpStorm.
 * User: 8flm09
 * Date: 13/5/16
 * Time: 21:25
 */


    // Abrir la conexión
$conexion = mysqli_connect("localhost", "root", "root", "blog");
if (isset($_GET['enviar'])){

        // comprobamos el campo checkbox
        $activo = 0;
         if (isset($_GET['activo'])) {
            $activo = 1;
                echo $activo;
        }

        $q_update = "update entrada set titulo='" . $_GET['titulo'] .
        "', texto='" . $_GET['texto'] .
        "', fecha='" . $_GET['fecha'] .
        "', activo= " . $activo . " where id=" . $_GET['id'];
          //   "', activo= '" . $activo . "' where id=" . $id;

        // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
        mysqli_query($conexion, $q_update) or die(mysqli_error($conexion));



    if (mysqli_affected_rows($conexion) > 0){
        echo "Se ha modificado la entrada con id " . $_GET['id'];
    }

}else{

    // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
    date_default_timezone_set('Europe/Madrid');
    $fecha_actual = date("Y-m-d H:i:s");
    $id = "";
    // recojo el dato
    $id = $_GET['id'];

    // Formar la consulta (seleccionando la fila que corresponde al ID)
    $q = "select * from entrada where id=".$id;

    // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Calcular el número de filas
    $total = mysqli_num_rows($r);

    // Mostrar el contenido de la fila seleccionada en un formulario
    if ($total == 1) {
        $fila = mysqli_fetch_assoc($r);
        // FORMULARIO

       // echo '<form action="ejer08.php" method="get">
        echo '<form action="ejer08_editar.php" method="get">
    <div>
      <label for="id">Título:</label>
      <input type="text" id="id" name="id" value="'.$id.'"/>
    </div>
    <div>
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" value="'.$fila['titulo'].'"/>
    </div>
    <div>
      <label for="texto">Texto:</label>
      <textarea id="texto" name="texto" rows="4" cols="40">'.$fila['texto'].'</textarea>
    </div>
    <div>
      <label for="fecha">Fecha:</label>
      <input type="text" id="fecha" name="fecha" value="'.$fecha_actual.'"/>
    </div>
    <div>
      <label for="activo">Activo:</label>';
        if($fila['activo'] == 1){
            echo  '<input type="checkbox" id="activo" name="activo" checked="checked"/>';
        }else{
            echo  '<input type="checkbox" id="activo" name="activo"/>';
        }
   echo' </div>
    <div>
      <input type="reset" id="limpiar" name="limpiar" value="Limpiar"/>
      <input type="submit" id="enviar" name="enviar" value="Modificar"/>
    </div>
  </form>';

    }}
//cerrar conexion
mysqli_close($conexion);

?>


</body>
</html>