<?php
// Incluir el archivo de conexión
include '../include/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $libro = $_POST['libro'];
    $fecha_prestamo = date('Y-m-d');

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO prestamos (id_usuario, id_libro, fecha_prestamo) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("iis", $usuario, $libro, $fecha_prestamo); // "iis" indica los tipos: entero, entero, string

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Préstamo registrado correctamente.";
        } else {
            echo "Error al registrar el préstamo: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}

// Cerrar la conexión solo si fue creada correctamente
if ($conn) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Préstamos</title>
    <link rel="stylesheet" href="../css/estiloP.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="./agregar_libro.php">Agregar libro</a>
        <a href="./agregar_usuario.php">Agregar Usuarios</a>
        <a href="./prestamos.php">Préstamos</a>
        <a href="./devolucion.php">Devoluciones</a>
    </div>

    <div class="main-content">
        <h1>Préstamos</h1>
        <div class="form-container">
            <form method="POST">
                Usuario ID: <input type="number" name="usuario" required><br>
                Libro ID: <input type="number" name="libro" required><br>
                <button type="submit">Registrar Préstamo</button>
            </form>
        </div>
    </div>
</body>
</html>

</html>
