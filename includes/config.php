<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

// Cargar variables de entorno desde .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Ajusta la ruta si es necesario
$dotenv->load();

// Obtener valores desde el entorno
$env_mod = $_ENV['ENV_MOD'] ?? 'dev';

$db_host = ($env_mod == 'dev') ? 'localhost' : ($_ENV['DB_HOST_PROD'] ?? 'NO DEFINIDO');
$db_port = ($env_mod == 'dev') ? 3306 : ($_ENV['DB_PORT_PROD'] ?? 3306);
$db_user = ($env_mod == 'dev') ? 'root' : ($_ENV['DB_USER_PROD'] ?? 'NO DEFINIDO');
$db_password = ($env_mod == 'dev') ? 'root' : ($_ENV['DB_PASSWORD_PROD'] ?? '');
$db_name = ($env_mod == 'dev') ? 'actotaldevelopment' : ($_ENV['DB_NAME_PROD'] ?? 'NO DEFINIDO');
// Retornar configuración como array
return [
    'db_host' => $db_host,
    'db_port' => $db_port,
    'db_user' => $db_user,
    'db_password' => $db_password,
    'db_name' => $db_name,
];