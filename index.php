<?php include('include/conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Buscar Libros o Autores</title>
    <link rel="stylesheet" href="css/estilo1.css">
</head>
<body>
<h1>Bienvenido a la Biblioteca</h1>
    <nav>
        <ul>
            <li><a href="page/agregar_usuario.php">Agregar Usuario</a></li>
            <li><a href="page/agregar_libro.php">Agregar Libro</a></li>
            <li><a href="page/prestamos.php">Préstamos</a></li>
            <li><a href="page/devolucion.php">Devoluciones</a></li>
            <li><a href="page/buscar_prestamo.php">Buscar Prestamos</a></li>
        </ul>
    </nav>

    <form method="GET">
        <input type="text" name="buscar" placeholder="Buscar libro o autor" required>
        <button type="submit">Buscar</button>
    </form>

    <?php
    if (isset($_GET['buscar'])) {
        $buscar = $_GET['buscar'];
        
        // Escapar caracteres especiales para evitar inyecciones SQL
        $buscar = $conn->real_escape_string($buscar);
        
        // Modificar la consulta para incluir el ID
        $sql = "SELECT id, titulo, autor FROM libros WHERE titulo LIKE '%$buscar%' OR autor LIKE '%$buscar%'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<h2>Resultados</h2><ul>";
            while ($row = $result->fetch_assoc()) {
                // Mostrar el ID junto con el título y el autor
                echo "<li>ID: " . $row['id'] . " - " . $row['titulo'] . " - " . $row['autor'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h2>No se encontraron resultados.</h2>";
        }
    }
    ?>

</body>
</html>
