<?php

//ruta para creación de usuario
  if($uri = "/duties"){
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
      echo '{"message": "Es necesario que especifiques la categoría de la lista"}';
      return;
    }

    //validamos que exista el parámetro
    if(!key_exists('description',$toDo)){
      http_response_code(400);
      echo '{"message": "Es necesario que especifiques la descripción de la lista"}';
      return;
    }

    //creamos la tarea
   /*  $result = dutyPost($conn, $toDo); */
    $result = insertDuty($conn, $toDo);
    //aquí deberíamos devolver un error si $result es null

    //obtenemos la info de la tarea anteriormente creado y guardamos en $duty
    $duty = getDuty($conn, $result);

    //devolvemos la respuesta con código 201 + json con datos del usuario
    http_response_code(201);
    echo json_encode($duty);
    return;
  }