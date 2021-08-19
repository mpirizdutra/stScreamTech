<?php
// abrimos la sesión cURL
$ch = curl_init();

// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://serviciotecnico.screamtech.com.ar/notificar/notificar.php");
// indicamos el tipo de petición: POST
curl_setopt($ch, CURLOPT_POST, TRUE);
// definimos cada uno de los parámetros
//curl_setopt($ch, CURLOPT_POSTFIELDS, "login=1&notificar=40-8D-5C-BE-16-84&usuario_nombre=admin&usuario_password=screamtech1920");
curl_setopt($ch, CURLOPT_POSTFIELDS, "notificar=408D5CBE1684&login=1");

// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remote_server_output = curl_exec ($ch);

// cerramos la sesión cURL
curl_close ($ch);

// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
print_r($remote_server_output);


?>


