<?php
// .htaccess untuk API
// RewriteEngine On
// RewriteCond %{REQUEST_FILENAME} !-f
// RewriteCond %{REQUEST_FILENAME} !-d
// RewriteRule ^(.*)$ index.php [QSA,L]

header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8"); // Removed to prevent conflict with HTML frontend
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$host = "localhost";
$db_name = "isp_billing";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $conn->exec("set names utf8");
} catch(PDOException $exception) {
    // echo "Connection error: " . $exception->getMessage();
    // Fallback response for demo if DB not connected
}

function writeLog($conn, $user_id, $username, $action, $description) {
    if ($conn) {
        try {
            $ip = $_SERVER['REMOTE_ADDR'];
            $stmt = $conn->prepare("INSERT INTO system_logs (user_id, username, action, description, ip_address) VALUES (:user_id, :username, :action, :description, :ip)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
        } catch(PDOException $e) {
            // Silently fail logging if DB issue
        }
    }
}
?>
