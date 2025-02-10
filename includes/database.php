<?php
$config = require('config.php');
$db_host = $config['db_host'];
$db_port = $config['db_port'];
$db_user = $config['db_user'];
$db_password = $config['db_password'];
$db_name = $config['db_name'];
// print_r($config);
$db = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
