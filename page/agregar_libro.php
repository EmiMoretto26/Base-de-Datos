<?php
// Incluir el archivo de conexión
include '../include/conexion.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $anio_publicacion = $_POST['anio_publicacion'];
    $genero = $_POST['genero'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, isbn, anio_publicacion, genero) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssis", $titulo, $autor, $isbn, $anio_publicacion, $genero); // "sssis" indica los tipos: string, string, string, int, string

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Libro agregado correctamente.";
        } else {
            echo "Error al agregar el libro: " . $stmt->error;
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
    <title>Agregar Libros</title>
    <link rel="stylesheet" href="../css/estiloAL.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="./agregar_usuario.php">Agregar Usuarios</a>
        <a href="./prestamos.php">Préstamos</a>
        <a href="./devolucion.php">Devoluciones</a>
        <a href="./buscar_prestamo.php">Buscar Préstamos</a>
    </div>


    <div class="main-content">
        <h1>Agregar libros</h1>

        <div class="form-container">

            <form method="POST">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required><br>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required><br>

                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn"><br>

                <label for="anio_publicacion">Año de Publicación:</label>
                <input type="number" id="anio_publicacion" name="anio_publicacion" required><br>

                <label for="genero">Género:</label>
                <input type="text" id="genero" name="genero"><br>

                <button type="submit">Agregar Libro</button>
            </form>
        </div>
    </div>
</body>

</html>