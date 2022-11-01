<?php

if($uri === '/duties'){
    //obtiene el listado de duties y guarda en duties
    $duties = getDutiesList($conn);

    //devolvemos la respuesta con código 200 + json con datos de los usuarios
    http_response_code(200);
    echo json_encode($duties);
    return;
  }

  //partimos la ruta para extraer recurso + id del usuario que se quiere acceder---?????
  $uriParts = explode('/',substr($uri,1));
  
  //si la ruta no tiene 2 framentos (recurso + id) no ejecuta el código dentro del if--?????
  if($uriParts[0] === 'duties' && count($uriParts) === 2){
    //obtiene la información de la duty y guarda en $duty
    $duty = getDuty($conn, $uriParts[1]);

    //si no se encuentra el usuario devuelve error 404
    if(!$duty){
      //devolvemos un error
      http_response_code(404);
      echo '{"message": "La tarea no existe"}';
      return;
    }

    //devolvemos la respuesta con código 200 + json con datos de la duty
    http_response_code(200);
    echo json_encode($duty);
    return;
  }