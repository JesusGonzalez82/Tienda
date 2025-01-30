<?php

//Comprobamos que el usuario haya iniciado sesion
require 'sesiones.php';
require 'bd.php';
comprobar_sesion();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Categorias</title>
</head>

<body>
    <?php require "cabecera.php"; ?>
    <h1>Lista de categorías</h1>
    <!-- Lista de categorias -->
    <?php

    $categorias = cargar_categorias();
    if ($categorias === false) {
        echo "<p class='error'>Error al conectar con la Base de Datos</p>";
    } else {
        echo "<ul>"; // Iniciamos la lista
        foreach ($categorias as $cat) {
            $url = "productos.php?categoria=" . $cat['codCat'];
            echo "<li><a href='$url'>" . $cat['nombre'] . "</a></li>";
        }
        echo "</ul>";
    }
    ?>
</body>

</html>