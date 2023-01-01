<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/movie.php';

$database = new Database();
$db = $database->connect();

$movie = new Movie($db);

$result = $movie->read();

echo json_encode($result);