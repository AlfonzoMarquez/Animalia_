<?php
/**
 * Conexión a MySQL usando PDO.
 * En XAMPP/WAMP el usuario por defecto es "root" y la clave está vacía.
 * Cambia estos valores si tu phpMyAdmin usa otras credenciales.
 */

$host    = 'localhost';
$dbname  = 'animalia';
$usuario = 'root';
$clave   = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $clave,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}
