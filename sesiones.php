<?php

// Comprobamos si el usuario a hecho login, si no lo ha hecho redirige al formulario de login.
function comprobar_sesion(){
    session_start();
    if (!isset($_SESSION['usuario'])){
        header("location: login.php?redirigido=true");
    }
}