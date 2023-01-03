<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../config/database.php';
include_once '../../models/director.php';
include_once '../../models/api-key.php';

$database = new Database();
$db = $database->connect();
$headers = apache_request_headers();
$apiKey = new ApiKey($db);
$isAuth = $apiKey->authenticate($headers);


if (!$isAuth)
    return;

$director = new Director($db);

$director->id = isset($_GET['id']) ? $_GET['id'] : die();

if ($director->delete()) {
    echo json_encode(
        array('deleted' => $director->id)
    );
    return;
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request'));
    return;
}
