<?php
include_once '../config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if (!isset($data->phone) || !isset($data->message)) {
        http_response_code(400);
        echo json_encode(["message" => "Phone and message are required."]);
        exit;
    }

    // Get WA Gateway URL from settings
    $wa_url = '';
    if (isset($conn)) {
        $stmt = $conn->prepare("SELECT setting_value FROM app_settings WHERE setting_key = 'whatsapp_gateway_url'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $wa_url = $row['setting_value'] ?? '';
    }

    if (empty($wa_url)) {
        // Mock success if no URL configured
        echo json_encode(["message" => "WhatsApp Gateway URL not configured. Message logged (Mock): " . $data->message]);
        exit;
    }

    // Send to go-whatsapp-web-multidevice
    // Assumed endpoint: /send/message/text
    // Payload: { "phone": "628...", "message": "..." }
    
    $payload = json_encode([
        "phone" => $data->phone,
        "message" => $data->message
    ]);

    $ch = curl_init($wa_url . '/send/message/text');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code >= 200 && $http_code < 300) {
        echo json_encode(["message" => "Message sent successfully."]);
    } else {
        echo json_encode(["message" => "Failed to send message via Gateway.", "gateway_response" => $response]);
    }

} else {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed."]);
}
?>
