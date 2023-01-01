<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/movie.php';

$database = new Database();
$db = $database->connect();



$movie = new Movie($db);
$movie->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $movie->readSingle();

echo json_encode($result);