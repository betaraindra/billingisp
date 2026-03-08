<?php
include_once '../config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    if (isset($conn)) {
        try {
            $stmt = $conn->query("SELECT id, name, ip_address, model, status, last_seen FROM routers ORDER BY id DESC");
            $routers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($routers);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        // Mock Data
        $mock_routers = [
            ["id" => 1, "name" => "Main Gateway", "ip_address" => "192.168.1.1", "model" => "RB4011", "status" => "online", "last_seen" => date('Y-m-d H:i:s')],
            ["id" => 2, "name" => "Distribution OLT", "ip_address" => "192.168.1.2", "model" => "ZTE C320", "status" => "online", "last_seen" => date('Y-m-d H:i:s')],
            ["id" => 3, "name" => "Backup Router", "ip_address" => "192.168.1.3", "model" => "RB750Gr3", "status" => "offline", "last_seen" => null]
        ];
        echo json_encode($mock_routers);
    }
} elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("INSERT INTO routers (name, ip_address, username, password, port, model) VALUES (:name, :ip, :user, :pass, :port, :model)");
            $stmt->bindParam(':name', $data->name);
            $stmt->bindParam(':ip', $data->ip_address);
            $stmt->bindParam(':user', $data->username);
            $stmt->bindParam(':pass', $data->password); // In real app, encrypt this!
            $port = $data->port ?? 8728;
            $stmt->bindParam(':port', $port);
            $model = $data->model ?? 'Unknown';
            $stmt->bindParam(':model', $model);
            
            if($stmt->execute()) {
                echo json_encode(["message" => "Router added successfully", "id" => $conn->lastInsertId()]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to add router"]);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "Router added (Mock)", "id" => rand(10, 100)]);
    }
} elseif ($method == 'DELETE') {
    $id = isset($_GET['id']) ? $_GET['id'] : die();
    
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("DELETE FROM routers WHERE id = :id");
            $stmt->bindParam(':id', $id);
            if($stmt->execute()) {
                echo json_encode(["message" => "Router deleted successfully"]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to delete router"]);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "Router deleted (Mock)"]);
    }
}
?>
