<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

if (getenv('ENV_MOD') === 'dev') { // Si no hay variables en el sistema, cargar .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->safeLoad();
}

// Usar variables de entorno con fallback
$db_host = $_SERVER['DB_HOST_PROD'] ?? $_ENV['DB_HOST_DEV'] ?? 'NO DEFINIDO';
$db_port = $_SERVER['DB_PORT_PROD'] ?? $_ENV['DB_PORT_DEV'] ?? 'NO DEFINIDO';
$db_user = $_SERVER['DB_USER_PROD'] ?? $_ENV['DB_USER_DEV'] ?? 'NO DEFINIDO';
$db_password = $_SERVER['DB_PASSWORD_PROD'] ?? $_ENV['DB_PASSWORD_DEV'] ?? 'NO DEFINIDO';
$db_name = $_SERVER['DB_NAME_PROD'] ?? $_ENV['DB_NAME_DEV'] ?? 'NO DEFINIDO';
// Retornar configuración como array
return [
    'db_host' => $db_host,
    'db_port' => $db_port,
    'db_user' => $db_user,
    'db_password' => $db_password,
    'db_name' => $db_name,
];