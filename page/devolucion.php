<?php
// Incluir el archivo de conexión
include '../include/conexion.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prestamo_id = $_POST['prestamo_id'];
    $fecha_devolucion = date('Y-m-d');

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("UPDATE prestamos SET fecha_devolucion=? WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("si", $fecha_devolucion, $prestamo_id); // "si" indica los tipos: string, entero

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Devolución registrada correctamente.";
        } else {
            echo "Error al registrar la devolución: " . $stmt->error;
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
    <title>Devoluciones</title>
    <link rel="stylesheet" href="../css/estiloD.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="./agregar_libro.php">Agregar Libro</a>
        <a href="./agregar_usuario.php">Agregar Usuario</a>
        <a href="./prestamos.php">Préstamos</a>
        <a href="./buscar_prestamo.php">Buscar Prestamos</a>
    </div>

    <div class="main-content">
        <h1>Registrar Devolución</h1>
        <div class="form-container">
            <form method="POST">
                ID del Préstamo: <input type="number" name="prestamo_id" required><br>
                <button type="submit">Registrar Devolución</button>
            </form>
        </div>
    </div>
</body>
</html>
