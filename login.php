<?php
require_once 'bd.php';
/* Formulario de login
Si el formulario va bien, guarda el nombre de usuario y redirige a principal.php
si va mal, salta un mensaje de error
*/
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    // Comprobamos el usuario y contraseña, si son correctos creamos la nueva sesion.
    $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
    if ($usu === false){
        $err = true;
        $usuario = $_POST['usuario'];
    }else{
        session_start();
        $_SESSION['usuario'] = $usu;
        $_SESSION['carrito'] = [];
        header("location: categorias.php");
        return;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login en "La Tienduca"</title>
</head>
    <?php 
    if(isset ($_GET["redirigido"])){
        echo "<p>Haga login para continuar</p>";
    }
    ?>
    <?php 
    if(isset($err) and $err == true){
        echo "<p>Revise usuario y contraseña</p>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="usuario">Usuario</label>
        <input value="<?php if(isset($usuario)) echo $usuario ?>" id="usuario" name="usuario" type="text">
        <label for="clave">Password</label>
        <input type="password" name="clave" id="clave">
        <input type="submit">
    </form>
</body>
</html>
