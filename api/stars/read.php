<?php
// Headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include_once '../../config/database.php';
include_once '../../models/star.php';

$datab = new Database();
$db = $datab->connect();
$star = new Star($db);
$result = $star->read();

echo json_encode($result);
