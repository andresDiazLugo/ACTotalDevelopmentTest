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

    public static function registerApi(Router $router) {
        try {
            header('Content-Type: application/json');  // Asegura que la respuesta sea interpretada como JSON
            
            // Obten los datos JSON del cuerpo de la solicitud
            $json = file_get_contents('php://input');
            $datos = json_decode($json, true); // Decodifica el JSON en un array asociativo
        
            // Sincroniza los datos con la clase Usuario
            $user = new User();
            $user->synchronize($datos);
        
            $alerts = $user->validateAccount();
            $alerts = $user->validateEmail();
            $alerts = $user->validatePhone();
        
            if (empty($alerts)) {
                $userExists = User::where('email', $user->email);
        
                if ($userExists) {
                    echo json_encode([
                        'status' => 'error',
                        'data' => 'El Usuario ya está registrado'
                    ]);
                    exit;
                } else {
                    $response = $user->save();
        
                    if ($response) {
                        echo json_encode([
                            'status' => 'success',
                            'data' => 'Usuario registrado exitosamente'
                        ]);
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'data' => 'Hubo un error al registrar al usuario'
                        ]);
                    }
                    exit;
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'data' => $alerts,
                ]);
                exit;
            }
        
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'data' => 'Ocurrió un error al procesar la solicitud',
                'error' => $e->getMessage()
            ]);
        }
    }

    public static function userGetAllApi() {
        try {
            header('Content-Type: application/json');
            $users = User::all();
            if($users){
                echo json_encode([
                        'status' => 'success',
                        'data' => $users
                ]);
                exit;    
            }
            echo json_encode([
                'status' => 'error',
                'data' => $users
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'data' => 'Ocurrió un error al procesar la solicitud',
                'error' => $e->getMessage()
            ]);
        }
    }
   
}