<?php
session_start();
include_once '../config.php';

header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$current_user_id = $_SESSION['user_id'] ?? null;
$current_username = $_SESSION['username'] ?? 'System';

// Mock Data jika database belum siap
$mock_users = [
    ["id" => 1, "username" => "admin", "role" => "super_admin", "created_at" => date("Y-m-d H:i:s")],
    ["id" => 2, "username" => "teknisi1", "role" => "technician", "created_at" => date("Y-m-d H:i:s")],
    ["id" => 3, "username" => "kasir1", "role" => "cashier", "created_at" => date("Y-m-d H:i:s")]
];

if ($method == 'GET') {
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("SELECT id, username, role, created_at FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($users);
        } catch(PDOException $e) {
            echo json_encode($mock_users);
        }
    } else {
        echo json_encode($mock_users);
    }
} elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if (isset($conn)) {
        try {
            $query = "INSERT INTO users SET username=:username, password=:password, role=:role";
            $stmt = $conn->prepare($query);
            
            $stmt->bindParam(":username", $data->username);
            $password_hash = password_hash($data->password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $password_hash);
            $stmt->bindParam(":role", $data->role);
            
            if($stmt->execute()) {
                $new_user_id = $conn->lastInsertId();
                writeLog($conn, $current_user_id, $current_username, 'CREATE_USER', "Created user: " . $data->username);
                echo json_encode(["message" => "User created successfully.", "id" => $new_user_id]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to create user."]);
            }
        } catch(PDOException $e) {
            http_response_code(503);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "User created (Mock)", "id" => rand(10, 100)]);
    }
} elseif ($method == 'DELETE') {
    // Handle delete
    echo json_encode(["message" => "User deleted"]);
}
?>
