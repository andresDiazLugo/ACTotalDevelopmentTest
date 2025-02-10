<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

if (getenv('ENV_MOD') === 'dev') { // Si no hay variables en el sistema, cargar .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->safeLoad();
}

// Usar variables de entorno con fallback
$db_host = getenv('DB_HOST_PROD') ?: ($_ENV['DB_HOST_PROD'] ?? 'NO DEFINIDO');
$db_port = getenv('DB_PORT_PROD') ?: ($_ENV['DB_PORT_PROD'] ?? 3306);
$db_user = getenv('DB_USER_PROD') ?: ($_ENV['DB_USER_PROD'] ?? 'NO DEFINIDO');
$db_password = getenv('DB_PASSWORD_PROD') ?: ($_ENV['DB_PASSWORD_PROD'] ?? '');
$db_name = getenv('DB_NAME_PROD') ?: ($_ENV['DB_NAME_PROD'] ?? 'NO DEFINIDO');
// Retornar configuración como array
return [
    'db_host' => $db_host,
    'db_port' => $db_port,
    'db_user' => $db_user,
    'db_password' => $db_password,
    'db_name' => $db_name,
];