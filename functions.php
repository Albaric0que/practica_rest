<?php

//Función listado
function getRequestBody(){
  $json = file_get_contents('php://input');
  
  return json_decode($json, true);
}

/* function dutyPost($conn, $toDo) {
  $insert = [
    ':title' => 'Comprar donetes',
    ':category' => 'compras',
    ':description' => 'Hay que comprar donetes para la gorda...La gorda soy yo',
    ':created_at' => (new DateTime())->format('Y-m-d H:i:s'),
    ':updated_at' => null
  ];
} */

//función insertar
function insertDuty($conn, $toDo){
  $insertDuty = [
    ':title' => $toDo['title'],
    ':category' => $toDo['category'],
    ':description' => $toDo['description'],
    ':created_at' => (new DateTime())->format('Y-m-d H:i:s'),
    ':updated_at' => (new DateTime())->format('Y-m-d H:i:s')
  ];

  $insertSQL = "INSERT INTO todolist (title, category, description, created_at, updated_at) 
  VALUES (:title, :category, :description, :created_at, :updated_at)";
  //le decimos a PDO que prepare la consulta de $insertSQL para su uso posterior
  $query = $conn->prepare($insertSQL);

  try{
    // Vincula y executa
    if($query->execute($insertDuty)) {
        return $conn->lastInsertId(); 
    }
  }catch(Exception $e){
    return $e->getMessage();
  }
}

//Funciones obtención 
function getDuty($conn, $id){
  $dutySQL = "SELECT * FROM todolist WHERE id=:id";
  $query = $conn->prepare($dutySQL);
  // Especificamos el fetch mode antes de llamar a fetch()
  $query->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $query->execute([':id' => $id]);
  // Mostramos los resultados
  $duties = $query->fetchAll();


  if(count($duties) === 0){
    return null;
  }

  return $duties[0];
}

function getDutiesList($conn){
  $dutiesSQL = "SELECT * FROM todolist ORDER BY created_at ASC";
  $query = $conn->prepare($dutiesSQL);
  // Especificamos el fetch mode antes de llamar a fetch()
  $query->setFetchMode(PDO::FETCH_ASSOC);
  // Ejecutamos
  $query->execute();
  // Mostramos los resultados
  $duties = $query->fetchAll();

  return $duties;
}

//Función editar
function editDuty($conn, $toDo, $id){
  $updateDuty = [
    ':title' => $toDo['title'],
    ':category' => $toDo['category'],
    ':description' => $toDo['description'],
    ':created_at' => (new DateTime())->format('Y-m-d H:i:s'),
    ':updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
    'id' => $id
  ];
  
  $updateSQL = "UPDATE todolist SET title=:title, category=:category, description=:description WHERE id=:id";
  //le decimos a PDO que prepare la consulta de $insertSQL para su uso posterior
  $query = $conn->prepare($updateSQL);
  
  try{
    // Vincula y executa
    if($query->execute($updateDuty)) {
        return $id;
    }
  }catch(Exception $e){
    return null;
  }
}

//Función borrado
function deleteDuty($conn, $id){
  $deleteDuty = [
    ':id' => $id
  ];
  
  $deleteSQL = "DELETE FROM todolist WHERE id=:id";
  //le decimos a PDO que prepare la consulta de $insertSQL para su uso posterior
  $query = $conn->prepare($deleteSQL);
  
  try{
    // Vincula y executa
    if($query->execute($deleteDuty)) {
      return $query->rowCount();
    }
  }catch(Exception $e){
    return 0;
  }
}

?>