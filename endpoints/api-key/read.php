<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/api-key.php';

$database = new Database();
$db = $database->connect();

$apiKey = new ApiKey($db);

$response = $apiKey->create();

if ($response != false) {
    echo $response;
    return;
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request'));
    return;
}