<?php

//Comprobamos si el usuario ha iniciado sesión
require_once 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Restaurantes</title>
</head>
<body>
<?php require "cabecera.php"; ?>
    <!-- Lista de categorias -->
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $actualizado = actualizar_restaurante($_POST);
        if ($actualizado == TRUE){
            echo "<p>Datos Actualizados correctamente</p>";
        }else {
            echo "<p>Error al actualizar</p>";
        }
    }
    // echo 'Respuesta: ' . cargar_restaurante();
    $listaRestaurantes = cargar_restaurante(); // nos devuelve los datos de los restaurantes
    if ($listaRestaurantes === FALSE){
        echo "<p>Error al conectar con la Base de Datos</p>";
        exit;
    }
    echo '<h2>Restaurantes</h2>';
    echo '<table border="1">';
    echo '<tr><th>Correo</th><th>Clave</th><th>Pais</th><th>CP</th><th>Ciudad</th><th>Direccion</th><th>CodRes</th><th></th></tr>';
    foreach ($listaRestaurantes as $restaurante ) {
        $codRes = $restaurante['CodRes'];
        $correo = $restaurante['Correo'];
        $clave = $restaurante['Clave'];
        $pais = $restaurante['Pais'];
        $cp = $restaurante['CP'];
        $ciudad = $restaurante['Ciudad'];
        $direccion = $restaurante['Direccion'];
        //$rol = $restaurante['Rol'];
        // echo '<br>';
        echo "<tr>
        <form action = 'datos_usu.php' method='POST'>
        <td><input name = ':correo' value='$correo'></td>
        <td><input name = ':clave' type='hidden' value='$clave'</td>
        <td><input name = ':pais' value='$pais'></td>
        <td><input name = ':cp' value='$cp'></td>
        <td><input name = ':ciudad' value='$ciudad'></td>
        <td><input name = ':direccion' value='$direccion'></td>
        <td><input name = ':codres' type='hidden' value='$codRes'></td>
        <td><input type = 'submit' value='Modificar'</td>
        </form>
        </tr>";
    }
    echo '</table>';
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET!=null){
        $insertado = insertar_restaunrate($_GET);
        if ($insertado == TRUE){
            echo "<p>Datos insertados correctamente</p>";
        }else{
            echo "<p>Error al insertar</p>";
        }
    }
    ?>

    <h2>Añadir Restaurante</h2>

    <form action="datos_usu.php" method=GET>
        <label for="correo">Correo</label><br>
        <input type="email" name=":correo" id="correo"><br>

        <label for="pais">Pais</label><br>
        <input type="text" name=":pais" id="pais"><br>

        <label for="cp">Código Postal</label><br>
        <input type="text" name=":cp" id="cp"><br>

        <label for="ciudad">Ciudad</label><br>
        <input type="text" name=":ciudad" id="ciudad"><br>

        <label for="correo">Dirección</label><br>
        <input type="text" name=":direccion" id="direccion"><br>

        <label for="clave">Clave</label><br>
        <input type="text" name=":clave" id="clave"><br>

        <input type="submit" value="Enviar">
    </form>


</body>
</html>