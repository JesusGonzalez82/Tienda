<!-- Muestra una tabla con una fila por cada producto (diferente) del carrito. La fila muestra los datos
 del producto y el numero de unidades pedidas. Además en cada fila hay un formulario para
eliminar ese producto del carrito. El funcionamiento es análogo al del formulario para añadir
de productos.php
    El formulario incluye el numero de unidades que hay que eliminar y el codigo del producto
este ultimo como campo oculto. Se envia a eliminar.php -->

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
    <title>Carrito de la compra</title>
</head>
<body>
    <?php

    require 'cabecera.php';
    echo '<h2>Carrito de la compra</h2>';
    $productos = cargar_productos(array_keys($_SESSION['carrito']));
    if ($productos === FALSE){
        echo "<p>No hay productos en el pedido</p>";
        exit;
    }
    echo "<h2>Carrito de la compra</h2>";
    echo "<table>"; // abrimos la tabla
    echo "<tr><th>Nombre</th><th>Descripcion</th>
        <th>Peso</th><th>Stock</th><th>Comprar</th></tr>";
    foreach ($productos as $producto){
        $cod = $producto['CodProd'];
        $nom = $producto['nombre'];
        $des = $producto['descripcion'];
        $peso = $producto['peso'];
        $unidades = $_SESSION['carrito'][$cod];
        echo "<tr><td>$nom</td><td>$des</td><td>$des/td><td>$peso</td><td>$unidades</td>
        <td>
            <form action= 'eliminar.php' method='POST'>
                <input name= 'unidades' type='number' min='1' value='1'>
                <input type= 'submit' value= 'Eliminar'>
                <input name= 'cod' type= 'hidden' value='$cod'>
            </form>
        </td>
    </tr>";
    }
    echo "</table>";
    ?>
    <hr>
    <a href="procesar_pedido.php">Realizar pedido</a>
</body>
</html>