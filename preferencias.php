<!--Crea una nueva página "preferencias.php", en la que incluiremos un formulario que
permitirá a los restaurantes elegir entre varias opciones en el uso de la aplicación web.
A esta página se accederá con un enlace desde la cabecera.
Las opciones son del tipo “Sí o No” y consisten en:
a) Mostrar el carrito al hacer login (en vez de la página de categorías).
b) Ocultar los productos sin stock.
c) Guardar el carrito entre sesiones.
Cada una de estas preferencias se gestiona mediante una cookie.
Los nombres de las cookies son, respectivamente, `pagina_inicio`, `stock` y `carrito`.-->

<?php

require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    // cookie pagina inicio
    if (isset($_POST['pagina_inicio'])){
        setcookie('pagina_inicio', $_POST['pagina_inicio'], time() + 3600 * 24);
        $_COOKIE['pagina_inicio'] = $_POST['pagina_inicio'];
    } else{
        setcookie('pagina_inicio', '', time() - 3600 * 24);
        $_COOKIE['pagina_inicio'] = Null;
    }
    // cookie productos sin stock
    if (isset($_POST['stock'])){
        setcookie('stock', $_POST['stock'], time() + 3600 * 24);
        $_COOKIE['stock'] = $_POST['stock'];
    } else{
        setcookie('stock', '', time() - 3600 * 24);
        $_COOKIE['stock'] = Null;
    }
    // cookie guardar carrito
    if (isset($_POST['carrito'])){
        setcookie('carrito', json_encode($_SESSION['carrito']), time() + 3600 * 24);
        $_COOKIE['carrito'] = json_encode($_SESSION['carrito']);
    } else{
        setcookie('carrito', '', time() - 3600 * 24);
        $_COOKIE['carrito'] = Null;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias</title>
</head>
<body>
    <?php require 'cabecera.php';?>

    <h1>Preferencias</h1>

    <form action="preferencias.php" method="post">
        <input type="checkbox" name="pagina_inicio" id="pagina_inicio" value ='carrito.php' <?php if (isset($_COOKIE['pagina_inicio'])) echo "checked"; ?>>
        <label for="pagina_inicio">Ver Carrito al acceder</label><br>

        <input type="checkbox" name="stock" id="stock" value = 1 <?php if (isset($_COOKIE['stock'])) echo "checked"; ?>>
        <label for="stock">Ocultar productos sin Stock</label><br>    

        <input type="checkbox" name="carrito" id="carrito" value = 1 <?php if (isset($_COOKIE['carrito'])) echo "checked"; ?>>
        <label for="carrito">Guardar carrito entre sesiones</label><br><br>

        <input type="submit" value="Guardar">
    </form>

</body>
</html>