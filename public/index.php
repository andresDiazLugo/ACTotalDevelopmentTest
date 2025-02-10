<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\UserController;
use Controllers\PageController;

$router = new Router();

// Crear Cuenta
$router->get('/', [UserController::class, 'register']);
$router->post('/register', [UserController::class, 'registerApi']);
$router->get('/404', [PageController::class, 'error']);

$router->checkRoutes();