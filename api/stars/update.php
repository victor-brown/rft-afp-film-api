<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


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

$data = json_decode(file_get_contents("php://input"));

$star = new Star($db);
$star->id = isset($_GET['id']) ? $_GET['id'] : die();
$star->name = $data->name;
$star->about = $data->about;

if ($star->update()) {
    echo json_encode(
        array('updated' => $star->id)
    );
    return;
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request'));
    return;
}