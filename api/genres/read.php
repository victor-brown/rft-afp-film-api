<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/genre.php';

$database = new Database();
$db = $database->connect();

$genre = new Genre($db);

$result = $genre->read();

echo json_encode($result);