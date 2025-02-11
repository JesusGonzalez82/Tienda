<!-- Crea una nueva página "zona_admin.php", en la que incluyas diferentes opciones de
administración.
A esta página se accederá con un enlace desde la cabecera solo visible para el
administrador. -->

<?php

// Comprobamos si el usuario ha iniciado sesión
require_once 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Administrador</title>
</head>
<body>
<?php require "cabecera.php"; ?>
    <h1>Zona de Administración</h1>

    <nav>
        <?php echo "<ul>" ?>
        <li><a href="datos_usu.php">Datos de Restaurantes</a></li>
        <?php echo "</ul>" ?>
    </nav>

</body>
</html>
