<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        Usuario: <?php echo $_SESSION['usuario']['correo'] ?>
        <!-- Mostramos las categorias, pero Administradores solo se muestra si el usuario tiene el email admin@empresa.com -->
        <?php if ($_SESSION['usuario']['correo'] === 'admin@empresa.com'){?> 
                <a href="zona_admin.php">Administradores</a>
            <?php } ?>
        <a href="categorias.php">Home</a>
        <a href="carrito.php">Carrito</a>
        <a href="logout.php">Cerrar sesion</a>
        <a href="preferencias.php">Preferencias</a>
    </header>
</body>
</html>