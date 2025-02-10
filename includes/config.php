<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

$modeENV = 'prod';
if ($modeENV === 'dev') { // Si no hay variables en el sistema, cargar .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->safeLoad();
}

// Usar variables de entorno con fallback
$db_host = $modeENV === 'prod' ? $_SERVER['DB_HOST_PROD'] : $_ENV['DB_HOST_DEV'];
$db_port = $modeENV === 'prod' ?  $_SERVER['DB_PORT_PROD'] : $_ENV['DB_PORT_DEV'];
$db_user =  $modeENV === 'prod' ? $_SERVER['DB_USER_PROD'] : $_ENV['DB_USER_DEV'];
$db_password =  $modeENV === 'prod' ? $_SERVER['DB_PASSWORD_PROD'] : $_ENV['DB_PASSWORD_DEV'];
$db_name =  $modeENV === 'prod' ? $_SERVER['DB_NAME_PROD'] : $_ENV['DB_NAME_DEV'];
// Retornar configuración como array
print_r('ssssss'.$db_host);
return [
    'db_host' => $db_host,
    'db_port' => $db_port,
    'db_user' => $db_user,
    'db_password' => $db_password,
    'db_name' => $db_name,
];