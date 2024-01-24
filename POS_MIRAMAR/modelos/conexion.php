<?php

class Conexion{

	static public function conectar() {
        try {
            $host = $_ENV['DB_HOST']; // Nombre del host de la base de datos
            $dbname = $_ENV['DB_DATABASE']; // Nombre de la base de datos
            $username = $_ENV['DB_USERNAME']; // Nombre de usuario de la base de datos
            $password = $_ENV['DB_PASSWORD']; // Contraseña de la base de datos

            $link = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Configurar el conjunto de caracteres
            $link->exec("set names utf8");

            return $link;
        } catch (PDOException $e) {
            // Manejar errores de conexión
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

}