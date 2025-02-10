<?php

namespace Model;

class User extends ActiveRecord {
    protected static $table = 'users';
    protected static $columnsDB = ['id','name', 'email', 'phone'];

    // Declarar las propiedades
    public $id;
    public string $name;
    public string $email;
    public string $phone;
    public string $createDate;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? ''; 
        $this->createDate = $args['createDate'] ?? '';
    }

    // Validación para cuentas nuevas
    public function validateAccount() {
        if(!$this->name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->phone) {
            self::$alerts['error'][] = 'El Telefono es obligatorio';
        }
        return self::$alerts;
    }

    // Valida un email
    public function validateEmail() {
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        return self::$alerts;
    }
    // Valida el telefono
    public function validatePhone() {
        // Verifica que el teléfono tenga exactamente 9 dígitos y sea numérico
        if(!preg_match('/^[0-9]{9}$/', $this->phone)) {
            self::$alerts['error'][] = 'El Teléfono debe contener exactamente 9 dígitos y ser numérico';
        }
        return self::$alerts;
    }
}
