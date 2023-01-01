<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../config/database.php';
include_once '../../models/genre.php';
include_once '../../models/api-key.php';



$database = new Database();
$db = $database->connect();
$apiKey = new ApiKey($db);

$headers = apache_request_headers();
$isAuth = $apiKey->authenticate($headers);

if (!$isAuth)
    return;


$genre = new Genre($db);

$data = json_decode(file_get_contents("php://input"));

$genre->name = $data->name;

$newID = $genre->create();

if ($newID > 0) {
    echo json_encode(
        array('id' => $newID)
    );
    return;
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request'));
    return;
}