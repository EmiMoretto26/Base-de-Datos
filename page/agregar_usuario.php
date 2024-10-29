<?php

include '../include/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_apellido = $_POST['nombre_apellido'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_apellido, email) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $nombre_apellido, $email); 

       
        if ($stmt->execute()) {
            echo "Usuario agregado correctamente.";
        } else {
            echo "Error al agregar el usuario: " . $stmt->error;
        }

       
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}


if ($conn) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agregar Usuarios</title>
    <link rel="stylesheet" href="../css/estiloAG.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="./agregar_libro.php">Agregar Libro</a>
        <a href="./buscar_prestamo.php">Buscar Prestamos</a>
        <a href="./devolucion.php">Devolucion</a>
        <a href="./prestamos.php">Prestamos</a>
    </div>

    <div class="main-content">
        <h1>Agregar Usuarios</h1>
        <form method="POST">
            Nombre y Apellido: <input type="text" name="nombre_apellido" required><br>
            Email: <input type="email" name="email" required><br>
            <button type="submit">Agregar Usuario</button>
        </form>
    </div>
</body>

</html>
