<?php 
include '../include/conexion.php'; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamos Pendientes</title>
    <link rel="stylesheet" href="../css/estiloBP.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="./agregar_libro.php">Agregar Libro</a>
        <a href="./agregar_usuario.php">Agregar Usuarios</a>
        <a href="./buscar_prestamo.php">Buscar Préstamos</a>
        <a href="./devolucion.php">Devoluciones</a>
    </div>

    <div class="main-content">
        <h1>Préstamos Pendientes</h1>

        <?php
        // Consulta para obtener préstamos pendientes
        $sql = "
            SELECT p.id AS prestamo_id, u.nombre_apellido, l.titulo, l.autor
            FROM prestamos p
            JOIN usuarios u ON p.id_usuario = u.id
            JOIN libros l ON p.id_libro = l.id
            WHERE p.fecha_devolucion IS NULL"; // Solo préstamos sin fecha de devolución

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<h2>Resultados</h2><ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>Préstamo ID: " . $row['prestamo_id'] . " - Usuario: " . $row['nombre_apellido'] . " - Libro: " . $row['titulo'] . " - Autor: " . $row['autor'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h2>No hay préstamos pendientes.</h2>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
</body>
</html>

</html>
