<?php
    // session_start()
    require_once 'sesiones.php';
    comprobar_sesion();
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), 123, time(), -1000);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesion Cerrada</title>
</head>
<body>
    <p>La sesion se cerró correctamente</p>
    <a href="login.php">Ir a la página de login</a>
</body>
</html>l