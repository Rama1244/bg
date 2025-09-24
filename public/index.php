<?php

// Simple autoloader for our classes
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace(['\\', 'App/'], ['/', 'app/'], $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Http\Controllers\MonthlySummaryController;
use App\Models\MonthlySummary;

// Initialize database
MonthlySummary::createTable();
MonthlySummary::seedData();

// Simple routing
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$controller = new MonthlySummaryController();

try {
    if ($requestUri === '/' && $requestMethod === 'GET') {
        echo $controller->index();
    } elseif (preg_match('/^\/monthly-summary\/(\d+)\/edit$/', $requestUri, $matches) && $requestMethod === 'GET') {
        echo $controller->edit($matches[1]);
    } elseif (preg_match('/^\/monthly-summary\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'POST') {
        echo $controller->update($matches[1]);
    } else {
        header('HTTP/1.0 404 Not Found');
        echo '404 - Halaman tidak ditemukan';
    }
} catch (Exception $e) {
    header('HTTP/1.0 500 Internal Server Error');
    echo 'Terjadi kesalahan: ' . $e->getMessage();
}