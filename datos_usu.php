<?php

// Comprobamos si el usuario ha iniciado sesión
require_once 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require "cabecera.php"; ?>
    <!-- Lista de categorias -->
    <?php
    // echo 'Respuesta: ' . cargar_restaurante();
    $listaRestaurantes = cargar_restaurante();
    echo '<h2>Restaurantes</h2>';
    echo '<table border="1">';
    echo '<tr><th>Correo</th><th>Clave</th><th>Pais</th><th>CP</th><th>Ciudad</th><th>Direccion</th><th></th></tr>';
    foreach ($listaRestaurantes as $restaurante ) {
        $codRes = $restaurante['CodRes'];
        $correo = $restaurante['Correo'];
        $clave = $restaurante['Clave'];
        $pais = $restaurante['Pais'];
        $cp = $restaurante['CP'];
        $ciudad = $restaurante['Ciudad'];
        $direccion = $restaurante['Direccion'];
        // echo '<br>';
        echo "<tr><td><input type='text' value='$correo'></td><td>$clave</td><td>$pais</td><td>$cp</td><td>$ciudad</td><td>$direccion</td><td><button>Modificar</button></td></tr>";
    }
    echo '</table>';
    ?>
</body>
</html>