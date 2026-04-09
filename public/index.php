<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\VideoController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_ends_with($requestUri, '/videos')) {

    $controller = new VideoController();

    $response = $controller->getAllVideos();

    echo json_encode($response);

} else {

    http_response_code(404);
    echo json_encode([
        'message' => "Route not found",
        'debug_uri_received' => $requestUri
    ]);
}
?>