<?php

#curl -X GET "http://tu-dominio.com/api/index.php"

#curl -X POST "http://tu-dominio.com/api/index.php" -H "Content-Type: application/json" -d '{"name": "Nuevo Ejemplo", "description": "Descripción del nuevo ejemplo"}'

#curl -X PUT "http://tu-dominio.com/api/index.php" -H "Content-Type: application/json" -d '{"id": 1, "name": "Ejemplo Actualizado", "description": "Descripción actualizada"}'

#curl -X DELETE "http://tu-dominio.com/api/index.php" -H "Content-Type: application/json" -d '{"id": 1}'


# LINK URL DOMINIO
$url = 'http://mi-dominio.com/api/index.php';


#GET (Obtener todos los registros)
$response = file_get_contents($url);
$data = json_decode($response, true);
print_r($data);


#POST (Crear un nuevo registro)
$data = array(
    'name' => 'Nuevo Ejemplo',
    'description' => 'Descripción del nuevo ejemplo'
);

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response);
print_r($result);


#PUT (Actualizar un registro existente)
$data = array(
    'id' => 1,
    'name' => 'Ejemplo Actualizado',
    'description' => 'Descripción actualizada'
);

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'PUT',
        'content' => json_encode($data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response);
print_r($result);


#DELETE (Eliminar un registro)
$data = array('id' => 1);

$options = array(
    'http' => array(
        'header'  => "Content-Type: application/json\r\n",
        'method'  => 'DELETE',
        'content' => json_encode($data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response);
print_r($result);