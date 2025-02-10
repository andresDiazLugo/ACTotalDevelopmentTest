<?php
namespace Controllers;
use Model\User;
use MVC\Router;

class UserController {
    public static function register(Router $router) {
        $alertas = [];
        $user = new User();
        // Definimos nuestras columnas de la tabla
        $columns = [
            'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR (120) NOT NULL',
            'email' => 'VARCHAR (120) NOT NULL UNIQUE',
            'phone' => 'VARCHAR (9) NOT NULL',
            'createDate' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ];
        // Creacion de la tabla
        $response = User::createTable('users', $columns);
        //Renderizar la vista de registro de usuarios
        $router->render('user/registerUser');
    }
   
}