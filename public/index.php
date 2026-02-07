<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

// CORS
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, Origin');
header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Credentials: true');

use Dotenv\Dotenv;
use Core\Router;
use Core\Mongo;
use App\Controllers\TracksController;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->safeLoad();

Mongo::connect();

$router = new Router();

$router->get('/tracks', TracksController::class . '@getAllTracks');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method'])) {
    $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
