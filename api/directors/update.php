<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../models/director.php';
include_once '../../models/api-key.php';


$apiKey = new ApiKey($db);
$isAuth = $apiKey->authenticate($headers);
$database = new Database();
$db = $database->connect();
$headers = apache_request_headers();

if (!$isAuth)
    return;

$data = json_decode(file_get_contents("php://input"));

$director = new Director($db);
$director->id = isset($_GET['id']) ? $_GET['id'] : die();
$director->name = $data->name;
$director->about = $data->about;

if ($director->update()) {
    echo json_encode(
        array('updated' => $director->id)
    );
    return;
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request'));
    return;
}
