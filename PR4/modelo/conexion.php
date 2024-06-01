<?php
//Patrón Singleton
class Database {
    private static $conexion = null;

    private function __construct() {
        // private para prevenir la creación de objetos directamente
    }

    public static function getConexion() {
        if (self::$conexion == null) {
            self::$conexion = new mysqli("database","juanmi","4800","SIBW");
        }
        return self::$conexion;
    }
}
?>