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
        <a href="categorias.php">Home</a>
        <a href="carrito.php">Carrito</a>
        <a href="logout.php">Cerrar sesion</a>
    </header>
</body>
</html>