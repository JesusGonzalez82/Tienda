<!-- El fichero anadir.php se encarga de añadir productos al carrito. No tiene salida,
 modifica la variable de sesión y se redirige a carrito.php . Recibe los datos del form
 de productos.php y los parametros de cod y unidades que recibe para modificar el carrito.
 Primero comprueba si el codigo ya existe en el array. Si existe, se suma unidades al valor
 existente. Si no existe, se crea con valor unidades. -->

 <?php
 require_once 'sesiones.php';
 comprobar_sesion();

 $cod = $_POST['cod'];
 $unidades = (int)$_POST['unidades'];
 // Si existe el codigo le sumamos las unidades
 if (isset($_SESSION['carrito'][$cod])){
    $_SESSION['carrito'][$cod] += $unidades;
 }else {
    $_SESSION['carrito'][$cod] = $unidades;
 }

 if (isset($_COOKIE['carrito'])){
   setcookie('carrito', json_encode($_SESSION['carrito']), + time()+3600*24);
 }
 
//  header("location: carrito.php");
/* 
EJERCICIO 1 PAGINA 123
Al añadir un producto, la aplicacion redirige al carrito. Modificala para que redirija a 
la tabla productos, con la misma categoria.
*/
header("location:" .$_SERVER['HTTP_REFERER']);