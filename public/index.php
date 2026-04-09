<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../src/Config/Database.php';

use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_ends_with($requestUri, '/videos')) {
    try {
        $stmt = $db->prepare("SELECT * FROM videos");
        $stmt->execute();
        $videos = $stmt->fetchAll();

        echo json_encode([
            "status" => "success",
            "data" => $videos
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    http_response_code(404);
    echo json_encode([
        'message' => "Route not found",
        'debug_uri_received' => $requestUri
    ]);
}
?>