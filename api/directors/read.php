<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/director.php';

$database = new Database();
$db = $database->connect();

$director = new Director($db);

$result = $director->read();

echo json_encode($result);