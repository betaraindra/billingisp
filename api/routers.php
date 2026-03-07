<?php
include_once '../config.php';

header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

// Mock Data
$mock_routers = [
  ["id" => 1, "name" => "Main Gateway", "ip" => "192.168.1.1", "model" => "RB4011", "status" => "online", "cpu" => 15, "uptime" => "15d 2h"],
  ["id" => 2, "name" => "Distribution OLT", "ip" => "192.168.1.2", "model" => "ZTE C320", "status" => "online", "cpu" => 45, "uptime" => "30d 5h"],
  ["id" => 3, "name" => "Backup Router", "ip" => "192.168.1.3", "model" => "RB750Gr3", "status" => "offline", "cpu" => 0, "uptime" => "0d 0h"]
];

if ($method == 'GET') {
    echo json_encode($mock_routers);
}
?>
