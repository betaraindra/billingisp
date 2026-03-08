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
            $sql = "SELECT t.*, c.fullname as customer_name FROM tickets t JOIN customers c ON t.customer_id = c.id ORDER BY t.created_at DESC";
            $stmt = $conn->query($sql);
            $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tickets);
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        // Mock Data
        $mock_tickets = [
            ["id" => 1, "ticket_number" => "TKT-001", "customer_name" => "John Doe", "subject" => "Internet Slow", "status" => "open", "priority" => "high", "created_at" => date('Y-m-d H:i:s')],
            ["id" => 2, "ticket_number" => "TKT-002", "customer_name" => "Jane Smith", "subject" => "Router Blinking Red", "status" => "closed", "priority" => "medium", "created_at" => date('Y-m-d H:i:s', strtotime('-1 day'))]
        ];
        echo json_encode($mock_tickets);
    }
} elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if (isset($conn)) {
        try {
            $ticket_number = 'TKT-' . strtoupper(substr(md5(uniqid()), 0, 6));
            $stmt = $conn->prepare("INSERT INTO tickets (ticket_number, customer_id, subject, message, priority) VALUES (:num, :cust_id, :subj, :msg, :prio)");
            $stmt->bindParam(':num', $ticket_number);
            $stmt->bindParam(':cust_id', $data->customer_id);
            $stmt->bindParam(':subj', $data->subject);
            $stmt->bindParam(':msg', $data->message);
            $stmt->bindParam(':prio', $data->priority);
            
            if($stmt->execute()) {
                echo json_encode(["message" => "Ticket created successfully", "id" => $conn->lastInsertId()]);
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Unable to create ticket"]);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["message" => "Ticket created (Mock)", "id" => rand(10, 100)]);
    }
}
?>
