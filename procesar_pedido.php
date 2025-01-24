<!-- Este proceso consiste en:
    Insertar el pedido usando la funcion: insertar_pedido().
    Si el pedido se inserta correctacmente:
        Llamar a enviar_correo() para mandar los correos de confirmación
        Vaciar el carrito
    Mostrar mensaje de confirmacion o error-->

<?php

require 'correo.php';
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>

<body>
    <?php

    require 'cabecera.php';
    $resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['codRes']);
    if ($resul === false) {
        echo "No se ha podido realizar el pedido";
    } else {
        $correo = $_SESSION['usuario']['correo'];
        echo "Pedido realizado correctamente. Se enviará un correo de confirmación a: $correo";
        $conf = enviar_correos($_SESSION['carrito'], $resul, $correo);
        if ($conf !== TRUE){
            echo "Error al enviar: $conf <br>";
        }
        $_SESSION['carrito'] = [];
    }

    ?>
</body>

</html>