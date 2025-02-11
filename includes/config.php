<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

$modeENV = 'prod';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Usar variables de entorno con fallback
$db_host = $modeENV === 'prod' ? "free.clusters.zeabur.com" : $_ENV['DB_HOST_DEV'];
$db_port = $modeENV === 'prod'  ?  32461 : $_ENV['DB_PORT_DEV'];
$db_user =  $modeENV === 'prod' ? "root": $_ENV['DB_USER_DEV'];
$db_password =  $modeENV === 'prod' ? "9pXrZD4257GgQbP3S0EM6o8Bcvu1whfO"  : $_ENV['DB_PASSWORD_DEV'];
$db_name =  $modeENV === 'prod' ? "zeabur" : $_ENV['DB_NAME_DEV'];
return [
    'db_host' => $db_host,
    'db_port' => $db_port,
    'db_user' => $db_user,
    'db_password' => $db_password,
    'db_name' => $db_name,
];