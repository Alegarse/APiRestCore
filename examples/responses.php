<?php

# LINK URL DOMINIO
$url = 'http://mi-dominio.com/api/index.php';


#GET (Obtener todos los registros)
$response = file_get_contents($url);
$data = json_decode($response, true); // Convertir JSON a array asociativo

if ($data && isset($data['records'])) {
    foreach ($data['records'] as $record) {
        echo "ID: " . $record['id'] . "\n";
        echo "Name: " . $record['name'] . "\n";
        echo "Description: " . $record['description'] . "\n\n";
    }
} else {
    echo "No records found or an error occurred.\n";
}


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
$result = json_decode($response, true); // Convertir JSON a array asociativo

if (isset($result['message'])) {
    echo "Response: " . $result['message'] . "\n";
} else {
    echo "An error occurred.\n";
}


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
$result = json_decode($response, true); // Convertir JSON a array asociativo

if (isset($result['message'])) {
    echo "Response: " . $result['message'] . "\n";
} else {
    echo "An error occurred.\n";
}


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
$result = json_decode($response, true); // Convertir JSON a array asociativo

if (isset($result['message'])) {
    echo "Response: " . $result['message'] . "\n";
} else {
    echo "An error occurred.\n";
}