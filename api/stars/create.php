<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../config/database.php';
include_once '../../models/star.php';
include_once '../../models/api-key.php';



$database = new Database();
$db = $database->connect();
$apiKey = new ApiKey($db);

$headers = apache_request_headers();
$isAuth = $apiKey->authenticate($headers);

if (!$isAuth)
    return;


$star = new Star($db);

$data = json_decode(file_get_contents("php://input"));

$star->name = $data->name;
$star->about = $data->about;

$newID = $star->create();

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