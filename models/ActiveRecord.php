<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    // Alertas y Mensajes
    protected static $alerts = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function querySQL($query) {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }

        // liberar la memoria
        $result->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function createObject($register) {
        $object = new static;

        foreach($register as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Identificar y unir los atributos de la BD
    public function attributes() {
        $attributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Sincroniza BD con Objetos en memoria
    public function synchronize($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function save() {
        $result = '';

        $result = $this->create();
        
        return $result;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result= self::querySQL($query);
        return $result;
    }
    // crea un nuevo registro
    public function create() {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    //Crear tablas cuando se apunta a una controlador
    public static function createTable($nameTable, $columns) {
        if (empty($columns)) {
            throw new Exception("No columns have been defined for the table {$nameTable}");
        }
    
        $query = "CREATE TABLE IF NOT EXISTS `{$nameTable}` (";
        
        $columnsSQL = [];
        foreach ($columns as $name => $type) {
            $columnsSQL[] = "`{$name}` {$type}";
        }
    
        $query .= implode(", ", $columnsSQL);
        $query .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
        // Ejecutar la consulta y manejar errores
        try {
            $result = self::$db->query($query);
            return $result;
        } catch (mysqli_sql_exception $e) {
            die("Error in the query SQL: " . $e->getMessage());
        }
    }
    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";
        $response = self::querySQL($query);
        return array_shift($response);
    }    
}