<?php

 //obtenemos el body de la petición (función creada por nosotros)
  $toDo = getRequestBody();
  //Si no es un array lo que llega en el body cortamos ejecución, no han llegado datos en el body
  if(!is_array($toDo)){
    //devolvemos un error
    http_response_code(400);
    echo '{"message": "Petición mal formada"}';
    return;
  }

  //validamos que exista el parámetro
  if(!key_exists('title',$toDo)){
    http_response_code(400);
    echo '{"message": "Es necesario especificar el título de la lista"}';
    return;
  }

  //validamos que exista el parámetro
  if(!key_exists('category',$toDo)){
    http_response_code(400);
    echo '{"message": "Es necesario que especifiques la categoria de la tarea"}';
    return;
  }

  //validamos que exista el parámetro
  if(!key_exists('description',$toDo)){
    http_response_code(400);
    echo '{"message": "Es necesario que especifiques la descripción de la tarea"}';
    return;
  }

  //partimos la ruta para extraer recurso + id del usuario que se quiere acceder
  $uriParts = explode('/',substr($uri,1));
  
  //si la ruta no tiene 2 framentos (recurso + id) no ejecuta el código dentro del if
  if($uriParts[0] === 'duties' && count($uriParts) === 2){
    //editamos el usuario, si todo va bien tenemos el id del usuario, en caso contrario un null
    $id = editDuty($conn, $toDo, $uriParts[1]);

    //si no se ha editado el usuario devolvemos un error
    if(!$id){
      //devolvemos un error
      http_response_code(400);
      echo '{"message": "No se ha podido actualizar la tarea, revisa los datos enviados"}';
      return;
    }

    //obtenemos los datos del usuario
    $duty = getDuty($conn, $id);

    //devolvemos la respuesta con código 200 + json con datos del usuario
    http_response_code(200);
    echo json_encode($duty);
    return;
  }