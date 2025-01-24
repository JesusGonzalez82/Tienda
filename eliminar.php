<?php
// Comprobamos que el usuario haya iniciado sesion o redirige

require_once 'sesiones.php';
comprobar_sesion();
$cod = $_POST['cod'];
$unidades = $_POST['unidades'];
// Si exite el códido restamos las unidades, con minimo de 0
if (isset($_SESSION['carrito'][$cod])){
    $_SESSION['carrito'][$cod] -= $unidades;
    if($_SESSION['carrito'][$cod] <= 0){
        unset($_SESSION['carrito'][$cod]);
    }
}
header("location: carrito.php");