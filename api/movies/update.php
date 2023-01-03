<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../models/movie.php';
include_once '../../models/api-key.php';

$database = new Database();
$db = $database->connect();
$apiKey = new ApiKey($db);
$headers = apache_request_headers();
$isAuth = $apiKey->authenticate($headers);

if (!$isAuth)
    return;

$data = json_decode(file_get_contents("php://input"));

$movie = new Movie($db);
$movie->id = isset($_GET['id']) ? $_GET['id'] : die();
$movie->title = $data->title;
$movie->description = $data->description;
$movie->image_url = $data->image_url;
$movie->certificate = $data->certificate;
$movie->imdb_rating = $data->imdb_rating;

if ($movie->update()) {
    echo json_encode(
        array('updated' => $movie->id)
    );
    return;
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Bad Request'));
    return;
}