<?php
include '../config/config.php';

// Comprueba si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $task = $_POST['task'];

    // Validación básica
    if (empty($task)) {
        // Manejar el error, la tarea está vacía
        echo "La tarea no puede estar vacía.";
        exit;
    }

    // Crear conexión
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta para actualizar la tarea
    $stmt = $conn->prepare("UPDATE todo SET task = ? WHERE id = ?");
    $stmt->bind_param("si", $task, $id);

    // Ejecutar la consulta y cerrar la conexión
    if ($stmt->execute()) {
        echo "Tarea actualizada con éxito.";
    } else {
        echo "Error al actualizar la tarea: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

// Redirigir de vuelta a index.php
header("Location: index.php");
exit;
?>
