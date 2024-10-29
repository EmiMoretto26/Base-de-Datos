<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'biblioteca';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
