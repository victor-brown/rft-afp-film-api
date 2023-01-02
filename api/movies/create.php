<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

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


$movie = new Movie($db);

$data = json_decode(file_get_contents("php://input"));

$movie->title = $data->title;
$movie->year = $data->year;
$movie->image_url = $data->image_url;
$movie->certificate = $data->certificate;
$movie->runtime = $data->runtime;
$movie->imdb_rating = $data->imdb_rating;
$movie->description = $data->description;

$movie->genres = $data->genres;
$movie->stars = $data->stars;
$movie->directors = $data->directors;

$newID = $movie->create();


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