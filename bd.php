<?php
function leer_config($nombre, $esquema){
    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE){
        throw new InvalidArgumentException("Revise el fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $ip = $datos->xpath("//ip");
    $nombre = $datos->xpath("//nombre");
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
    $resul = [];
    $resul[] = $cad;
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}

function leer_servidor($nombre, $esquema){
    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE){
        throw new InvalidArgumentException("Revise el fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);

    $SMTPAuth= $datos->xpath("//SMTPAuth");
    $SMTPSecure= $datos->xpath("//SMTPSecure");
    $Host= $datos->xpath("//Host");
    $Port= $datos->xpath("//Port");
    $Username= $datos->xpath("//Username");
    $Password= $datos->xpath("//Password");

    $resul = [$SMTPAuth, $SMTPSecure, $Host, $Port, $Username, $Password];

    return $resul;
}


function comprobar_usuario($nombre, $clave){
    $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $ins = "select codRes, correo from restaurantes where correo = '$nombre'
            and clave = '$clave'";
    $resul = $bd ->query($ins);
    if ($resul -> rowCount() === 1){
        return $resul->fetch();
    }else {
        return FALSE;
    }
}

function cargar_categorias(){
    $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $ins = "select codCat, nombre from categorias";
    $resul = $bd->query($ins);
    if (!$resul){
        return FALSE;
    }
    if ($resul -> rowCount() === 0){
        return FALSE;
    }
    // Si hay 1 o más
    return $resul;
}

function cargar_categoria($codCat){
    $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $ins = "select nombre, descripcion from categorias where codcat = $codCat";
    $resul = $bd->query($ins);
    if (!$resul){
        return FALSE;
    }
    if ($resul->rowCount() === 0){
        return false;
    }
    // si hay 1 o mas
    return $resul->fetch();
}
function cargar_productos_categoria($codCat){
    $res = $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    /*
    EJERCICIO 3 PAGINA 123. Modificamos la tabla productos para que no muestre
    los productos sin stock.
    */
    $sql = "select * from productos where codcat = $codCat and stock > 0";
    $resul = $bd ->query($sql);
    if (!$resul){
        return FALSE;
    }
    if ($resul->rowCount() === 0){
        return FALSE;
    }
    // Si hay 1 o mas
    return $resul;
}
/*
Recibe como argumento el codigo de una categoria y devuelve un cursos con sus productos.
Incluye todas las columnas de la base de datos. Si hay algún error con la base de datos,
la categoria no existe o no tiene productos, devuelve FALSE.
*/
function cargar_productos($codigosProductos){
    $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $texto_in = implode(",", $codigosProductos);
    if ($texto_in === '') return FALSE;
    $ins = "select * from productos where codProd in ($texto_in)";
    $resul = $bd-> query($ins);
    if (!$resul){
        return FALSE;
    }
    return $resul;
/*
Recibe como argumento un array de códigos de productos y devuelve un cursos con todas
las columnas de estos. Si hay algún error con la base de datos, devuelve False. Esta función se
usa al mostrar el carrito de la compra.
*/
}
function insertar_pedido($carrito, $codRes){
    $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $bd->beginTransaction();
    $hora = date("Y-m-d H:i:s", time());
    // insertamos el pedido
    $sql = "insert into pedidos(fecha, enviado, restaurante) values ('$hora', 0, '$codRes')";
    $resul = $bd->query($sql);
    if(!$resul){
        return FALSE;
    }
    // cogemos el id del nuevo pedido para las filas detalle
    $pedido = $bd->lastInsertId();
    // insertamos las filas en pedidoproducto
    foreach($carrito as $codProd=>$unidades){
        $sql = "insert into pedidosproductos(CodPed, CodProd, Unidades) values ($pedido, $codProd, $unidades)";
        $resul = $bd->query($sql);
        if(!$resul){
            $bd->rollBack();
            return FALSE;
        }
    }
    $bd->commit();
    return $pedido;
}

function cargar_restaurante(){
    $res = leer_config(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new PDO($res[0], $res[1], $res[2]);
    $ins = "select * from restaurantes";
    $resul = $bd-> query($ins);
    if (!$resul){
        return FALSE;
    }
    return $resul;

}
