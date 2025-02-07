<?php

function enviar_correos($carrito, $pedido, $correo){
    $cuerpo = crear_correo($carrito, $pedido, $correo);
    return enviar_correo_multiples("$correo, pedidos@empresafalsa.com",
        $cuerpo, "Pedido $pedido confirmado");
}
function crear_correo($carrito, $pedido, $correo){
    $pesoTotal = 0;
    $texto = "<h1>Pedido nº $pedido </h1><h2>Restaurantes: $correo </h2>";
    $texto .= "Detalle del pedido";
    $productos = cargar_productos(array_keys($carrito));
    $texto .= "<table>";
    $texto .= "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Unidades</th></tr>";
	foreach($productos as $producto){
		$cod = $producto['CodProd'];
		$nom = $producto['Nombre'];
		$des = $producto['Descripcion'];
		$peso = $producto['Peso'];
        // EJERCICIO 4 PAGINA 123. 
        // Añadimos el peso total del pedido en el contenido del correo de confirmación
        $pesoTotal += $peso;
		$unidades = $_SESSION['carrito'][$cod];									    
		$texto .= "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$unidades</td>
		<td> </tr>";
	}
    $texto .= "</table>";
    // Mostramos el mensaje del peso.
    $texto .= "El peso total de los productos pedido es $pesoTotal";
    return $texto;
}
function enviar_correo_multiples($lista_correos, $cuerpo, $asunto = ""){
    $datos_servidor = leer_servidor(dirname(__FILE__)."/servidor_correo.xml", dirname(__FILE__)."/servidor_correo.xsd");
    
    // $mail = new PHPMailer();		
		// $mail->IsSMTP(); 					
		// $mail->SMTPDebug  = 0;  // cambiar a 1 o 2 para ver errores
		// $mail->SMTPAuth   = datos_servidor[0];                  
		// $mail->SMTPSecure = datos_servidor[1];                
		// $mail->Host       = datos_servidor[2];     
		// $mail->Port       = datos_servidor[3];                   
		// $mail->Username   = datos_servidor[4];  //usuario de gmail
		// $mail->Password   = datos_servidor[5]; //contraseña de gmail          
		// $mail->SetFrom('noreply@empresafalsa.com', 'Sistema de pedidos');
		// $mail->Subject    = $asunto;
		// $mail->MsgHTML($cuerpo);
		// /*partir la lista de correos por la coma*/
		// $correos = explode(",", $lista_correos);
		// foreach($correos as $correo){
		// 	$mail->AddAddress($correo, $correo);
		// }
		// if(!$mail->Send()) {
		//   return $mail->ErrorInfo;
		// } else {
            return TRUE;
        // }
}