<?php
require_once 'controllers/controller.php';

$controller = new Controller();

$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method) {
    case 'GET':
        $controller->read();
        break;
    case 'POST':
        $controller->create();
        break;
    case 'PUT':
        $controller->update();
        break;
    case 'DELETE':
        $controller->delete();
        break;
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed"));
        break;
}
?>
