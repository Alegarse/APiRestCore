<?php
require_once '../config/database.php';
require_once '../models/model.php';

class Controller {
    private $db;
    private $example;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->example = new Model($this->db);
    }

    public function read() {
        $stmt = $this->example->read();
        $num = $stmt->rowCount();

        if($num > 0) {
            $examples_arr = array();
            $examples_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $example_item = array(
                    "id" => $id,
                    "name" => $name,
                    "description" => $description
                );

                array_push($examples_arr["records"], $example_item);
            }

            http_response_code(200);
            echo json_encode($examples_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No examples found."));
        }
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if(
            !empty($data->name) &&
            !empty($data->description)
        ) {
            $this->example->name = $data->name;
            $this->example->description = $data->description;

            if($this->example->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Example was created."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create example."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create example. Data is incomplete."));
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"));

        if(
            !empty($data->id) &&
            !empty($data->name) &&
            !empty($data->description)
        ) {
            $this->example->id = $data->id;
            $this->example->name = $data->name;
            $this->example->description = $data->description;

            if($this->example->update()) {
                http_response_code(200);
                echo json_encode(array("message" => "Example was updated."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to update example."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to update example. Data is incomplete."));
        }
    }

    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->id)) {
            $this->example->id = $data->id;

            if($this->example->delete()) {
                http_response_code(200);
                echo json_encode(array("message" => "Example was deleted."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to delete example."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to delete example. Data is incomplete."));
        }
    }
}
?>
