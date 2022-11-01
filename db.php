<?php

header('Content-Type: application/json; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = ""; //si no es vacía, probar con root  
$dbname = "database";
$dbport = 3306;

$conn = null;

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$dbport", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //$conn->setAttribute(PDO::ATTR_TIMEOUT, 2);
} catch(PDOException $e) {

  //Si hay un error lanzamos un 500 informando
  http_response_code(500);
  echo '{"message": "Se ha producido un error interno."}';
  return;
}