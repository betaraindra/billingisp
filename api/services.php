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
            $stmt = $conn->query("SELECT * FROM services ORDER BY price ASC");
            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($services);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        // Mock Data
        $mock_services = [
            ["id" => 1, "name" => "Home 10Mbps", "price" => 150000, "speed_mbps" => 10, "description" => "Fiber Optic Home Package"],
            ["id" => 2, "name" => "Home 20Mbps", "price" => 250000, "speed_mbps" => 20, "description" => "Fiber Optic Home Package"],
            ["id" => 3, "name" => "Gamer 50Mbps", "price" => 500000, "speed_mbps" => 50, "description" => "Dedicated IP for Gaming"]
        ];
        echo json_encode($mock_services);
    }
} elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("INSERT INTO services (name, price, speed_mbps, description) VALUES (:name, :price, :speed, :desc)");
            $stmt->bindParam(':name', $data->name);
            $stmt->bindParam(':price', $data->price);
            $stmt->bindParam(':speed', $data->speed_mbps);
            $stmt->bindParam(':desc', $data->description);
            
            if($stmt->execute()) {
                echo json_encode(["message" => "Service added successfully", "id" => $conn->lastInsertId()]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to add service"]);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "Service added (Mock)", "id" => rand(10, 100)]);
    }
} elseif ($method == 'DELETE') {
    $id = isset($_GET['id']) ? $_GET['id'] : die();
    
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("DELETE FROM services WHERE id = :id");
            $stmt->bindParam(':id', $id);
            if($stmt->execute()) {
                echo json_encode(["message" => "Service deleted successfully"]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to delete service"]);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "Service deleted (Mock)"]);
    }
}
?>
