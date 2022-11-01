<?php

require_once __DIR__ . '/db.php';

require_once __DIR__ . '/functions.php';

//obtenemos el path recibido en la petición para poder saber recurso e identificador cuando hagamos las comprobaciones de qué acción ejecutar
$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/ejercicios_php/practica', '', $uri);
//obtenemos el verbo http para saber qué acción se quiere realizar
$httpVerb = $_SERVER['REQUEST_METHOD'];


//acciones para verbo POST
if ($httpVerb === 'POST') {
  // La petición está usando el verbo POST
  require_once __DIR__ . '/controlers/post_controlers.php';
}

//acciones para verbo GET
if ($httpVerb === 'GET') {
  // La petición está usando el verbo GET
  require_once __DIR__ . '/controlers/get_controlers.php';
}

//acciones para verbo PUT
if ($httpVerb === 'PUT') {
 require_once __DIR__ . '/controlers/put_controlers.php';
}

//acciones para verbo DELETE
if ($httpVerb === 'DELETE') {
  // La petición está usando el verbo DELETE
  require_once __DIR__ . '/controlers/delete_controlers.php';
}

?>